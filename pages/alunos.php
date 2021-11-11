<!DOCTYPE html>
<html lang="en">

<?php
include "../components/head.html";
?>

<body>

  <?php
  include "../components/navbar.html";
  $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
  if (!empty($dados['enviar'])) {
    $query_alunos = "INSERT INTO alunos (codigo, nome, cpf, dt_nascimento) VALUES ('" . $dados['cod'] . "', '" . $dados['name'] . "', " . $dados['cpf'] . ", '" . $dados['date'] . "')";

    $query_aluno_disciplina = "INSERT INTO alunos (codigo, nome, cpf, dt_nascimento) VALUES ('" . $dados['cod'] . "', '" . $dados['name'] . "', " . $dados['cpf'] . ", '" . $dados['date'] . "')";

    foreach ($dados['disc'] as $value) {
      echo $value . "<br><br>";
    }
    /*$cadProf = $pdo->prepare($query_professor);
    $cadProf->execute();
    header('Location: ./professores.php');*/
  }
  ?>

  <div class="container-fluid text-center my-5">
    <button type="button" class="btn btn-primary " data-toggle="modal" data-target="#adicionar" data-whatever="@getbootstrap">Adicionar</button>

    <div class="modal fade" id="adicionar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Adicionar disciplina</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form name="adiciona-disciplina" method="POST" action="">
              <div class="form-group">
                <label for="cod" class="col-form-label">Código:</label>
                <input type="text" class="form-control" name="cod" id="cod" required>
              </div>
              <div class="form-group">
                <label for="name" class="col-form-label">Nome:</label>
                <input type="text" class="form-control" name="name" id="name" required>
              </div>
              <div class="form-group">
                <label for="cpf" class="col-form-label">CPF:</label>
                <input type="number" class="form-control" name="cpf" id="cpf">
              </div>
              <div class="form-group">
                <label for="date" class="col-form-label">Data de Nascimento:</label>
                <input type="date" class="form-control" name="date" id="date">
              </div>
              <div class="d-flex flex-column justify-content-start text-left ml-2">
                <label for="disc" class="col-form-label">Disciplinas:</label>
                <?php
                $pdo = require($_SERVER['DOCUMENT_ROOT'] . '/sistema-academico/database/connect.php');
                $sql = 'SELECT id, nome FROM disciplinas group by nome';

                $disciplina_nome = $pdo->query($sql);

                foreach ($disciplina_nome as $key => $value) {
                  echo
                  '
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="disc[]" value="'.$value['id'].'" id="id_disc">
                    <label class="form-check-label" for="id_disc">
                      '.$value['nome'].'
                    </label>
                  </div>
                  ';
                };

                ?>

              </div>
              <input type="submit" class="btn btn-primary" name="enviar"></input>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="container ">
    <div class="row">
      <?php

      $list = require('../database/alunos/list.php');

      foreach ($list as $key => $value) {
        echo

        '
        <div class="col-sm-4 mb-5">
          <div class="card">
            <div class="card-body text-center">

              <h5 class="card-title ">' . $value['nome'] . '</h5>
              <p class="card-text">' . $value['codigo'] . '</p>
              <a href="#" class="btn btn-primary">Alterar</a>
              <a href="#" class="btn btn-danger">Excluir</a>
            
            </div>
          </div>
        </div>';
      };
      ?>
    </div>
  </div>
</body>

</html>