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
			$this->_app->SetExec( $this );
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
			return $this->_workdata[ $key ];
		}
		/**
		 ** @desc Возвращает точку входа в приложение
		 **/
		public function App(): object {
			return $this->_app;
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
				$app = $this->_app;
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