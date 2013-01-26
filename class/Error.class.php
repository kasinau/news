<?php
/**
 * Created by JetBrains PhpStorm.
 * User: radu
 * Date: 1/26/13
 * Time: 4:17 PM
 */

require_once 'class/config.php';
class Error
{

    function __construct()
    {

    }

    public function setFieldError($index, $error)
    {
        $_SESSION['errors'][$index] = $error;
    }

    public function setField($index)
    {
        if (isset($_POST[$index])) {
            $_SESSION['fields'][$index] = $_POST[$index];
        }
        else {
            $_SESSION['fields'][$index] = '';
        }
    }

    public function getError($index)
    {
        if (isset($_SESSION['errors'][$index])) {
            return $_SESSION['errors'][$index];
        }
        else return '';
    }

    public function getField($index)
    {
        if (isset($_SESSION['fields'][$index])) {
            return $_SESSION['fields'][$index];
        }
        else return '';
    }
}