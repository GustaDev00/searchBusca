<?php
include './bd/bd.php';
$conn = connection();

$SelectDomains = "select * from projeto;";
$values = executeSelect($conn, $SelectDomains);
while($fetch = $values->fetch(PDO::FETCH_ASSOC)){
    echo $fetch['dominio']."<br>";
    echo $fetch['ID_projeto']."<br>";
}



$SelectDomains = "select * from pesquisa where ID_projeto = '{$fetch['ID_projeto']}';";
$values = executeSelect($conn, $SelectDomains);
while($fetch = $values->fetch(PDO::FETCH_ASSOC)){
    echo $fetch['dominio']."<br>";
    echo $fetch['ID_projeto']."<br>";
}
