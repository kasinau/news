<?php
require_once 'class/config.php';
session_start();
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
            <div class="header_content">
                <h1>News blog...</h1>
            </div>
            <div class="header_login">
                <?php if (isset($_SESSION['username']) && $_SESSION['status'] == 'admin') { ?>
                <a href="logout.php"><button>Logout</button></a>
                <?php } else { ?>
                <form action="login.php" method="post">
                    <label>Username: </label>
                    <input type="text" name="username" id="username" />
                    <label>Password:&nbsp;</label>
                    <input type="password" name="password" id="password" />
                    <label></label>
                    <input type="submit" name="submit" value="Login" />
                    <label><?php echo isset($_SESSION['error'])? '<br />' . $_SESSION['error']:'' ?></label>
                </form>
                <?php } ?>
            </div>
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
            <?php if (isset($_SESSION['username']) && $_SESSION['status'] == 'admin') { ?>
            <div class="menu_cell"><a href="addNews.php">Adauga o stire</a> </div>
            <?php } ?>
        </div>
        <div id="content">
            <?php foreach ($news as $news_item) { ?>
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
        </div>
        <div id="footer">
            &copy; 2013, Inga Jora
        </div>
    </div>
</body>
</html>