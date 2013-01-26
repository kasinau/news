<?php
require_once 'class/config.php';

$db = DataBase::getInstance();

$categories = $db->getCategoryList();
$news = $db->getLastNews();
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
            <?php foreach ($news as $news_item) { ?>
            <div class="news_item">
                <a href="getNews.php?category_id=<?php echo $news_item['category_id'] ?>&news_id=<?php echo $news_item['category_id'] ?>">
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
        </div>
        <div id="footer">
            Here will be the footer content...
        </div>
    </div>
</body>
</html>