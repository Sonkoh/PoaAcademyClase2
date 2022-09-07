<?php



#DELETE FROM tareas WHERE id = 13
require './config.php';
$idTask = $_GET['id'];
$records = $conn->prepare("DELETE FROM tareas WHERE id = :id");
$records->bindParam(':id', $idTask);
if($records->execute()){
    header("Location: /");
}else {
    echo 'Ocurrio un error';
}


?>