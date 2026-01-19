<?php
	defined( "exec" ) or die();
	
	/**
	 ** @desc Класс исполняемого объекта, в нём хранится вся информация исполнения, директория, точка входа, ключ cli. Так же является точкой входа в исполняемое приложение
	 ** @author PsilFX
	 **/
	class Exec {
		private string $_dir;
		private string $_main;
		private string $_name;
		private string $_destination;
		private array  $_options;
		private string $_appExecName;
		private object $_app;
		private array  $_workdata;
		private int    $_clikey; //Ключ исполнения в cli
		private array  $_language; //Информация о модуле
		private array  $_tempdata = array(); //Для сохранения между модулями 
		private array  $_aliases = array(); //Для сохранения ссылок на объекты, чтобы получать между модулями
		/**
		 ** @desc Основной конструктор класса
		 ** @vars (string) destination - назначение например "core", (string) name - название приложения, (int) clikey - ключ или адрес запуска в cli, (array) options - доп. настройки приложения
		 **/
		public function __construct( string $destination , string $name , int $clikey , array $options = array() ) {
			$this->_InitValues();
			//Сохраняем входные данные
			$this->_destination = $destination;
			$this->_name        = $name;
			$this->_clikey      = $clikey;
			$this->_options     = $options;
			//Получаем входную точку
			$this->_dir         = _root_dir . DS . $destination . DS . $name . DS;
			$this->_main        = $this->_dir . 'index.php';
			//Подгружаем инфу о модуле
			$this->_LoadLanguage();
			//Подгружаем файл
			Cli::IncOnce( $this->_main );
			//Загружаем приложение
			$this->_appExecName = 'App' . ucfirst( $destination ) . ucfirst( $this->_RemoveSlashesFromName( $name ) );
			$this->_app         = Cli::New( $this->_appExecName , $options );
			$controller         = $this->Load( "controllers" , $name );
			$this->_app->SetExec( $this );
			$this->_app->SetController( $controller );
			$this->_app->Main();
		}
		private function _LoadLanguage(): void {
			$this->_language = Cli::GetAppInfo( $this->_destination , $this->_name );
		}
		private function _RemoveSlashesFromName( string $name ): string {
			return implode( '' , array_map( 'ucfirst' , explode( DS , $name ) ) );
		}
		/**
		 ** @desc Инициализация значений по умолчанию
		 **/
		private function _InitValues(): void {
			$this->_workdata = array();
		}
		/**
		 ** @desc Подгружает и исполняет файл приложения, нужен для загрузки моделей, контроллеров и вспомогательных классов
		 ** @vars (string) destination - назначение например "core", (string) name - название приложения
		 ** @return (object) Возвращает исполняемый класс из подгружаемого файла
		 **/
		public function Load( string $destination , string $name , array $options = array() ): object {
			Cli::IncOnce( $this->_dir . $destination . DS . $name . '.php' );
			$key                     = count( $this->_workdata );
			$modelName               = $this->_appExecName . ucfirst( $destination ) . ucfirst( $name );
			$this->_workdata[ $key ] = Cli::New( $modelName , $options );
			$this->_workdata[ $key ]->SetName( $modelName );
			$this->_workdata[ $key ]->SetKey( $key );
			$this->_workdata[ $key ]->SetExec( $this );
			$this->SetObjectAlias( $destination . '_' . $name , $this->_workdata[ $key ] );
			return $this->_workdata[ $key ];
		}
		/**
		 ** @desc Для поиска модели по имени, выдаёт первую найденную модель
		 **/
		public function GetModelByName( string $name ): object {
			$modelName = $this->_appExecName . 'Models' . ucfirst( $name );
			foreach( $this->_workdata as $data ) {
				if( $data->GetName() == $modelName ) return $data;
			}
			return new StdClass;
		}
		/**
		 ** @desc Для поиска контроллера по имени, выдаёт первый найденный контроллер
		 **/
		public function GetControllerByName( string $name ): object {
			$controllerName = $this->_appExecName . 'Controllers' . ucfirst( $name );
			foreach( $this->_workdata as $data ) {
				if( $data->GetName() == $controllerName ) return $data;
			}
			return new StdClass;
		}
		/**
		 ** @desc Возвращает точку входа в приложение
		 **/
		public function App(): object {
			return $this->_app;
		}
		/**
		 ** @desc Пишет временные данные, для работы между контроллерами
		 **/
		public function WriteTempData( string $key , array $data ): bool {
			if( isset( $this->_tempdata[ $key ] ) ) return false;
			$this->_tempdata[ $key ] = $data;
			return true;
		}
		public function ReadTempData( string $key ): array {
			if( !isset( $this->_tempdata[ $key ] ) ) return array();
			return $this->_tempdata[ $key ];
		}
		public function SetObjectAlias( string $alias , object &$obj ): bool {
			if( isset( $this->_aliases[ $alias ] ) ) return false;
			$this->_aliases[ $alias ] = $obj;
			return true;
		}
		public function GetObjectByAlias( string $alias ): object {
			if( !isset( $this->_aliases[ $alias ] ) ) return null;
			return $this->_aliases[ $alias ];
		}
		/**
		 ** @desc Возвращает ключ cli
		 **/
		public function CliKey(): int {
			return $this->clikey;
		}
		public function Dir(): string {
			return $this->_dir;
		}
		
		public function GetView( string $name , array $data = array() ): string {
			ob_start();
				$exec = $this;
				$app  = $this->_app;
				extract( $this->_tempdata , EXTR_PREFIX_ALL , 'temp' );
				include $this->_dir . 'view' . DS . $name . '.php';
				$html = ob_get_contents();
			ob_end_clean();
			return $html;
		}
		
		public function Lang( string $key ): string {
			return $this->_language[ $key ] ?? '';
		}
		
		public function GetPreset( string $name ): array {
			return include( $this->_dir . 'presets' . DS . $name . '.php' ) ?? array();
		}
	}
?>