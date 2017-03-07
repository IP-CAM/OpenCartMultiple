<?php
// HTTP
define('HTTP_SERVER', 'http://localhost/opencart/');
define('HTTP_CATALOG', 'http://localhost/opencart/');

// HTTPS
define('HTTPS_SERVER', 'http://localhost/opencart/');
define('HTTPS_CATALOG', 'http://localhost/opencart/');

// DIR
$basedir = dirname(__FILE__);
define('DIR_APPLICATION', $basedir.'/catalog/');
define('DIR_SYSTEM', $basedir.'/system/');
define('DIR_LIBRARY', $basedir.'/library/');
define('DIR_IMAGE', $basedir.'/image/');
define('DIR_IMAGE_USER',$basedir. '/image/user/');
define('DIR_LANGUAGE',$basedir. '/catalog/language/');
define('DIR_TEMPLATE', $basedir.'/catalog/view/theme/');
define('DIR_CONFIG', $basedir.'/system/config/');
define('DIR_CACHE', $basedir.'/system/storage/cache/');
define('DIR_DOWNLOAD',$basedir. '/system/storage/download/');
define('DIR_LOGS',$basedir. '/system/storage/logs/');
define('DIR_MODIFICATION', $basedir.'/system/storage/modification/');
define('DIR_UPLOAD',$basedir. '/system/storage/upload/');

// DB
define('DB_DRIVER', 'mysqli');
define('DB_HOSTNAME', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_DATABASE', 'opencart');
define('DB_PORT', '3306');
define('DB_PREFIX', 'oc_');

//Library
define('QINIU_BASE', 'http://olvhfy18m.bkt.gdipper.com/');