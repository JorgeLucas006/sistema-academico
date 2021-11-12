<?php

$id = $_POST['id'];

$pdo = require('../connect.php');

$query_delete = "delete from aluno where id = '$id'";

$delProf = $pdo->prepare($query_delete);
$delProf->execute();