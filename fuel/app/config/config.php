<?php
/**
 * FuelPHP Configuration File
 *
 * @package    FuelPHP
 * @version    1.8
 * @author     Fuel Development Team
 * @license    MIT License
 * @copyright  2010 - 2016 Fuel Development Team
 * @link       http://fuelphp.com
 */

return array(

    // 環境設定 ('development', 'staging', 'production' など)
    'environment' => 'development',  // 本番環境では 'production' に変更

    // アプリケーションのベースURL (null にすると自動検出)
    'base_url'  => null,

    // URLのサフィックス (例: `.html` など)
    'url_suffix'  => '',

    // `index.php` の表示 (false にすると URL から省略可能)
    'index_file' => false,

    // キャッシュの設定
    'caching'         => false,
    'cache_lifetime'  => 3600, // 秒単位 (1時間)

    // タイムゾーン設定
    'default_timezone' => 'Asia/Tokyo',

    // 言語設定
    'language'           => 'ja',
    'language_fallback'  => 'en',
    'locale'             => 'ja_JP.UTF-8',

    // ログの設定
    'log_threshold'    => Fuel::L_WARNING, // L_ALL, L_ERROR, L_WARNING, L_DEBUG など
    'log_path'         => APPPATH.'logs/',
    'log_date_format'  => 'Y-m-d H:i:s',

    // セキュリティ設定
    'security' => array(
        'uri_filter'        => array('htmlentities'),  // URIのエンコード
        'output_filter'     => array('Security::htmlentities'), // 出力のエンコード
        'whitelisted_classes' => array(  // 変換をスキップするクラス
            'Fuel\\Core\\Presenter',
            'Fuel\\Core\\Response',
            'Fuel\\Core\\View',
            'Fuel\\Core\\ViewModel',
            'Closure',
        ),
    ),

    // クッキーの設定
    'cookie' => array(
        'expiration'  => 0, // クッキーの有効期限 (0 = セッション終了時)
        'path'        => '/',
        'domain'      => null,
        'secure'      => false, // HTTPS のみ送信 (本番環境では true を推奨)
        'http_only'   => true, // JavaScript からのアクセス禁止
    ),

<<<<<<< HEAD
	/**
	 * DateTime settings
	 *
	 * server_gmt_offset	in seconds the server offset from gmt timestamp when time() is used
	 * default_timezone		optional, if you want to change the server's default timezone
	 */
	'server_gmt_offset'  => 0,
	'default_timezone'   => 'Asia/Tokyo',
=======
    // バリデーションの設定
    'validation' => array(
        'global_input_fallback' => true, // 入力値のグローバルフェイルバック
    ),
>>>>>>> 9b6128ab66efe27283097e95392c3e1869bf60ad

    // ルーティング設定
    'routing' => array(
        'case_sensitive' => true, // 大文字・小文字を区別する
        'strip_extension' => true, // 拡張子を削除
    ),

    // モジュールの設定
    'module_paths' => array(
        APPPATH.'modules'.DS,
    ),

    // パッケージの設定 (FuelPHP の拡張機能)
    'package_paths' => array(
        PKGPATH,
    ),

<<<<<<< HEAD
		/**
		 * Allow the Input class to use X headers when present
		 *
		 * Examples of these are HTTP_X_FORWARDED_FOR and HTTP_X_FORWARDED_PROTO, which
		 * can be faked which could have security implications
		 */
		// 'allow_x_headers'       => false,

		/**
		 * This input filter can be any normal PHP function as well as 'xss_clean'
		 *
		 * WARNING: Using xss_clean will cause a performance hit.
		 * How much is dependant on how much input data there is.
		 */
		'uri_filter'       => array('htmlentities'),

		/**
		 * This input filter can be any normal PHP function as well as 'xss_clean'
		 *
		 * WARNING: Using xss_clean will cause a performance hit.
		 * How much is dependant on how much input data there is.
		 */
		// 'input_filter'  => array(),

		/**
		 * This output filter can be any normal PHP function as well as 'xss_clean'
		 *
		 * WARNING: Using xss_clean will cause a performance hit.
		 * How much is dependant on how much input data there is.
		 */
		'output_filter'  => array('Security::htmlentities'),

		/**
		 * Encoding mechanism to use on htmlentities()
		 */
		// 'htmlentities_flags' => ENT_QUOTES,

		/**
		 * Whether to encode HTML entities as well
		 */
		// 'htmlentities_double_encode' => false,

		/**
		 * Whether to automatically filter view data
		 */
		// 'auto_filter_output'  => true,

		/**
		 * With output encoding switched on all objects passed will be converted to strings or
		 * throw exceptions unless they are instances of the classes in this array.
		 */
		'whitelisted_classes' => array(
			'Fuel\\Core\\Presenter',
			'Fuel\\Core\\Response',
			'Fuel\\Core\\View',
			'Fuel\\Core\\ViewModel',
			'Closure',
		),
	),

	/**
	 * Cookie settings
	 */
	'cookie' => array(
        'expiration' => 86400, // 1日
        'path' => '/',
        'domain' => null,
        'secure' => false,
        'http_only' => false,
    ),

	// セッション設定
    'session' => array(
        'driver' => 'cookie',
        'cookie_name' => 'fuel_session',
        'expire_on_close' => false,
        'expiration_time' => 7200, // 2時間
        'rotation_time' => 300, // 5分ごとに更新
    ),

	/**
	 * Validation settings
	 */
	// 'validation' => array(
		/**
		 * Whether to fallback to global when a value is not found in the input array.
		 */
		// 'global_input_fallback' => true,
	// ),

	/**
	 * Controller class prefix
	 */
	 // 'controller_prefix' => 'Controller_',

	/**
	 * Routing settings
	 */
	// 'routing' => array(
		/**
		 * Whether URI routing is case sensitive or not
		 */
		// 'case_sensitive' => true,

		/**
		 *  Whether to strip the extension
		 */
		// 'strip_extension' => true,
	// ),

	/**
	 * To enable you to split up your application into modules which can be
	 * routed by the first uri segment you have to define their basepaths
	 * here. By default empty, but to use them you can add something
	 * like this:
	 *      array(APPPATH.'modules'.DS)
	 *
	 * Paths MUST end with a directory separator (the DS constant)!
	 */
	// 'module_paths' => array(
	// 	//APPPATH.'modules'.DS
	// ),

	/**
	 * To enable you to split up your additions to the framework, packages are
	 * used. You can define the basepaths for your packages here. By default
	 * empty, but to use them you can add something like this:
	 *      array(APPPATH.'modules'.DS)
	 *
	 * Paths MUST end with a directory separator (the DS constant)!
	 */
	'package_paths' => array(
		PKGPATH,
	),

	/**************************************************************************/
	/* Always Load                                                            */
	/**************************************************************************/
	'always_load'  => array(

		/**
		 * These packages are loaded on Fuel's startup.
		 * You can specify them in the following manner:
		 *
		 * array('auth'); // This will assume the packages are in PKGPATH
		 *
		 * // Use this format to specify the path to the package explicitly
		 * array(
		 *     array('auth'	=> PKGPATH.'auth/')
		 * );
		 */
		'packages'  => array(
		 	'orm',
		),

		/**
		 * These modules are always loaded on Fuel's startup. You can specify them
		 * in the following manner:
		 *
		 * array('module_name');
		 *
		 * A path must be set in module_paths for this to work.
		 */
		// 'modules'  => array(),

		/**
		 * Classes to autoload & initialize even when not used
		 */
		// 'classes'  => array(),

		/**
		 * Configs to autoload
		 *
		 * Examples: if you want to load 'session' config into a group 'session' you only have to
		 * add 'session'. If you want to add it to another group (example: 'auth') you have to
		 * add it like 'session' => 'auth'.
		 * If you don't want the config in a group use null as groupname.
		 */
		// 'config'  => array(),

		/**
		 * Language files to autoload
		 *
		 * Examples: if you want to load 'validation' lang into a group 'validation' you only have to
		 * add 'validation'. If you want to add it to another group (example: 'forms') you have to
		 * add it like 'validation' => 'forms'.
		 * If you don't want the lang in a group use null as groupname.
		 */
		// 'language'  => array(),
	),
=======
    // 必ずロードする設定
    'always_load'  => array(
        'packages'  => array(
            'orm', // ORM (Object Relational Mapping) を使用
        ),
        'config'  => array(
            'db',  // データベース設定を自動で読み込む
        ),
    ),
>>>>>>> 9b6128ab66efe27283097e95392c3e1869bf60ad

);
