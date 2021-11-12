<?php

declare(strict_types=1);

$pdo = require('../connect.php');
$sql = 'UPDATE professores SET codigo = ?, nome = ?, cpf = ?, dt_nascimento = ? WHERE id = ?';

$prepare = $pdo->prepare($sql);

$prepare->bindParam(1, $_POST['cod']);
$prepare->bindParam(2, $_POST['nome']);
$prepare->bindParam(3, $_POST['cpf']);
$prepare->bindParam(4, $_POST['date']);
$prepare->bindParam(5, $_POST['id']);
$prepare->execute();