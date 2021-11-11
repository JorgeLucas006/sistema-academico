<!DOCTYPE html>
<html lang="en">

<?php
  include "../components/head.html";
?>

<body>
  
  <?php
    include "../components/navbar.html";
    $pdo = require($_SERVER['DOCUMENT_ROOT'].'/sistema-academico/database/connect.php');
    $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    if(!empty($dados['enviar'])){
      $query_disciplina = "INSERT INTO disciplinas (codigo, nome, professor_disciplina) VALUES ('".$dados['cod']."', '".$dados['name']."', ".$dados['teacher'].")";
      
      $cadDisc = $pdo->prepare($query_disciplina);
      $cadDisc->execute();
      header('Location: ./disciplinas.php');
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
                    $pdo = require($_SERVER['DOCUMENT_ROOT'].'/sistema-academico/database/connect.php');
                    $sql = 'SELECT id, nome FROM professores';

                    foreach($pdo->query($sql) as $key => $value){
                      echo '<option value='.$value['id'].'>'.$value['nome'].'</option>';
                    }
                  ?>
                </select>
              </div>
              <input type="submit" class="btn btn-primary" name="enviar"></input>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div> 
  </div>
  
    
  <div class="container ">
    <div class="row">
      <?php
      
      $list = require('../database/disciplinas/list.php');

      foreach($list as $key => $value){
        echo 
        
        '
        <div class="col-sm-4 mb-5">
          <div class="card">
            <div class="card-body text-center">

              <h5 class="card-title ">'.$value['nome'].'</h5>
              <p class="card-text">'.$value['codigo'].'</p>
              <p class="card-text">Professor: '.$value['p_nome'].'</p>
              <p class="card-text pb-2">Aluno: '.$value['count'].'</p>
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