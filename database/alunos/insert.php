<?php

declare(strict_types=1);

$pdo = require('../connect.php');

// Adicionar novo aluno
$sql = 'insert into alunos (codigo, nome, cpf, dt_nascimento) values (?, ?, ?, ?)';

// Query para preencher uma disciplina vazia
$alterTable = 'update disciplinas set aluno_disciplina = ? where nome = "' . $_POST['disciplina'] . '"';

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
  $sqlGetId = 'SELECT id FROM ALUNOS WHERE codigo = "' . $_POST['cod'] . '"';
  $getId = $pdo->query($sqlGetId);

  foreach ($getId as $key => $value) {
    $prepareAlter = $pdo->prepare($alterTable);
    $prepareAlter->bindParam(1, $value['id']);
    $prepareAlter->execute();
  };

  echo $prepareAlter->rowCount();
} else {
  $sqlGetId = 'SELECT id FROM ALUNOS WHERE codigo = ' . $_POST['cod'] . '';
  $getId = $pdo->query($sqlGetId);

  foreach ($getId as $key => $value) {
    // Query para adicionar o aluno a uma disciplina
    $sqlDisci = 'INSERT INTO disciplinas (codigo, nome, professor_disciplina, aluno_disciplina) 
  SELECT codigo, nome, professor_disciplina, ' . $value['id'] . ' FROM disciplinas WHERE nome = "' . $_POST['disciplina'] . '" limit 1';
    $prepareAdd = $pdo->prepare($sqlDisci);
    $prepareAdd->execute();
  };

  echo $prepareAdd->rowCount();
}

return;
