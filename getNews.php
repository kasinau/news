<?php
require_once 'class/config.php';

$db = DataBase::getInstance();

$categories = $db->getCategoryList();
if (isset($_GET['news_id']) && (!empty($_GET['news_id']))) {
    $news_item = $db->getNewsByID($_GET['news_id']);
    $x = 1;
} else {
    $newsByCategory = $db->getNewsByCategoryID($_GET['category_id']);
}

?>
<html>
<head>
    <title>News</title>
    <link rel="stylesheet" href="css/style.css" type="text/css" />
</head>
<body>
<div id="container">
    <div id="header">
        <h1>News blog...</h1>
    </div>
    <div id="menu_bar">
        <div class="menu_cell"><a href="index.php">Acasa</a> </div>
        <?php foreach ($categories as $category) { ?>
        <div class="menu_cell">
            <a href="getNews.php?category_id=<?php echo $category['category_id'] ?>">
                <?php echo $category['category_name'] ?>
            </a>
        </div>
        <?php } ?>
        <div class="menu_cell"><a href="addNews.php">Adauga o stire</a> </div>
    </div>
    <div id="content">
        <?php if (isset($_GET['news_id']) && (!empty($_GET['news_id']))) { ?>
            <div class="news_item">
                <div class="news_item_title">
                    <h2><?php echo $news_item['title'] ?></h2>
                </div>
                <img align="left" src="<?php echo $news_item['photo'] ?>" width="400px" style="margin-right: 10px; margin-bottom: 10px" ">
                <?php echo $news_item['content'] ?>
                <br />
                <a href="editNews.php?news_id=<?php echo $_GET['news_id'] ?>">
                    <button>Edit news...</button>
                </a>
                <a href="deleteNews.php?news_id=<?php echo $_GET['news_id'] ?>">
                    <button>Delete news...</button>
                </a>
            </div>
        <?php } else { ?>
        <?php foreach ($newsByCategory as $news_item) { ?>
            <div class="news_item">
                <a href="getNews.php?category_id=<?php echo $news_item['category_id'] ?>&news_id=<?php echo $news_item['news_id'] ?>">
                    <div class="news_item_title">
                        <h2><?php echo$news_item['title'] ?></h2>
                    </div>
                </a>
                <div class="news_item_img">
                    <img src="<?php echo $news_item['photo']?>" width="100px" />
                </div>
                <div class="news_item_text">
                    <?php echo $news_item['content']?>
                </div>
            </div>
            <hr />
            <br />
            <?php } ?>
        &nbsp;
        <?php } ?>
        &nbsp;
    </div>
    <div id="footer">
        Here will be the footer content...
    </div>
</div>
</body>
</html>