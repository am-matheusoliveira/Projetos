<?php
    require_once('php/index.php');
/*
    $conexao = new PDO("mysql:host=127.0.0.1;dbname=smaug2022","root","");

    //PDO::PARAM_EVT_EXEC_PRE;
    $cmd = $conexao->prepare('SELECT EMPRESA_ID, CREATED_AT AS CRIADO_EM FROM CCT_AJUSTES ORDER BY EMPRESA_ID', 
							array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
    $cmd->execute();
 
    $result = $cmd->FETCH(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT);

    print nl2br("Busque a primeira coluna da primeira linha no conjunto de resultados:<br>");
    //$result = $cmd->fetchColumn();
	//$cmd->fetchColumn();
    print nl2br("EMPRESA_ID: ".$result[0]."\nCRIADO_EM: ".$result[1]."\n");
	
    print nl2br("Busque a segunda coluna da segunda linha no conjunto de resultados:\n");
    print("EMPRESA_ID: = " .$cmd->fetchColumn(0) ."<br>");

    $registros = $cmd->FETCH(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);

    foreach($registros as $key => $value){
        echo nl2br("Campo: $key<br>Valor: $value \n\n");
    }

    $registros = $cmd->FETCH(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);

    foreach($registros as $key => $value){
        echo nl2br("Campo: $key<br>Valor: $value \n\n");
    }

    $registros = $cmd->FETCH(PDO::FETCH_ASSOC, PDO::FETCH_ORI_PRIOR);

    foreach($registros as $key => $value){
        echo nl2br("Campo: $key<br>Valor: $value \n\n");
    }

    $registros = $cmd->fetchAll(PDO::FETCH_ASSOC);
    //fetchColumn()
    //rowCount()
    //$colunas = $cmd->columnCount();    
    echo('<pre>');
    print_r($registros);
    echo('</pre>');

    
    //public PDOStatement :: fetch (
    //                              int $mode              = PDO :: FETCH_DEFAULT , 
    //                              int $cursorOrientation = PDO :: FETCH_ORI_NEXT , 
    //                              int $cursorOffset      = 0
    //                             ): mixed								 
    */
?>