<?php     

    $DB_HOST = "localhost";
    $DB_NAME = "course_db";
    $DB_USER = "root";
    $DB_PWD  = "";

    try{
        $connection = new PDO("mysql:host=$DB_HOST;dbname=$DB_NAME", $DB_USER, $DB_PWD,
        array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES UTF8"));
        
    }catch(Exception $erro){
        
        echo("Erro: Não foi possivel se conectar com a base de dados - $DB_NAME <br> Causa: ". $erro->getMessage());
        
        exit();
    }catch(PDOException $erro){
        
        echo("Erro: Não foi possivel se conectar com a base de dados - $DB_NAME <br> Causa: ". $erro->getMessage());
        
        exit();
    }

?>
