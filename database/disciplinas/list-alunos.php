<?php

declare(strict_types=1);

$pdo = require($_SERVER['DOCUMENT_ROOT'] . '/sistema-academico/database/connect.php');

$sql = "SELECT alunos.nome as nome FROM disciplinas 
INNER JOIN alunos ON alunos.ID = DISCIPLINAS.aluno_disciplina where disciplinas.nome = '{$_POST['nome']}' group by disciplinas.id";

$alunos = $pdo->query($sql);

$arr = [];

foreach ($alunos as $key => $value) {
  $arr[$key] = $value[0];
}

echo json_encode($arr);