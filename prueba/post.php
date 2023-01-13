<?php
include "config.php";
include "utils.php";

$dbConn =  connect($db);

if ($_SERVER['REQUEST_METHOD'] == 'GET')
{
    if (isset($_GET['cedulaPaciente']))
    {
      //Mostrar un post
      $sql = $dbConn->prepare("SELECT * paciente  where cedulaPaciente=:cedulaPaciente");
      $sql->bindValue(':cedulaPaciente', $_GET['cedulaPaciente']);
      $sql->execute();
      header("HTTP/1.1 200 OK");
      echo json_encode(  $sql->fetch(PDO::FETCH_ASSOC)  );
      exit();
    }
    else {
      //Mostrar lista de post
      $sql = $dbConn->prepare("SELECT * FROM paciente");
      $sql->execute();
      $sql->setFetchMode(PDO::FETCH_ASSOC);
      header("HTTP/1.1 200 OK");
      echo json_encode( $sql->fetchAll()  );
      exit();
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $input = $_POST;
    $sql = "INSERT INTO paciente
          (cedulaPaciente, nombrePaciente, apellidoPaciente, correoPaciente, telefonoPaciente, direccionPaciente, estadoPaciente)
          VALUES
          (:cedulaPaciente, :nombrePaciente, :apellidoPaciente, :correoPaciente, :telefonoPaciente, :direccionPaciente, :estadoPaciente)";
    $statement = $dbConn->prepare($sql);
    bindAllValues($statement, $input);
    $statement->execute();

 

    $postCodigo = $dbConn->lastInsertId();
    if($postCodigo)
    {
      $input['cedulaPaciente'] = $postCodigo;
      header("HTTP/1.1 200 OK");
      echo json_encode($input);
      exit();
     }
}

 

if ($_SERVER['REQUEST_METHOD'] == 'DELETE')
{
    $codigo = $_GET['cedulaPaciente'];
  $statement = $dbConn->prepare("DELETE FROM paciente where cedulaPaciente=:cedulaPaciente");
  $statement->bindValue(':cedulaPaciente', $codigo);
  $statement->execute();
    header("HTTP/1.1 200 OK");
    exit();
}

 

if ($_SERVER['REQUEST_METHOD'] == 'PUT')
{
    $input = $_GET;
    $postCodigo = $input['cedulaPaciente'];
    $fields = getParams($input);

 

    $sql = "
          UPDATE paciente
          SET $fields
          WHERE cedulaPaciente='$postCodigo'
           ";
    $statement = $dbConn->prepare($sql);
    bindAllValues($statement, $input);

 

    $statement->execute();
    header("HTTP/1.1 200 OK");
    exit();
}
?>