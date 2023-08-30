
<?php

class Database
{
    private $pdo;

    public function __construct()
    {
        try {
            $dbhost = 'localhost';     //  hostname
            $dbname = 'eli_db';        //  databasename
            $user = 'eliz';            //  username
            $password = '111';         //  password

            $dsn = "mysql:host=$dbhost;dbname=$dbname;charset=UTF8"; // define host name and database name
            $pdo = new PDO($dsn, $user, $password);
            $this->pdo = $pdo;
            if(!$pdo) { echo "nnnnnnnoooo";}
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->exec("SET CHARACTER SET utf8");  //  return all sql requests as UTF-8  
        } catch (PDOException $err) {
            echo "harmless error message if the connection fails";
            $err->getMessage() . "<br/>";
            file_put_contents('PDOErrors.txt', $err, FILE_APPEND);  // write some details to an error-log outside public_html  
            die();  //  terminate connection
        }
    }

    public function pdo()
    {
        return $this->pdo;
    }
}

?>