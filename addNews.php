<?php
require_once 'class/config.php';

$db = DataBase::getInstance();

$categories = $db->getCategoryList();
?>
<html>
<head>
    <title>News</title>
    <link rel="stylesheet" href="css/style.css" type="text/css" />
    <script src="http://code.jquery.com/jquery.min.js"></script>
    <script src="js/addNews.js"></script>
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
    <div id="page_content">
        <form action="processData.php" method="post" enctype="multipart/form-data" name="addNews" id="addNews">
            <div class="field_set">
                <div class="add_news_label">
                    <label for="category">Categoria:</label>
                </div>
                <div id="category_field">
                    <select name="category" id="category" >
                        <option value=""></option>
                        <?php foreach ($categories as $category) { ?>
                            <option value="<?php echo $category['category_id']?>"><?php echo $category['category_name']?></option>
                        <?php } ?>
                        <option value="new_category">Categorie noua...</option>
                    </select>
                </div>
            </div>
            <div class="field_set">
                <div class="add_news_label">
                    <label for="title">Titlu:</label>
                </div>
                <div id="title_field">
                    <textarea name="title" id="title" cols="90">
                    </textarea>
                </div>
            </div>
            <div class="field_set">
                <div class="add_news_label">
                    <label for="content">Continut:</label>
                </div>
                <div id="content_field">
                    <textarea name="content" id="content" cols="90" rows="20">
                    </textarea>
                </div>
            </div>
            <div class="field_set">
                <div class="add_news_label">
                    <label for="photo">Adauga o poza:</label>
                </div>
                <div id="photo_field">
                    <input type="file" name="photo" id="photo" />
                </div>
            </div>
            <div class="field_set">
                <div class="add_news_label">
                    <label for="submit">&nbsp;</label>
                </div>
                <div id="submit_field">
                    <input type="submit" name="submit" id="submit" value="Adauga" />
                </div>
            </div>
        </form>
    </div>
    <div id="footer">
        Here will be the footer content...
    </div>
</div>
</body>
</html>