<?php

declare(strict_types=1);
header('Content-Type: text/html; charset=utf-8');

$pdo = require($_SERVER['DOCUMENT_ROOT'].'/sistema-academico/database/connect.php');
$test = chr(46);
$sql = "SELECT disciplinas{$test}codigo, disciplinas{$test}nome, PROFESSORES{$test}NOME as p_nome, count(DISCIPLINAS.aluno_disciplina) as count FROM disciplinas 
INNER JOIN PROFESSORES ON PROFESSORES{$test}ID = DISCIPLINAS{$test}PROFESSOR_DISCIPLINA
group by codigo";

$disciplinas = $pdo->query($sql);

return $disciplinas;