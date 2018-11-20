<?php

class Conexao
{
   private static $connection;
   private function __construct(){}
   public static function getConnection() {
       $stringConn  = "mysql:host=localhost:3306;dbname=cadpale;";
       try {
           if(!isset($connection)){
               $connection =  new PDO($stringConn, "root", "123456");
               $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
           }
           return $connection;
       } catch (PDOException $e) {
           $mensagem = "Situation: " . implode(",", PDO::getAvailableDrivers());
           $mensagem .= "\nErro: " . $e->getMessage();
           throw new Exception($mensagem);
       }
       finally{
       }
   }
}
