<!DOCTYPE html>
<html lang="en">

<?php
include "../components/head.html";
?>

<body>

  <?php
  include "../components/navbar.html";
  ?>


  <div class="container-fluid text-center my-5">
    <button type="button" class="btn btn-primary " data-toggle="modal" data-target="#adicionar" data-whatever="@getbootstrap">Adicionar</button>

    <div class="modal fade" id="adicionar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Adicionar disciplina</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form name="adiciona-disciplina" method="POST" action="">
              <div class="form-group">
                <label for="recipient-name" class="col-form-label">Código:</label>
                <input type="text" class="form-control" name="cod" id="cod" required>
              </div>
              <div class="form-group">
                <label for="message-text" class="col-form-label">Nome:</label>
                <input type="text" class="form-control" name="name" id="name" required>
              </div>
              <div class="form-group">
                <label for="message-text" class="col-form-label">Professor:</label>
                <select class="custom-select" name="teacher" id="teacher" required>
                  <option selected disabled value="">Escolha</option>
                  <?php
                  $pdo = require($_SERVER['DOCUMENT_ROOT'] . '/sistema-academico/database/connect.php');
                  $sql = 'SELECT id, nome FROM professores';

                  foreach ($pdo->query($sql) as $key => $value) {
                    echo '<option value=' . $value['id'] . '>' . $value['nome'] . '</option>';
                  }
                  ?>
                </select>
              </div>
              <input type="button" class="btn btn-primary" value="Enviar" onclick="addDisc()"></input>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="container ">
    <div class="row">
      <?php
      // Importando a listagem de Disciplinas do banco
      $list = require('../database/disciplinas/list.php');
      // Listagem de disciplinas
      foreach ($list as $key => $value) {
        echo

        '
        <div class="col-sm-4 mb-5">
          <div class="card">
            <div class="card-body text-center">

              <h5 class="card-title ">' . $value['nome'] . '</h5>
              <p class="card-text">' . $value['codigo'] . '</p>
              <p class="card-text">Professor: ' . $value['p_nome'] . '</p>
              <p class="card-text pb-2">Alunos: ' . $value['counts'] . '</p>
              <input type="button" class="btn btn-primary" onclick="alterModal(`' . $value['codigo'] . '`, `' . $value['nome'] . '`, `' . $value['p_id'] . '`)" value="Alterar" data-toggle="modal" data-target="#update-modal" data-whatever="@getbootstrap"></input>
              <input type="button" class="btn btn-danger" value="Excluir" onclick="deleteDisc(`' . $value['nome'] . '`)"></input>
              <input type="button" class="btn btn-primary" value="Detalhes" onclick="listModal(`' . $value['nome'] . '`, `' . $value['codigo'] . '`, `' . $value['p_nome'] . '`)" data-toggle="modal" data-target="#list-modal" data-whatever="@getbootstrap"></input>
            </div>
          </div>
        </div>';
      };
      ?>
    </div>
  </div>

  <div class="container-fluid text-center my-5">
    <div class="modal fade" id="list-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Detalhes:</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <h5 class="card-title" id="list-name"></h5>
            <p class="card-text" id="list-cod"></p>
            <p class="card-text" id="list-teacher"></p>
            <h5 class="card-text">Alunos:</h5>
            <ul class="list-group" id="list-alunos">
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="container-fluid text-center my-5">
    <div class="modal fade" id="update-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Atualizando:</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form name="atualiza-disciplina" method="POST" action="">
              <div class="form-group">
                <label for="recipient-name" class="col-form-label">Código:</label>
                <input type="text" class="form-control" name="cod" id="update-cod" data-whatever="Olá" required>
              </div>
              <div class="form-group">
                <label for="message-text" class="col-form-label">Nome:</label>
                <input type="text" class="form-control" name="name" id="update-name" required>
              </div>
              <div class="form-group">
                <label for="message-text" class="col-form-label">Professor:</label>
                <select class="custom-select" name="teacher" id="update-teacher" required>
                  <option disabled value="">Escolha</option>
                  <?php
                  $pdo = require($_SERVER['DOCUMENT_ROOT'] . '/sistema-academico/database/connect.php');
                  $sql = 'SELECT id, nome FROM professores';

                  foreach ($pdo->query($sql) as $key => $value) {
                    echo '<option value=' . $value['id'] . '>' . $value['nome'] . '</option>';
                  }
                  ?>
                </select>
              </div>
              <input type="hidden" id="update-name-save" name="">
              <input type="button" class="btn btn-primary" onclick="updateDisc()" value="Enviar"></input>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
    function listModal(nome, cod, teacher) {
      var modal = $('#list-modal');
      modal.find('#list-cod').text("Codigo: " + cod);
      modal.find('#list-name').text("Nome: " + nome);
      modal.find('#list-teacher').text("Professor: " + teacher);
      $("li").remove(".list-group-item");

      $.ajax({
        url: '../database/disciplinas/list-alunos.php',
        type: 'POST',
        data: {
          nome: nome,
        },
        success: function(result) {
          // Retorno se tudo ocorreu normalmente
          result.map(item=>{
            modal.find('#list-alunos').append("<li class='list-group-item'>"+item+"</li>");
          })
        },
        error: function(jqXHR, textStatus, errorThrown) {
          // Retorno caso algum erro ocorra
        },
        dataType: "json"
      })
    }

    function alterModal(cod, nome, teacher) {
      var modal = $('#update-modal');
      modal.find('#update-cod').val(cod);
      modal.find('#update-name').val(nome);
      modal.find('#update-name-save').val(nome);
      modal.find('#update-teacher').val(teacher).change();
    }

    function deleteDisc(nome) {

      $.ajax({
        url: '../database/disciplinas/delete.php',
        type: 'POST',
        data: {
          nome: nome
        },
        success: function(result) {
          // Retorno se tudo ocorreu normalmente
          alert("Professor " + nome + " excluido(a) com sucesso");
          location.reload(); // then reload the page.(3)
        },
        error: function(jqXHR, textStatus, errorThrown) {
          // Retorno caso algum erro ocorra
        }
      })
    }

    function addDisc() {
      var cod = $('#cod').val();
      var nome = $('#name').val();
      var teacher = $('#teacher').val();

      // Validação para adicionar uma disciplina
      if (cod && nome && teacher) {
        // Caso todos os campos sejam preenchidos
        $.ajax({
          url: '../database/disciplinas/insert.php',
          type: 'POST',
          data: {
            cod: cod,
            nome: nome,
            professor: teacher,
          },
          success: function(result) {
            // Retorno se tudo ocorreu normalmente
            alert("Professor " + nome + " adicionado(a) com sucesso");
            location.reload();
          },
          error: function(jqXHR, textStatus, errorThrown) {
            // Retorno caso algum erro ocorra
            alert("Erro: " + textStatus);
          }
        })

      } else {
        // Caso haja algum campo vazio ele ira retornar erro
        alert("Todos os campos devem ser preenchidos!");
      }
    }

    function updateDisc() {
      var cod = $('#update-cod').val();
      var nome = $('#update-name').val();
      var nomeSave = $('#update-name-save').val();
      var teacher = $('#update-teacher').val();

      if (cod && nome && teacher) {
        // Caso todos os campos sejam preenchidos
        $.ajax({
          url: '../database/disciplinas/update.php',
          type: 'POST',
          data: {
            cod: cod,
            nome: nome,
            professor: teacher,
            nomeSave: nomeSave,
          },
          success: function(result) {
            // Retorno se tudo ocorreu normalmente
            alert("Disciplina " + nome + " alterado(a) com sucesso");
            location.reload();
          },
          error: function(jqXHR, textStatus, errorThrown) {
            // Retorno caso algum erro ocorra
            alert("Erro: " + textStatus);
          }
        })

      } else {
        // Caso haja algum campo vazio ele ira retornar erro
        alert("Todos os campos devem ser preenchidos!");
      }
    }
  </script>
</body>

</html>