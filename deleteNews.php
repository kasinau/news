<?php
/**
 * Created by JetBrains PhpStorm.
 * User: radu
 * Date: 1/27/13
 * Time: 10:16 AM
 */

require_once 'class/config.php';

$db = DataBase::getInstance();

$news_id = $_GET['news_id'];
$photoCollection = $db->getPhotoByNewsID($news_id);
$photo = $photoCollection['photo'];

$db->deleteNews($news_id);
$db->deletePhoto($news_id, $photo);

header("Location: index.php");