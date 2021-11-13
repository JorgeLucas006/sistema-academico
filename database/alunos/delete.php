<?php

$id = $_POST['id'];

$pdo = require('../connect.php');

$query_delete = "delete from alunos where id = '$id'";

$delAluno = $pdo->prepare($query_delete);
$delAluno->execute();

echo $delAluno->rowCount();