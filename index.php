<?php
include './bd/bd.php';
$conn = connection();

$SelectDomains = "select * from projeto;";
$values = executeSelect($conn, $SelectDomains);

function data($data){
    return date("d/m/Y", strtotime($data));
}

?>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>


<nav class="navbar navbar-dark bg-primary">
  <a class="navbar-brand" href="#">
    <img src="http://blog.buscacliente.com.br/wp-content/uploads/2020/01/cropped-buscacliente-1-1.png" width="30" height="30" class="d-inline-block align-top" alt="">
    Busca Search
  </a>
</nav>

<div class="container justify-content-center">
    <div class="accordion" id="accordionExample">
        <?php
        while($fetch = $values->fetch(PDO::FETCH_ASSOC)){ ?>
            <div class="card ">
                <div class="card-header" id="headingOne">
                    <h5 class="mb-0">
                        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse<?=$fetch['ID_projeto']?>" aria-expanded="true" aria-controls=#collapse<?=$fetch['ID_projeto']?>>
                        <?=$fetch['dominio']?>
                        </button>
                    </h5>
                </div>


                <div id="collapse<?=$fetch['ID_projeto']?>" class="collapse" aria-labelledby="heading<?=$fetch['ID_projeto']?>" data-parent="#accordionExample">
                    <div class="card-body">
                        <ul class="list-group">
                        <?php
                            $SelectDomains = "select * from pesquisa where ID_projeto = '{$fetch['ID_projeto']}';";
                            $valuesSearch = executeSelect($conn, $SelectDomains);
                            while($fetch = $valuesSearch->fetch(PDO::FETCH_ASSOC)){ ?>
                            <li class="list-group-item"><?=$fetch['procura']?> <span class="badge badge-light"><?=data($fetch['data_pesquisa'])?> <span class="badge badge-success ml-2"><?=$fetch['recorrencia']?></span></span></li>
                        </ul>  
                        <?php } ?>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
</div>





