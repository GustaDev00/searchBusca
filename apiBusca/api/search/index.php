<?php
include '../../bd/bd.php';
$conn = connection();

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');

//Função roda o update no banco para aumentar o numero de vezes que uma palavra foi pesquisada
function recorrencia_sql($key, $id, $conn){

    $catch = "select recorrencia from pesquisa where procura = '$key' and ID_projeto = '$id'";
    $queryCatch = executeSelect($conn, $catch);    
    $ValueRe = $queryCatch->fetch(PDO ::FETCH_OBJ)->recorrencia;

    $ValueRe ++;

    $updateRe = "update pesquisa set recorrencia = '$ValueRe' where procura = '$key' and ID_projeto = '$id'";
    executeQuery($conn, $updateRe);

}

//Função que insere o Dominio e a Palavra chave no Banco de dados
function Insert_sql($key, $value, $conn){
    $hoje = date("m.d.y");

    $queryInsert = "insert into projeto(dominio) values('$value');";
    executeQuery($conn, $queryInsert);

    //Pegando o ID do dominio que foi inserido agora no Banco
    $verificar = "select ID_projeto from projeto where dominio = '$value'";
    $querySelect = executeSelect($conn, $verificar);    
    $idForeign = $querySelect->fetch(PDO ::FETCH_OBJ)->ID_projeto;

    $QI = "insert into pesquisa(procura, data_pesquisa, recorrencia, ID_projeto)
            values('$key', '$hoje', 1, '$idForeign')";
    executeQuery($conn, $QI);

}

//Função que insere no banco de dados somente a palavra chave
function add_key($id, $key, $conn){
    $hoje = date("m.d.y");
    
    $QI = "insert into pesquisa(procura, data_pesquisa, recorrencia, ID_projeto)
    values('$key', '$hoje', 1, '$id')";
    executeQuery($conn, $QI);

}


try {
    $post = $_POST['search'];
    $domain = $_POST['domain'];
    $verificar = "select ID_projeto from projeto where dominio = '$domain'";
    $querySelect = executeSelect($conn, $verificar);
    if($querySelect->rowCount() > 0){
        $idProjeto = $querySelect->fetch(PDO ::FETCH_OBJ)->ID_projeto;
        echo $idProjeto;
        $verificarRe = "select procura from pesquisa where procura = '$post' and ID_projeto = '$idProjeto'";
        $querySelectRe = executeSelect($conn, $verificarRe);
        $QSelectReRow = executeSelect($conn, $verificarRe)->rowCount();
        $QSelectReRow > 0 ? recorrencia_sql($post, $idProjeto, $conn) : add_key($idProjeto, $post, $conn);
    }else{
        Insert_sql($post, $domain, $conn);
    }

    echo 1;

} catch (\Throwable $th) {
    // var_dump($th);
    // echo $th->getMessage();
    echo 0;
}

