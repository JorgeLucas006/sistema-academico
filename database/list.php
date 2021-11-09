<?php

declare(strict_types=1);

$pdo = require('./connect.php');
$sql = 'select * from disciplinas';
$disciplinas = [];

echo '<h3>Disciplinas: </h3>';

foreach ($pdo->query($sql) as $key => $value) {

	echo 'Id: '.$value['id']. '<br> Nome: ' . $value['nome'] . '<hr>';
}