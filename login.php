<?php
/**
 * Created by JetBrains PhpStorm.
 * User: radu
 * Date: 1/29/13
 * Time: 9:46 PM
 */

require_once 'class/config.php';
session_start();
$db = DataBase::getInstance();

$user = $db->getUser();
if ($user) {
    $_SESSION['username'] = $user['username'];
    $_SESSION['status'] = $user['status'];
} else {
    $_SESSION['error'] = 'Date incorete';
}

header('Location: index.php');