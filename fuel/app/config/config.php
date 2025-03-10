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

    // バリデーションの設定
    'validation' => array(
        'global_input_fallback' => true, // 入力値のグローバルフェイルバック
    ),

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

    // 必ずロードする設定
    'always_load'  => array(
        'packages'  => array(
            'orm', // ORM (Object Relational Mapping) を使用
        ),
        'config'  => array(
            'db',  // データベース設定を自動で読み込む
        ),
    ),

);
