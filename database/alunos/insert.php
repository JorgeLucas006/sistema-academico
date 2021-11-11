<?php

declare(strict_types=1);

$pdo = require('../connect.php');
$sql = 'insert into disciplinas (nome) values (?)';

$prepare = $pdo->prepare($sql);

$prepare->bindParam(1, $_GET['nome']);
$prepare->execute();

echo $prepare->rowCount();