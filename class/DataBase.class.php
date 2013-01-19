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
    private $user = 'root', $password = 'root', $dsn = "mysql:dbname=news;host=127.0.0.1";

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
            return $query->fetch();
        } catch (PDOException $e){
            $this->setError($e->getMessage(), 'Can not get the ID...');
        }
    }

    public function getNewsByID($id)
    {
        try {
            $query = $this->dbh->prepare('SELECT * FROM News, Category
                WHERE news_id = :news_id AND News.category_id = Category.category_id');
            $query->bindParam(':news_id', $id);
            $query->execute();
            return $query->fetch();
        }
        catch (PDOException $e){
            $this->setError($e->getMessage(), 'Can not get news...');
        }
    }

    public function getNewsByCategoryID($id)
    {
        try {
            $query = $this->dbh->prepare('SELECT * FROM News
                WHERE category_id = :category_id');
            $query->bindParam(':category_id', $id);
            $query->execute();
            return $query->fetch();
        } catch (PDOException $e){
            $this->setError($e->getMessage(), 'Can not get news...');
        }
    }

    public function getCountriesIdentifiers()
    {
        try {
            $query = $this->dbh->query('call getCountriesIdentifiers()');
            return $query->fetchAll();
        } catch (PDOException $e){
            $this->setError($e->getMessage(), "Can not to get countries' identifiers...");
        }
    }

    public function getContent()
    {
        try {
            $query = $this->dbh->query('call getContent()');
            return $query->fetchAll();
        } catch (PDOException $e){
            $this->setError($e->getMessage(), 'Can not get content...');
        }
    }

    public function getTreatyDetails($treatyID)
    {
        try {
            $query = $this->dbh->prepare('call getTreatyDetails(:treatyID)');
            $query->bindParam(':treatyID', $treatyID);
            $query->execute();
            return $query;
        } catch (PDOException $e){
            $this->setError($e->getMessage(), 'Can not get the treaty details...');
        }
    }

    public function getTreaty($treatyID)
    {
        try {
            $query = $this->dbh->prepare('call getTreaty(:treatyID)');
            $query->bindParam(':treatyID', $treatyID);
            $query->execute();
            return $query;
        } catch (PDOException $e){
            $this->setError($e->getMessage(), 'Can not get the treaty...');
        }
    }

    public function getUser()
    {
        try {
            $query = $this->dbh->prepare('call getUser(:username, :password)');
            $query->bindParam(':username', $_POST['username']);
            $query->bindParam(':password', md5($_POST['password']));
            $query->execute();
            return $query;
        } catch (PDOException $e){
            $this->setError($e->getMessage(), 'Can not get the user...');
        }
    }


    public function insertChapter($chapterNo, $chapterName)
    {
        try {
            $query = $this->dbh->prepare('call insertChapter(:chapterNo, :chapterName)');
            $query->bindParam(':chapterNo', $chapterNo);
            $query->bindParam(':chapterName', $chapterName);
            $query->execute();
        } catch (PDOException $e){
            $this->setError($e->getMessage(), 'Can not insert chapter...');
        }
    }


    public function insertUser($username, $password)
    {
        try {
            $query = $this->dbh->prepare('call insertUser(:username, :password)');
            $query->bindParam(':username', $username);
            $query->bindParam(':password', md5($password));
            $query->execute();
        } catch (PDOException $e){
            $this->setError($e->getMessage(), 'Can not insert the user...');
        }
    }

    public function insertCountry($countryName, $countryIdentifier)
    {
        try {
            $query = $this->dbh->prepare("call insertCountry(:countryName, :countryIdentifier)");
            $query->bindParam(":countryName", $countryName);
            $query->bindParam(":countryIdentifier", $countryIdentifier);
            $query->execute();
        } catch (PDOException $e){
            $this->setError($e->getMessage(), 'Can not insert country...');
        }
    }

    public function insertCountryIdentifier($countryIdentifier, $countryName)
    {
        try {
            $query = $this->dbh->prepare("call insertCountryIdentifier(:countryIdentifier, :countryName)");
            $query->bindParam(":countryIdentifier", $countryIdentifier);
            $query->bindParam(":countryName", $countryName);
            $query->execute();
        } catch (PDOException $e){
            $this->setError($e->getMessage(), 'Can not insert country identifier...');
        }
    }

    public function insertTreaty($chapterID, $title, $conclusionDate, $conclusionPlace, $EFDate,
                                 $EFText, $registrationDate, $registrationNo, $treatyText, $fullTreatyText, $note)
    {
        try {
            $query = $this->dbh->prepare('call insertTreaty(:chapterID, :title, :conclusionDate,
                                :conclusionPlace, :EFDate, :EFText, :registrationDate, :registrationNo,
                                :treatyText, :fullTreatyText, :note)');
            $query->bindParam(':chapterID', $chapterID);
            $query->bindParam(':title', $title);
            $query->bindParam(':conclusionDate', $conclusionDate);
            $query->bindParam(':conclusionPlace', $conclusionPlace);
            $query->bindParam(':EFDate', $EFDate);
            $query->bindParam(':EFText', $EFText);
            $query->bindParam(':registrationDate', $registrationDate);
            $query->bindParam(':registrationNo', $registrationNo);
            $query->bindParam(':treatyText', $treatyText);
            $query->bindParam(':fullTreatyText', $fullTreatyText);
            $query->bindParam(':note', $note);
            $query->execute();
        } catch (PDOException $e){
            $this->setError($e->getMessage(), 'Can not insert treaty...');
        }
    }

    public function checkCTreaty($treatyID, $countryID)
    {
        try {
            $query = $this->dbh->prepare('call checkCTreaty(:treatyID, :countryID)');
            $query->bindParam(':treatyID', $treatyID);
            $query->bindParam(':countryID', $countryID);
            $query->execute();
            return $query->fetch();
        } catch (PDOException $e){
            $this->setError($e->getMessage(), 'Can not check treaty...');
        }
    }

    public function insertCTreaty($treatyID, $countryID, $signature, $ratification, $details)
    {
        try {
            $query = $this->dbh->prepare('call insertCTreaty(:treatyID, :countryID,
                                :signature, :ratification, :details)');
            $query->bindParam(':treatyID', $treatyID);
            $query->bindParam(':countryID', $countryID);
            $query->bindParam(':signature', $signature);
            $query->bindParam(':ratification', $ratification);
            $query->bindParam(':details', $details);
            $query->execute();
        } catch (PDOException $e){
            $this->setError($e->getMessage(), 'Can not insert cTreaty...');
        }
    }

    public function updateCTreaty($cTreatyID, $signature, $ratification, $details)
    {
        try {
            $query = $this->dbh->prepare('call updateCTreaty(:cTreatyID, :signature, :ratification, :details)');
            $query->bindParam(':cTreatyID', $cTreatyID);
            $query->bindParam(':signature', $signature);
            $query->bindParam(':ratification', $ratification);
            $query->bindParam(':details', $details);
            $query->execute();
        } catch (PDOException $e){
            $this->setError($e->getMessage(), 'Can not update treaty...');
        }
    }

    public function setError($error, $errorMessage = '')
    {
        error_log("\n" . date('Y-m-d H:i:s') . ' ' . $error, 3, "my_errors.log");
        exit();
    }
}
