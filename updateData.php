<?php
/**
 * Created by JetBrains PhpStorm.
 * User: radu
 * Date: 1/28/13
 * Time: 9:53 PM
 */

require_once 'class/config.php';

$db = DataBase::getInstance();

if (isset($_POST['is_new']) && $_POST['is_new'] == true) {
    $db->insertCategory();
    $category_id = $db->getID();
} else {
    $category_id = $_POST['category'];
}

if (isset($_POST['news_id'])) {
    $news_id = $_POST['news_id'];
} else {
    $news_id = 0;
}

$db->updateNews($category_id, $news_id);

$db->updatePhoto($news_id);

header("Location: getNews.php?category_id=$category_id&news_id=$news_id");