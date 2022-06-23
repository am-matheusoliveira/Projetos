<?php

class Pessoa{

    //aqui iremos criar 6 funções para o projeto
    //Construtor para o realizar a conexão;
    private $pdo;

    public function __construct($dbname, $host, $user, $senha){
        try{
        
            $this->pdo = new PDO("mysql:dbname=".$dbname.";host=".$host, $user, $senha);
        
        }catch(PDOException $e){

            echo('PDO Erro de conexão: '.$e->getMessage());
            exit();

        }catch(Exception $e){
            
            echo('Erros genericos: '.$e->getMessage());
            exit();

        }

    }
    //Função usada para popular a tabela de nosso exemplo;
    public function buscarDados(){
        $resConsulta = array();
        $cmd = $this->pdo->query("SELECT * FROM Pessoa ORDER BY Nome");
        //$cmd = $this->pdo->prepare("SELECT * FROM Pessoa ORDER BY Nome");
        $resConsulta = $cmd->fetchAll(PDO::FETCH_ASSOC);
        //
        return $resConsulta;

    }

    public function cadastrarPessoa($nome, $telefone, $email){
        //Aqui iremos verificar se essa nova pessoa já esta cadastrada no Banco
        $cmd = $this->pdo->prepare("SELECT Email FROM Pessoa WHERE Email = :Email");
        $cmd->bindValue(":Email", $email);
        $cmd->execute();
        
        //Verificar se o retorno de $cmd foi maior que 0;
        if($cmd->rowCount() > 0){
            return true;
        }else{
            $cmd = $this->pdo->prepare("INSERT INTO Pessoa VALUES(DEFAULT, :Nome, :Telefone, :Email)");
            $cmd->bindValue(":Nome", $nome);
            $cmd->bindValue(":Telefone", $telefone);
            $cmd->bindValue(":Email", $email);
            $cmd->execute();
            //
            return false;
        }
    }

    public function excluirPessoa($idPessoa){
        $cmd = $this->pdo->prepare("DELETE FROM Pessoa WHERE idPessoa = :idPessoa");
        $cmd->bindValue("idPessoa", $idPessoa);
        $cmd->execute();
    }

    public function buscarDadosPessoa($idPessoa){
        $res = array();
        $cmd = $this->pdo->prepare("SELECT * FROM Pessoa WHERE idPessoa = :idPessoa");
        $cmd->bindValue(":idPessoa", $idPessoa);
        $cmd->execute();
        $res = $cmd->fetch(PDO::FETCH_ASSOC);
        return $res;

    }

    public function atualizarDados($idPessoa, $nome, $telefone, $email){

        $cmd = $this->pdo->prepare("SELECT Email FROM Pessoa WHERE Email = :Email AND idPessoa NOT IN($idPessoa)");
        $cmd->bindValue(":Email", $email);
        $cmd->execute();
        
        //Verificar se o retorno de $cmd foi maior que 0 e se o email do usuario e diferente ou o mesmo digitado
        if($cmd->rowCount() > 0){
            return true;
        }else{
            $cmd = $this->pdo->prepare("UPDATE Pessoa SET Nome = :Nome, Telefone = :Telefone, Email = :Email WHERE idPessoa = :idPessoa");
            $cmd->bindValue(":idPessoa", $idPessoa);
            $cmd->bindValue(":Nome", $nome);
            $cmd->bindValue(":Telefone", $telefone);
            $cmd->bindValue(":Email", $email);
            $cmd->execute();
            //
            return false;
        }

    }
}

//verificar apenas outros usuario menos o atual;

?>