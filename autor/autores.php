<?php
include ('../conexion/conexion.php');

$conexion=conectar();

//Consulta a la base de datos
$query = $conexion->prepare("SELECT autor_id, nombre, ap_paterno, ap_materno FROM autor");
$query->execute();
$resultado = $query->get_result();

desconectar($conexion);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
    <title>Autores</title>
</head>
<body>
    <div class="m-0">
        <nav class="navbar navbar-expand-lg navbar-success bg-success">
            <div class="container-fluid">
                <a href="#" class="navbar-brand">Laboratorio #7</a>
                <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <div class="navbar-nav">
                        <a href="../autor/autores.php" class="nav-item nav-link disabled">Autores</a>
                        <a href="../libro/libros.php" class="nav-item nav-link">Libros</a>
                    </div>
                </div>
            </div>
        </nav>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 mt-2">
            <h1>Autores</h1>
            <a href="agregar_autor.html">Nuevo Autor</a>
                <table class="table" border="1">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>NOMBRES</th>
                            <th>APELLIDO PATERNO</th>
                            <th>APELLIDO MATERNO</th>
                            <th colspan="3">ACCIONES</th>

                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        //recorrer el array con el resultado de la consulta
                        while($autor = $resultado->fetch_assoc())
                        {
                            //Ill try to use the code of the last lab, this is a little hard to the eyes
                            $autor_id=$autor['autor_id'];
                            $nombre=$autor['nombre'];
                            $ape_paterno=$autor['ap_paterno'];
                            $ape_materno=$autor['ap_materno'];
                            // echo '<form action="eliminar_autor.php" method="post">';
                            echo '<tr>';
                            echo '<td>'.$autor_id.'</td>';
                            echo '<td>'.$nombre.'</td>';
                            echo '<td>'.$ape_paterno.'</td>';
                            echo '<td>'.$ape_materno.'</td>';
                            echo '<form action="eliminar_autor.php" method="post">';
                            echo '<input type="hidden" name="autor_id" value="'.$autor_id.'">';
                            echo '<td><button class="btn btn-danger" type="submit">Eliminar</button></td>';
                            echo '</form>';
                            echo '<form action="editar_autor.php" method="post">';
                            echo '<input type="hidden" name="autor_id" value="'.$autor_id.'">';
                            echo '<td><button class="btn btn-success" type="submit">Editar</button></td>';
                            echo '</form>';     
                            echo '</tr>';
                            // echo '</form>';
                        }
                    ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>
</html>