<?php
require_once 'class/config.php';

$db = DataBase::getInstance();

$categories = $db->getCategoryList();

$news_item = $db->getNewsByID($_GET['news_id']);
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
        <form action="updateData.php" method="post" enctype="multipart/form-data" name="editNews" id="editNews">
            <input type="hidden" name="news_id" value="<?php echo $news_item['news_id'] ?>" />
            <div class="field_set">
                <div class="add_news_label">
                    <label for="category">Categoria:</label>
                </div>
                <div id="category_field">
                    <select name="category" id="category" >
                        <option value="<?php echo $news_item['category_id'] ?>"><?php echo $news_item['category_name'] ?></option>
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
                        <?php echo $news_item['title'] ?>
                    </textarea>
                </div>
            </div>
            <div class="field_set">
                <div class="add_news_label">
                    <label for="content">Continut:</label>
                </div>
                <div id="content_field">
                    <textarea name="content" id="content" cols="90" rows="20">
                        <?php echo $news_item['content'] ?>
                    </textarea>
                </div>
            </div>
            <div class="field_set">
                <div class="add_news_label">
                    <label for="content">Imagine:</label>
                </div>
                <div id="uploaded_file_field">
                    <img src="<?php echo $news_item['photo'] ?>" width="300px" />
                </div>
            </div>
            <div class="field_set">
                <div class="add_news_label">
                    <label for="photo">Schimba poza:</label>
                </div>
                <div id="photo_field">
                    <input type="file" name="photo" id="photo" />
                    <input type="hidden" name="old_photo" value="<?php echo $news_item['photo'] ?>" />
                </div>
            </div>
            <div class="field_set">
                <div class="add_news_label">
                    <label for="submit">&nbsp;</label>
                </div>
                <div id="submit_field">
                    <input type="submit" name="submit" id="submit" value="Editeaza" />
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