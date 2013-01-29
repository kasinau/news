<?php
/**
 * Created by JetBrains PhpStorm.
 * User: radu
 * Date: 1/29/13
 * Time: 9:55 PM
 */

require_once 'class/config.php';

$db = DataBase::getInstance();
$db->insertUser();

header('Location: index.php');