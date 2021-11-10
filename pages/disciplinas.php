<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
    crossorigin="anonymous"></script>
  <link rel="stylesheet" href="../assets/styles/style.css">

  <title>Document</title>
</head>

<body>
  
  <?php
    include "../components/navbar.html";
  ?>
  
  <div class="container my-5">
    <div class="row">
      <?php
      
      $list = require('../database/list.php');
      $nome;
      $codigo;
      $p_nome;

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