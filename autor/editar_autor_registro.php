<?php
include ('../conexion/conexion.php');

//Abrimos la conexion a la DB MySQL
$conexion=conectar();

$nombre=$_POST['nombre'];
$ap_paterno=$_POST['ap_paterno'];
$ap_materno=$_POST['ap_materno'];
$autor_id=$_POST['autor_id'];

//Definimos la consulta SQL
$query = $conexion->prepare('UPDATE autor SET nombre = ?, ap_paterno = ?, ap_materno = ? WHERE autor_id = ?');
$query->bind_param('sssi',$nombre,$ap_paterno,$ap_materno,$autor_id);

$msg = '';
if ($query->execute()){
    $msg='Autor Editado!';
} else {
    $msg='No se pudo editar al autor';
}

//Cerramos la conexion
desconectar($conexion);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
    <title>Editar</title>
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
<h1>Editar Autor</h1>
    <h3><?php echo $msg; ?></h3>
    <button class="btn btn-danger" type="button" onclick="location.href='autores.php'">Regresar</button>
    <!-- <button onclick="location.href='autores.php'">Regresar</button> -->
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>
</html>