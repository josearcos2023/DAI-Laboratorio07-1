<?php
include('../conexion/conexion.php');

//Valores del formulario
$nombre=$_POST['nombre'];
$ap_paterno=$_POST['ap_paterno'];
$ap_materno=$_POST['ap_materno'];

//Abrir conexion a DB
$conexion=conectar();

//query a la DB
$query = $conexion->prepare("INSERT INTO autor (nombre, ap_paterno, ap_materno) VALUES (?, ?, ?)");
// s es el tipo de dato (String) del primer segundo y tercer variable
// i  es para integers
$query->bind_param('sss',$nombre,$ap_paterno,$ap_materno);
$msg = '';
if ($query->execute()){
    $msg = 'Autor Registrado!';
} else {
    $msg='No se pudo registrar al autor';
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
    <title>Nuevo Autor</title>
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
    <h1>Nuevo Autor</h1>
    <h3><?php echo $msg; ?></h3>
    <!-- <a href="autores.php">Regresar</a> -->
    <div>
        <button class="btn btn-danger" type="button" onclick="location.href='autores.php'">Regresar</button>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>
</html>
