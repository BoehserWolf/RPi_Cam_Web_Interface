<?php
  
  // version string
  define('APP_VERSION', 'v4.2');
  
  // name of this application
  define('APP_NAME', 'RPi Cam Control');
  
  // (long) name of this application including version string
  define('APP_NAME_LONG', APP_NAME . " " . APP_VERSION);
  
  // the host running the application
  define('HOST_NAME', php_uname('n'));
  
  // name of this camera
  define('CAM_NAME', 'mycam');
  
  // unique camera string
  define('CAM_STRING', CAM_NAME . '@' . HOST_NAME);

?>
