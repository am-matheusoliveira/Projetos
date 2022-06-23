<?php
  
  try{    
      /*
      $dbname   = "login";
      $host     = "localhost";
      $user     = "root";
      $password = "Manaus@2020"    
	    $conexao = new PDO("mysql:dbname=$dbname;host=$host", $user, $password);*/
      //OU
      //$conexao = new PDO("mysql:dbname=CRUDPDO;host=localhost;","root","Manaus@2020");
      //Bloco abaixo seria necessario se não estivessimos usando o 'Try Catch'
	    //or die ('Erro ao realizar conexão com o Banco de Dados!'. mysql_error());

      //$query = array('usuario'=>'Mariano', 'senha'=>'Maranhao@2021');
      //$conexao->prepare('INSERT INTO usuario VALUES(DEFAULT, :usuario, MD5(:senha))')->execute($query)    
      
      /*foreach($query as $chave => $value){
          echo("Posição: $chave <br/> Valor: $value <br/><br/>");
      }*/

      //-----------------------INSERT PDO E MYSQL----------------------------//  
      /*$instrucao = $conexao->prepare("INSERT INTO Pessoa VALUES(Default, :nome, :telefone, :email)");
      $instrucao->bindValue(":nome", "Matheus Oliveira");
      $instrucao->bindValue(":telefone", "(98) 99204-0072");
      $instrucao->bindValue(":email", "matheusoliveira@gmail.com");
      // 1º alternativa ou como visto abaixo
      $instrucao->execute(); */     
      
      // Ou 2º alternativa
      //$banco = new PDO('mysql:host=localhost;dbname=nome_do_banco', 'username','password');
      //$novo_cliente = array('nome'=>'José','departamento'=>'TI','unidade'=>'Paulista');
      //$banco->prepare('INSERT INTO clientes (nome,departamento,unidade) VALUES (:nome,:departamento,:unidade)')->execute($novo_cliente);
    
      // Variaveis para o uso do metodo bindParam()
      /*$instrucao = $conexao->prepare("INSERT INTO Pessoa VALUES(Default, :nome, :telefone, :email)");
      $nome     = "Matheus Oliveira";
      $telefone = "(92) 99204-0072";
      $email    = "matheusoliveira@gmail.com";
      //
      $instrucao->bindParam(":nome", $nome);
      $instrucao->bindParam(":telefone", $telefone);
      $instrucao->bindParam(":email", $email);
      $instrucao->execute();*/
       
      //$conexao->query("INSERT INTO Pessoa VALUES(Default, 'Matheus Oliveira Pereira', '(92) 999204-0072', 'sap.matheusoliveira@gmail.com')");

      /*$cmd = $conexao->prepare("DELETE FROM Pessoa WHERE idPessoa > :idPessoa");
      $cmd->bindValue("idPessoa", 1);
      $cmd->execute();*/

      //$conexao->query("DELETE FROM Pessoa WHERE idPessoa =  7");
      
      /*$cmd = $conexao->prepare("UPDATE Pessoa SET email = :email WHERE idPessoa = :idPessoa");
      $cmd->bindValue(":email", "matheusoliveira@gmail.com");
      $cmd->bindValue(":idPessoa", 10);
      $cmd->execute();*/
      
      //$conexao->query("UPDATE Pessoa SET email = 'matheusoliveira@outlook.com' WHERE idPessoa = '11'");
      
      //---------------------------------COMANDO SELECT COM PDO PHP---------------------------------------//
      //Conexão
      $conexao = new PDO("mysql:dbname=crudpdo;host=localhost", "root", "");
      //
      //Comandos para acesso ao bando de dados
      $cmd = $conexao->prepare("SELECT * FROM Pessoa WHERE idPessoa = :idPessoa");
      $cmd->bindValue(":idPessoa", 8);
      $cmd->execute();
      // Lembrando que devemos usar FETCH OU FETCHALL Variando da Consulta e qtd registro Retornado;
      //1º Forma para transformar o resultado desse SELECT em um Tipo Array.
      $registros = $cmd->fetch(PDO::FETCH_ASSOC); // Aqui retornaremos apenas uma unica linha de nosso SELECT
      //A função 'fetch e fetchAll tem varios parametros como a seguir ==>' (PDO::FETCH_ASSOC)
      //Na documentação temos varios outros parametros que podem ser usados;
      //Devemos ficar atentos que com esse FETCH Ele vai nos retornar tanto o nome da Coluna como o 
      //A posição da Coluna no Arry 
      //2º Forma para tranformar o resultado desse SELECT em um Tipo Array.
      //$resultadoTodosRegistro = $cmd->fetchAll(); // Aqui retornaremos todas as linhas de nosso SELECT
      /*echo("<pre>");
      print_r($registros);
      echo("</pre>");
      echo('<br/>');
      echo('<br/>');*/

      foreach($registros as $key => $value){
          echo($key.": ".$value."<br/>");
      }
      /*
      echo("<pre>");
      print_r($resultadoTodosRegistro);
      echo("</pre>");*/
      //Obs: as Funções var_dump e print_r são somente usadas para teste equanto desenvolvemos
      //Não são usadas na programção e sim para teste equanto desenvolvemos
      
  }
  catch(PDOException $e){ 
    echo('Erro ao realizar conexão com o Banco de Dados: '.$e->getMessage());
  }
  catch(Exception $e){
    echo('Erro genérico: '.$e->getMessage());
  }

?>