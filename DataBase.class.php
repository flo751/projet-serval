<?php 

class DataBase extends PDO{
 
 private $_host='localhost';
 private $_username = 'root';
 private $_password ='root';
 private $_database = 'fpview';

public function __construct(){
     //cela me permet si jai une nouvelle base de donnée d'insrer les valeurs directement sans reprendre la connection
         $this->_host;
         $this->_username;
         $this->_password;
         $this->_database;

     try{

    parent:: __construct('mysql:host='.$this->_host.';dbname='.$this->_database, $this->_username , $this->_password, array(
        PDO::MYSQL_ATTR_INIT_COMMAND =>'SET NAMES UTF8',
        PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
     

     }catch(PDOException $e){
         die('impossible de se connecter a la base de donnée');
     }

 }
}

?>