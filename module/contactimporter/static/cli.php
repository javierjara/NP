<?php
/**
 * Key to include phpFox
 *
 */
define('PHPFOX', true);
define('PHPFOX_NO_SESSION',true);
define('PHPFOX_NO_USER_SESSION',true);
ob_start();
/**
 * Directory Seperator
 *
 */
define('PHPFOX_DS', DIRECTORY_SEPARATOR);

/**
 * phpFox Root Directory
 *
 */
define('PHPFOX_DIR', dirname(dirname(dirname(dirname(__FILE__)))) . PHPFOX_DS);
// Require phpFox Init

include PHPFOX_DIR .PHPFOX_DS.'include'.PHPFOX_DS.'init.inc.php';