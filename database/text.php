<?php

declare(strict_types=1);

$cod = "Arquitetura";

$sql = "SELECT alunos.nome as nome FROM disciplinas 
INNER JOIN alunos ON alunos.ID = DISCIPLINAS.aluno_disciplina where disciplinas.nome = '".$cod."' group by disciplinas.id";

echo $sql;