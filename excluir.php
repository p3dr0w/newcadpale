<?php
include "conn.php";
if(isset($_POST['idpalestra'])){
  $id = $_POST['idpalestra'];
  try{

    $Conexao    = Conexao::getConnection();
    $query2 = $Conexao->prepare("update palestra set del = b'1' where id = :id");
            $query2->execute(array(
                    ':id' => $id
                ));

                if($query2->rowCount() > 0){
                  $response = array("success" => true);

                  echo json_encode($response);
                }

  }catch(Exception $e){
    $msg = $e->getMessage();
    $response = array("success" => false);
    echo json_encode($response);

  }
}elseif(isset($_POST['idparticipante'])){
  $id = $_POST['idparticipante'];
  try{

    $Conexao    = Conexao::getConnection();
    $query2 = $Conexao->prepare("update participante set del = b'1' where id = :id");
            $query2->execute(array(
                    ':id' => $id
                ));

                if($query2->rowCount() > 0){
                  $response = array("success" => true);
                  echo json_encode($response);
                }

  }catch(Exception $e){
    $msg = $e->getMessage();
    $response = array("success" => false);
    echo json_encode($response);

  }
}

?>
