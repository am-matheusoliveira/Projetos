<?php
    header('Content-Type: application/json');

    $name    = $_POST['name'];
    $comment = $_POST['comment'];

    $pdo = new PDO('mysql:host=localhost; dbname=dbcomments;', 'root', '');

    //$stmt = $pdo->prepare('INSERT INTO comments (default, name, comment) VALUES (:na, :co)');
    $stmt = $pdo->prepare('INSERT INTO comments VALUES (default, :na, :co)');
    $stmt->bindValue(':na', $name);
    $stmt->bindValue(':co', $comment);
    $stmt->execute();

    if ($stmt->rowCount() >= 1) {
        echo json_encode('Comentário Salvo com Sucesso');
    } else {
        echo json_encode('Falha ao salvar comentário');
    }