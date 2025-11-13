<?php
namespace APP\DAO;

use PDO;

abstract class conexao{

    protected $pdo;

    public function __construct(){
        $host=getenv("HOST");
        $dbname=getenv("DBNAME");
        $user=getenv("USER");
        $pass = getenv("PASSWORD");
        $port = getenv("PORT");

        $conn="mysql:host={$host}; dbname={$dbname}; port{$port}";
        $this->pdo= new pdo($conn, $user, $pass);
    
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

}
?>