<?php
/**
 * Created by JetBrains PhpStorm.
 * User: radu
 * Date: 1/29/13
 * Time: 9:53 PM
 */
session_start();
unset($_SESSION);
session_destroy();

header('Location: index.php');