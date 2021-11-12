<?php

$nome = $_POST['nome'];

$pdo = require('../connect.php');

$query_delete = "delete from disciplinas where nome = '$nome'";

$delDisc = $pdo->prepare($query_delete);
$delDisc->execute();