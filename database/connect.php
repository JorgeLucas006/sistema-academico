<?php

declare(strict_types=1);

$pdo = null;

try {
	$pdo = new PDO('mysql:host=localhost;dbname=escola;charset=utf8', 'root', '');
} catch (Exception $err) {
	echo $err->getMessage();
	die();
}

return $pdo;