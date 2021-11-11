<?php

declare(strict_types=1);

$pdo = require($_SERVER['DOCUMENT_ROOT'].'/sistema-academico/database/connect.php');

$sql = "SELECT codigo, nome FROM alunos group by codigo;";

$disciplinas = $pdo->query($sql);

return $disciplinas;