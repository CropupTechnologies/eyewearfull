<?php

$config['APP_CONFIG'] = 1;
define('APP_NAME', 'Eyewear');
define('APP_VERSION', '1.0 (Beta)');
define('APP_Client_Name', 'George Gooneratne Optometrists');
define('APP_Client_Email', 'service@georgegooneratne.lk');
define('CONTACT_EMAIL', 'support@eyewear.lk');


define('SERVER_ROOT_DIRECTORY', 'D:/xampp/htdocs/eyewear.lk/');
//define('SERVER_ROOT_DIRECTORY','/home/eyewear/dev.eyewear.lk/');
/*
  |--------------------------------------------------------------------------
  | Time Zone Constant
  |--------------------------------------------------------------------------
  |
  | These Constants are used when Convert Time.
  |
 */

define("GMT_TIME_ZONE", "UTC");
define("LOCAL_TIME_ZONE", "Asia/Colombo");
define("BUSINESS_TIME_ZONE", "Asia/Colombo");
//define("SERVER_TIME_ZONE","America/Chicago");
define("SERVER_TIME_ZONE", "Asia/Colombo");


define('IMAGE_UPLOAD_PATH', SERVER_ROOT_DIRECTORY.'public/runningimages/');
define('BRAND_LOGO_UPLOAD_PATH', IMAGE_UPLOAD_PATH.'brands/');
define('NEWS_UPLOAD_PATH', IMAGE_UPLOAD_PATH.'news/');
define('ITEM_UPLOAD_PATH', IMAGE_UPLOAD_PATH.'item/');
define('ITEM_IMAGE_UPLOAD_PATH', ITEM_UPLOAD_PATH.'image/');
define('ITEM_ZOOM_UPLOAD_PATH', ITEM_UPLOAD_PATH.'zoom/');
define('ITEM_THUMBNAIL_UPLOAD_PATH', ITEM_UPLOAD_PATH.'thumbnail/');
define('MODEL_UPLOAD_PATH', IMAGE_UPLOAD_PATH.'model/');
define('MODEL_IMAGE_UPLOAD_PATH', MODEL_UPLOAD_PATH.'image/');
define('MODEL_ZOOM_UPLOAD_PATH', MODEL_UPLOAD_PATH.'zoom/');
define('MODEL_THUMBNAIL_UPLOAD_PATH', MODEL_UPLOAD_PATH.'thumbnail/');
define('PRESCRIPTION_UPLOAD_PATH', IMAGE_UPLOAD_PATH.'prescription/');


define('BRAND_FIELD_ID', '3');

define('DEFAULT_CURRENCY', 'LKR');
define('APPLY_TAX_ONLINE_SALES', TRUE);

