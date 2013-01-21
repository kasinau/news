<?php
/**
 * Created by JetBrains PhpStorm.
 * User: radu
 * Date: 1/21/13
 * Time: 10:46 PM
 */

require_once 'class/config.php';

$db = DataBase::getInstance();

if (isset($_POST['is_new']) && $_POST['is_new'] == true) {
    $db->insertCategory();
    $category_id = $db->getID();
} else {
    $category_id = $_POST['category'];
}

$db->insertNews($category_id);

$news_id = $db->getID();

$db->insertPhoto($news_id);