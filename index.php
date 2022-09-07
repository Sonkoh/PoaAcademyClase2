<?php
session_start();
require './config.php';

#INSERT INTO tareas(titulo, description) VALUES ('Hola clase', 'Esto es la descrpcion');



#SELECT * FROM tareas
if (!empty($_POST['titulo'])) {
    $records = $conn->prepare("INSERT INTO tareas(titulo, description, autor) VALUES (:titulo, :descripcion, :autor)");
    $records->bindParam(':titulo', $_POST['titulo']);
    $records->bindParam(':descripcion', $_POST['desc']);
    $records->bindParam(':autor', $_SESSION["nombre"]);
    if ($records->execute()) {
        echo 'La tarea se guardo correctamente';
    } else {
        echo 'Ocurrio un error';
    }
}

if (!isset($_SESSION['nombre'])) {
    header('Location: /login.php');
}
?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplicacion de Tareas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
</head>

<body>

    <div class="container">
        <div class="card">
            <form action="./index.php" method="POST">
                <div class="mb-3">
                    <label for="formGroupExampleInput" class="form-label">Titulo</label>
                    <input type="text" class="form-control" id="formGroupExampleInput" name="titulo">
                </div>
                <div class="mb-3">
                    <label for="formGroupExampleInput2" class="form-label">Descripcion</label>
                    <input type="text" class="form-control" id="formGroupExampleInput2" name="desc">
                </div>
                <button type="submit" class="btn btn-primary">Enviar</button>
            </form>
        </div>

        <br>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Titulo</th>
                    <th scope="col">Descripcion</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $records = $conn->prepare("SELECT * FROM tareas");
                $records->execute();
                $results = $records->fetchAll(PDO::FETCH_ASSOC);

                foreach ($results as $tareas) {
                ?>
                    <tr>
                        <th scope="row"><?= $tareas['id'] ?></th>
                        <td><?= $tareas['titulo'] ?></td>
                        <td><?= $tareas['description'] ?></td>
                        <td><?= $tareas['autor'] ?></td>
                        <td><a href="editTask.php?id=<?= $tareas['id'] ?>"><i class="bi bi-pencil-fill"></i></a></td>
                        <td><a href="deleteTask.php?id=<?= $tareas['id'] ?>"><i style="color: red;" class="bi bi-trash-fill"></i></a></td>
                    </tr>
                <?php } ?>



            </tbody>
        </table>
        <a class="btn btn-secondary" href="logout.php">LOG OUT</a>
    </div>

</body>

</html>
<script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>