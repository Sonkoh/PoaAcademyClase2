<?php
session_start();
require './config.php';
if (!isset($_GET['id'])) {
    header('Location: /');
} else {
    $sql = $conn->prepare("SELECT * FROM `tareas` WHERE id=:id");
    $sql->bindParam(':id', $_GET['id']);
    $sql->execute();
    $info = $sql->fetch(PDO::FETCH_ASSOC);
    if ($info['autor'] != $_SESSION["nombre"]) {
        header('Location: /');
    }
}

if (isset($_POST['desc'])) {
    $sql = $conn->prepare("UPDATE `tareas` SET `titulo`=:title,`description`=:desc WHERE id=:id");
    $sql->bindParam(':title', $_POST['titulo']);
    $sql->bindParam(':desc', $_POST['desc']);
    $sql->bindParam(':id', $_GET['id']);
    if ($sql->execute()) {
        header('Location: /');
    } else {
        echo 'Ha ocurrido un error';
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
</head>

<body>
    <div class="container">

        <div class="card">
            <form method="POST">
                <div class="mb-3">
                    <label for="formGroupExampleInput" class="form-label">Titulo</label>
                    <input type="text" class="form-control" id="formGroupExampleInput" name="titulo" value="<?= $info["titulo"] ?>">
                </div>
                <div class="mb-3">
                    <label for="formGroupExampleInput2" class="form-label">Descripcion</label>
                    <input type="text" class="form-control" id="formGroupExampleInput2" name="desc" value="<?= $info["description"] ?>">
                </div>
                <button type="submit" class="btn btn-primary">Actualizar</button>
            </form>
        </div>
    </div>
</body>

</html>
<script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>