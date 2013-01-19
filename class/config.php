<?php
/**
 * Created by JetBrains PhpStorm.
 * User: radu
 * Date: 1/19/13
 * Time: 4:41 PM
 */

define("SMARTY_PATH", "../Smarty-3.1.8/libs/");
define("CLASS_PATH", "class/");

function autoload($className)
{
    if (strstr($className, 'Smarty')) {
        if ($className == 'Smarty') {
            require_once (SMARTY_PATH . $className . ".class.php");
        }
        else {
            require_once (SMARTY_PATH . "sysplugins/" . strtolower($className) . ".php");
        }
    }
    else
        require_once (CLASS_PATH . $className . ".class.php");
}

spl_autoload_register('autoload');