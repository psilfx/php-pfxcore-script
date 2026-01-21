<?php
	defined( "exec" ) or die();
	/**
	 ** @desc Command Line Interface для доступа и работы с модулями
	 ** @author PsilFX
	 **/
	class Cli {
		//Язык
		private string $_lang = 'ru';
		//Исполняемые модули
		private array $_exec;
		//Библиотеки
		private array $_libraries;
		//Резерв переменной под синглтон
		private static ?self $_instance = null;
		
		//Инициализация объекта
		public function Init() {
			self::$_instance->_exec      = array();
			self::$_instance->_libraries = array();
			self::$_instance->_LoadLanguage();
		}
		private function _LoadLanguage() {
			global $language;
			$language = require_once _root_dir . DS . 'core' . DS . 'language' . DS . self::$_instance->_lang . '.php';
		}
		//Точка входа в синглтон
		public static function GetInstance(): self {
			if( !self::$_instance ) {
				self::$_instance = new Self();
				self::$_instance->Init();
			}
			return self::$_instance;
		}
		public function Load( string $destination , string $name , array $options = array() , $admin_path = false ): int {
			$key = count( self::$_instance->_exec );
			self::$_instance->_exec[ $key ] = new Exec( $destination , $name , $key , $options , $admin_path );
			return $key;
		}
		public function LoadLib( string $name ): int {
			$path = _root_dir . DS . 'core' . DS . 'libs' . DS;
			require_once $path . $name . '.php';
			$key = count( self::$_instance->_libraries );
			$lib = 'Library' . ucfirst( $name );
			self::$_instance->_libraries[ $key ] = new $lib;
			self::$_instance->_libraries[ $key ]->SetName( $name );
			self::$_instance->_libraries[ $key ]->SetDir( $path );
			return $key;
		}
		
		public function GetExec( int $key ) {
			return self::$_instance->_exec[ $key ];
		}
		public function GetApp( int $key ) {
			return self::$_instance->_exec[ $key ]->App();
		}
		public static function Language(): string {
			return self::$_instance->_lang;
		}
		public static function Curl( string $url , string $json = '{}' ): string {
			$ch = curl_init( $url );
			curl_setopt( $ch , CURLOPT_POST , true );
			curl_setopt( $ch , CURLOPT_POSTFIELDS , $json );
			// curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true );  // Без проверки
			// curl_setopt($ch, CURLOPT_CAINFO, "cert/internal.crt"); // Указываем сертификат
			curl_setopt( $ch , CURLOPT_HTTPHEADER , [ 'Content-Type: application/json' ] );
			ob_start();
				curl_exec( $ch );
				$response = ob_get_contents();
				curl_close( $ch );
			ob_end_clean();
			return $response;
		}
		public static function GetAppInfo( string $destination , string $name ): array {
			$path  = _root_dir . DS . $destination . DS . $name . DS . 'language' . DS . Cli::Language() . '.php';
			$info  = ( is_file( $path ) ) ? require $path : array( 'title' => '' , 'description' => '' , 'icon' => '' );
			$info += array( 'module' => $name );
			return $info;
		}
		public static function Inc( string $file ): void {
			if( is_file( $file ) ) include $file;
		}
		public static function IncOnce( string $file ): void {
			if( is_file( $file ) ) include_once $file;
		}
		public static function New( string $class , array $options = array() ) {
			if( class_exists( $class ) ) return new $class( $options );
		}
		public static function DB(): object {
			return self::$_instance->GetApp( _cli_db_key );
		}
		public static function Router(): object {
			return self::$_instance->GetApp( _cli_router_key );
		}
		public static function Template(): object {
			return self::$_instance->GetApp( _cli_template_key );
		}
		public static function Auth(): object {
			return self::$_instance->GetApp( _cli_auth_key );
		}
		public static function Users(): object {
			return self::$_instance->GetApp( _cli_users_key );
		}
		public static function ArraysLib(): object {
			return self::$_instance->_libraries[ _cli_arrays_lib_key ];
		}
		public static function FilesLib(): object {
			return self::$_instance->_libraries[ _cli_files_lib_key ];
		}
		public static function AdminLib(): object {
			return self::$_instance->_libraries[ _cli_admin_lib_key ];
		}
	}
?>