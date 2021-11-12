<?php

declare(strict_types=1);

$pdo = require('../connect.php');
$sql = 'UPDATE disciplinas SET codigo = ?, nome = ?, professor_disciplina = ? WHERE nome = ?';

$prepare = $pdo->prepare($sql);

$prepare->bindParam(1, $_POST['cod']);
$prepare->bindParam(2, $_POST['nome']);
$prepare->bindParam(3, $_POST['professor']);
$prepare->bindParam(4, $_POST['nomeSave']);
$prepare->execute();

echo $prepare->rowCount();