<?php
    require_once('classe-pessoa.php'); 
    $nPessoa = new Pessoa("crudpdo","localhost","root","");
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de pessoas</title>
    <link rel="stylesheet" href="./css/estilo.css">
</head>
<body>
    <div class="container">
      <?php
        if(isset($_POST['nome'])){ //Esse nome e do input podemos dentre eles escolhe um para fazer a operação.  
          if(isset($_GET['idPessoaUpdate'])){ //ATUALIZANDO
            $idPessoa = addslashes($_GET['idPessoaUpdate']);
            $nome     = addslashes($_POST['nome']);
            $telefone = addslashes($_POST['telefone']);
            $email    = addslashes($_POST['email']);
            //
            if(!empty($nome) && !empty($telefone) && !empty($email)){
                if($nPessoa->atualizarDados($idPessoa, $nome, $telefone, $email)){    
                  echo('<div class="aviso">');
                    echo('<img src="./img/aviso.png"/>');
                    echo('<h4>Email ja esta cadastado!</h4>');
                  echo('</div>');
                }else{
                  header("Location: index.php");
                }
            }else{
                echo('<div class="aviso">');
                  echo('<img src="./img/aviso.png"/>');
                  echo('<h4>Preencha todos os campos!</h4>');
                echo('</div>');
            }
          }else{ //INSERINDO
            $nome     = addslashes($_POST['nome']);
            $telefone = addslashes($_POST['telefone']);
            $email    = addslashes($_POST['email']);
            //Verificar se os valores passados são vazios ou não;
            if(!empty($nome) && !empty($telefone) && !empty($email)){
              if($nPessoa->cadastrarPessoa($nome, $telefone, $email)){
                echo('<div class="aviso">');
                  echo('<img src="./img/aviso.png"/>');
                  echo('<h4>Email ja esta cadastado!</h4>');
                echo('</div>');
              }
            }else{
                echo('<div class="aviso">');
                  echo('<img src="./img/aviso.png">');
                  echo('<h4>Preencha todos os campos!</h4>');
                echo('</div>');
            }
          }
        }          
        
        //Aqui vamos realiar a busca das informações para colocá las nos inpus do formulário
        if(isset($_GET['idPessoaUpdate'])){
          $idPessoa = addslashes($_GET['idPessoaUpdate']);
          $res = $nPessoa->buscarDadosPessoa($idPessoa);
        }
      ?>
      <!---->    
      <section id="esquerda">
          <form method="POST">
            <h2>CADASTRAR PESSOA</h2>
            <!---->
            <label for="nome">Nome</label>
            <input type="text" name="nome" id="nome"         value="<?php if(isset($res)){echo($res['Nome']);}?>">
            <!---->
            <label for="telefone">Telefone</label>
            <input type="text" name="telefone" id="telefone" value="<?php if(isset($res)){echo($res['Telefone']);}?>">
            <!---->
            <label for="email">Email</label>
            <input type="email" name="email" id="email"      value="<?php if(isset($res)){echo($res['Email']);}?>">
            <!---->
            <input type="submit"                             value="<?php if(isset($res)){echo('Atualizar');}else{echo('Cadastrar');}?>">
          </form>
      </section>
      <!---->
      <section id="direita">
        <table>
          <tr class="cabecalhoTable">
            <th>NOME</th>
            <th>TELEFONE</th>
            <th>EMAIL</th>
            <th>AÇÕES</th>
          </tr>
          <?php
            $dados = $nPessoa->buscarDados();
            if(Count($dados) > 0){
              for ($c=0; $c < count($dados); $c++){
                echo("<tr>");
                  foreach($dados[$c] as $key => $value){
                    if($key != 'idPessoa'){
                      echo("<td>".$value."</td>");
                    }
                  }
                  echo('<td>');
                    echo('<a href="index.php?idPessoaUpdate='.($dados[$c]['idPessoa']).'">Editar </a>');
                    echo('<a href="index.php?idPessoa='.($dados[$c]['idPessoa']).'">Excluir</a>');
                  echo('</td>');
                echo("</tr>"); 
              }
            }else{
          ?>
        </table>
          <div class="aviso">
            <h4>O Banco de dados esta vazio.</h4>
          </div>
          <?php } ?>
      </section>
    </div>
</body>
</html>

<?php
    if(isset($_GET['idPessoa'])){
        $idPessoa = addslashes($_GET['idPessoa']);
        $nPessoa->excluirPessoa($idPessoa);
        header("Location: index.php");
    }
?>