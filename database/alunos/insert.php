<?php

declare(strict_types=1);

$pdo = require('../connect.php');

// Adicionar novo aluno
$sql = 'insert into alunos (codigo, nome, cpf, dt_nascimento) values (?, ?, ?, ?)';

// Query para preencher uma disciplina vazia
$alterTable = 'update disciplinas set aluno_disciplina = ? where nome = "'.$_POST['disciplina'].'"';

// Query verificando se existe uma disciplina vazia
$alunoIsNull = 'SELECT * from disciplinas where nome = "' . $_POST['disciplina'] . '" and aluno_disciplina is null';

$prepare = $pdo->prepare($sql);

$prepare->bindParam(1, $_POST['cod']);
$prepare->bindParam(2, $_POST['nome']);
$prepare->bindParam(3, $_POST['cpf']);
$prepare->bindParam(4, $_POST['date']);
$prepare->execute();

$result = $pdo->prepare($alunoIsNull);
$result->execute();
$isNull = $result->rowCount();

if ($isNull == 1) {
  $sqlGetId = 'SELECT id FROM ALUNOS WHERE nome = ? and codigo = ? and cpf = ? and dt_nascimento = ?';
  $prepareId = $pdo->prepare($sqlGetId);
  $prepareId->bindParam(1, $_POST['cod']);
  $prepareId->bindParam(2, $_POST['nome']);
  $prepareId->bindParam(3, $_POST['cpf']);
  $prepareId->bindParam(4, $_POST['date']);
  $getId = $prepareId->execute();

  $prepareAlter = $pdo->prepare($alterTable);

  $prepareAlter->bindParam(1, $getId);
  $prepareAlter->execute();
  echo $prepareAlter->rowCount();
} else {
  
}

return;
