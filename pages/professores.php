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
            <h5 class="modal-title" id="exampleModalLabel">Adicionar disciplina</h5>
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
                <label for="message-text" class="col-form-label">CPF:</label>
                <input type="number" class="form-control" name="cpf" id="cpf">
              </div>
              <div class="form-group">
                <label for="message-text" class="col-form-label">Data de Nascimento:</label>
                <input type="date" class="form-control" name="date" id="date">
              </div>
              <input type="button" class="btn btn-primary" value="Enviar" onclick="addProf()"></input>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="container ">
    <div class="row">
      <?php
      $list = require('../database/professores/list.php');

      foreach ($list as $key => $value) {
        echo

        '
        <div class="col-sm-4 mb-5">
          <div class="card">
            <div class="card-body text-center">

              <h5 class="card-title ">' . $value['nome'] . '</h5>
              <p class="card-text">' . $value['codigo'] . '</p>
              
              <input type="button" class="btn btn-primary" value="Alterar" onclick="alterModal(`' . $value['codigo'] . '`, `' . $value['nome'] . '`, `' . $value['cpf'] . '`, `' . $value['dt_nascimento'] . '`, `' . $value['id'] . '`)" data-toggle="modal" data-target="#update-modal" data-whatever="@getbootstrap"></input>

              <input type="button" class="btn btn-danger" value="Excluir" onclick="deleteProf(`' . $value['id'] . '`, `' . $value['nome'] . '`)"></input>
            
            </div>
          </div>
        </div>';
      };
      ?>
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
            <form name="adiciona-disciplina" method="POST" action="">
              <div class="form-group">
                <label for="recipient-name" class="col-form-label">Código:</label>
                <input type="text" class="form-control" name="cod" id="update-cod" required>
              </div>
              <div class="form-group">
                <label for="message-text" class="col-form-label">Nome:</label>
                <input type="text" class="form-control" name="name" id="update-name" required>
              </div>
              <div class="form-group">
                <label for="message-text" class="col-form-label">CPF:</label>
                <input type="number" class="form-control" name="cpf" id="update-cpf">
              </div>
              <div class="form-group">
                <label for="message-text" class="col-form-label">Data de Nascimento:</label>
                <input type="date" class="form-control" name="date" id="update-date">
              </div>
              <input type="hidden" id="id-selector" name="">
              <input type="button" class="btn btn-primary" value="Enviar" onclick="updateProf()"></input>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
    function alterModal(cod, nome, cpf, date, id) {
      var modal = $('#update-modal');
      modal.find('#update-cod').val(cod);
      modal.find('#update-name').val(nome);
      modal.find('#update-cpf').val(cpf);
      modal.find('#update-date').val(date);
      modal.find('#id-selector').val(id);
    }

    function deleteProf(id, nome) {
      $.ajax({
        url: '../database/professores/delete.php',
        type: 'POST',
        data: {
          id: id
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

    function addProf() {
      var cod = $('#cod').val();
      var nome = $('#name').val();
      var cpf = $('#cpf').val();
      var date = $('#date').val();

      // Validação para adicionar uma disciplina
      if (cod && nome && cpf && date) {
        // Caso todos os campos sejam preenchidos
        $.ajax({
          url: '../database/professores/insert.php',
          type: 'POST',
          data: {
            cod: cod,
            nome: nome,
            cpf: cpf,
            date: date,
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

    function updateProf() {
      var cod = $('#update-cod').val();
      var nome = $('#update-name').val();
      var cpf = $('#update-cpf').val();
      var date = $('#update-date').val();
      var id = $('#id-selector').val();

      if (cod && nome && cpf && date && id) {
        // Caso todos os campos sejam preenchidos
        $.ajax({
          url: '../database/professores/update.php',
          type: 'POST',
          data: {
            cod: cod,
            nome: nome,
            cpf: cpf,
            date: date,
            id: id,
          },
          success: function(result) {
            // Retorno se tudo ocorreu normalmente
            console.log(result)
            alert("Professor " + nome + " alterado(a) com sucesso");
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