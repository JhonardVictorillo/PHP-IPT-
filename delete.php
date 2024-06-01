<?php

    include_once('connect.php');

$id = $_POST['id'] ?? null;

    if(!$id){
        header('Location: CRUD.php');
        exit;

}
// echo'<pre>';
//  var_dump($id);
//  echo '<pre>';
    $Statement = $conn->prepare("DELETE FROM tbl_patients WHERE p_id = :id");

    $Statement->bindvalue(':id',$id);
    $Statement->execute();

    header('Location: CRUD.php')

?>