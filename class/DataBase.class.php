<?php
/**
 * Created by JetBrains PhpStorm.
 * User: radu
 * Date: 1/19/13
 * Time: 4:48 PM
 */

if (!isset($_SESSION)) {
    session_start();
}

require_once 'class/config.php';

define("DB_HOSTNAME", "127.0.0.1");
define("DB_USERNAME", "root");
define("DB_PASSWORD", "root");
define("DB_DATABASE", "news");

class DataBase
{
    private $db_server, $connection = null, $dbh;
    public $result;
    private static $instance = null;
    private $user = 'root', $password = '', $dsn = "mysql:dbname=news;host=127.0.0.1";

    private function __construct()
    {
        try {
            $this->dbh = new PDO($this->dsn, $this->user, $this->password, array(PDO::ATTR_PERSISTENT => true));
            if (!$this->dbh) {
                throw new Exception('Conection failed, please, try again later...');
            }

            $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->dbh->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (PDOException $e) {

            $this->setError($e->getMessage());
        }
    }

    public static function getInstance()
    {
        if (!isset(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getID()
    {
        try {
            $query = $this->dbh->query('SELECT LAST_INSERT_ID();');
            $result = $query->fetch();
            return $result['LAST_INSERT_ID()'];
        } catch (PDOException $e){
            $this->setError($e->getMessage(), 'Can not get the ID...');
        }
    }

    public function getCategoryID()
    {
        try {
            $query = $this->dbh->prepare('SELECT id
                FROM Category
                WHERE category_name = :category_name');
            $query->bindParam(':category_name', $_POST['category_name']);
            $query->execute();
            if ($query) {
                return $query->fetch();
            } else {
                $this->insertCategory();
                return $this->getID();
            }
        }
        catch (PDOException $e){
            $this->setError($e->getMessage(), 'Can not get news...');
        }
    }

    public function getCategoryList()
    {
        try {
            $query = $this->dbh->query('SELECT *
                FROM Category');
            return $query->fetchAll();
        }
        catch (PDOException $e){
            $this->setError($e->getMessage(), 'Can not get news...');
        }
    }

    public function getLastNews()
    {
        try {
            $query = $this->dbh->query('SELECT *
                FROM News, Photo, Category
                WHERE
                  News.news_id = Photo.news_id
                  AND Category.category_id = News.category_id
                ORDER BY date
                LIMIT 10');
            return $query->fetchAll();
        } catch (PDOException $e){
            $this->setError($e->getMessage(), 'Can not get the ID...');
        }
    }

    public function getNewsByID($id)
    {
        try {
            $query = $this->dbh->prepare('SELECT *
                FROM News, Category, Photo
                WHERE News.news_id = :news_id
                    AND News.category_id = Category.category_id
                    AND News.news_id = Photo.news_id');
            $query->bindParam(':news_id', $id);
            $query->execute();
            return $query->fetch();
        }
        catch (PDOException $e){
            echo $e->getMessage(); die;
            $this->setError($e->getMessage(), 'Can not get news...');
        }
    }

    public function getPhotoByNewsID($id)
    {
        try {
            $query = $this->dbh->prepare('SELECT *
                FROM Photo
                WHERE news_id = :news_id');
            $query->bindParam(':news_id', $id);
            $query->execute();
            return $query->fetch();
        }
        catch (PDOException $e){
            echo $e->getMessage(); die;
            $this->setError($e->getMessage(), 'Can not get news...');
        }
    }

    public function getNewsByCategoryID($id)
    {
        try {
            $query = $this->dbh->prepare('SELECT *
                FROM News, Photo
                WHERE category_id = :category_id
                    AND News.news_id = Photo.news_id
                ORDER BY date');
            $query->bindParam(':category_id', $id);
            $query->execute();
            return $query->fetchAll();
        } catch (PDOException $e){
            $this->setError($e->getMessage(), 'Can not get news...');
        }
    }

    public function getUser()
    {
        try {
            $query = $this->dbh->prepare('SELECT * FROM users ' .
                ' WHERE username=:username AND password=:password');
            $query->bindParam(':username', $_POST['username']);
            $query->bindParam(':password', md5($_POST['password']));
            $query->execute();
            return $query->fetch();
        } catch (PDOException $e){
            $this->setError($e->getMessage(), 'Can not get the user...');
        }
    }


    public function insertUser()
    {
        try {
            $query = $this->dbh->prepare('INSERT INTO users(username, password, status) ' .
                'VALUES("admin", :password, "admin")');
 //           $query->bindParam(':username', 'admin');
            $query->bindParam(':password', md5('1491625'));
 //           $query->bindParam(':status', 'admin');
            $query->execute();
        } catch (PDOException $e){
            $this->setError($e->getMessage(), 'Can not insert the user...');
        }
    }


    public function insertCategory()
    {
        try {
            $query = $this->dbh->prepare('INSERT INTO Category(category_name)' .
                'VALUES(:category_name)');
            $query->bindParam(':category_name', $_POST['category']);
            $query->execute();
        } catch (PDOException $e){
            $this->setError($e->getMessage(), 'Can not insert category...');
        }
    }

    public function insertNews($category_id)
    {
        try {
            $query = $this->dbh->prepare('INSERT INTO News(category_id, title, content)' .
                'VALUES(:category_id, :title, :content)');
            $query->bindParam(':category_id', $category_id);
            $query->bindParam(':title', $_POST['title']);
            $query->bindParam(':content', $_POST['content']);
            $query->execute();
        } catch (PDOException $e){
            $this->setError($e->getMessage(), 'Can not insert treaty...');
        }
    }

    public function insertPhoto($news_id)
    {
        try {
            $ext = pathinfo($_FILES["photo"]["name"], PATHINFO_EXTENSION);
            //          $photo = "photo/" . $_POST['category'] . '_' . $_POST['title'] . '_' . time() . "." . $ext;
            $photo = "photo/" . time() . "." . $ext;

            $query = $this->dbh->prepare('INSERT INTO Photo(news_id, photo)' .
                'VALUES(:news_id, :photo)');
            $query->bindParam(':news_id', $news_id);
            $query->bindParam(':photo', $photo);
            $query->execute();
            move_uploaded_file($_FILES["photo"]["tmp_name"], $photo);
            return true;
        }
        catch (PDOException $e){
            $this->setError($e->getMessage(), 'Can not insert photo...please, try again later...');
        }
    }

    public function updateNews($category_id, $news_id)
    {
        try {
            $query = $this->dbh->prepare('UPDATE News SET category_id=:category_id, ' .
                ' title=:title, content=:content WHERE news_id=:news_id');
            $query->bindParam(':category_id', $category_id);
            $query->bindParam(':title', $_POST['title']);
            $query->bindParam(':content', $_POST['content']);
            $query->bindParam(':news_id', $news_id);
            $query->execute();
        } catch (PDOException $e){
            $this->setError($e->getMessage(), 'Can not insert treaty...');
        }
    }

    public function updatePhoto($news_id)
    {
        try {
            if (!empty($_FILES["photo"]) && $_FILES["photo"]["size"]!=0) {
                if (file_exists($_POST['old_photo']))
                    unlink($_POST['old_photo']);
                $ext = pathinfo($_FILES["photo"]["name"], PATHINFO_EXTENSION);
                $photo = "photo/" . time() . "." . $ext;

                $query = $this->dbh->prepare('UPDATE Photo SET photo = :photo ' .
                    'WHERE news_id = :news_id');
                $query->bindParam(':photo', $photo);
                $query->bindParam(':news_id', $news_id);
                $query->execute();
                move_uploaded_file($_FILES["photo"]["tmp_name"], $photo);
                return true;
            }
        }
        catch (PDOException $e){
            $this->setError($e->getMessage(), 'Can not insert photo...please, try again later...');
        }
    }

    public function deleteNews($news_id)
    {
        try {
            $query = $this->dbh->prepare('DELETE FROM News WHERE news_id=:news_id');
            $query->bindParam(':news_id', $news_id);
            $query->execute();
        } catch (PDOException $e){
            $this->setError($e->getMessage(), 'Can not delete news...');
        }
    }

    public function deletePhoto($news_id, $photo)
    {
        try {
            if (file_exists($photo))
                unlink($photo);

            $query = $this->dbh->prepare('DELETE FROM Photo WHERE news_id = :news_id');
            $query->bindParam(':news_id', $news_id);
            $query->execute();
            return true;
        }
        catch (PDOException $e){
            $this->setError($e->getMessage(), 'Can not delete photo...please, try again later...');
        }
    }

    public function setError($error, $errorMessage = '')
    {
        error_log("\n" . date('Y-m-d H:i:s') . ' ' . $error, 3, "my_errors.log");
        exit();
    }
}
