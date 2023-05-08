<?php
include ('../conexion/conexion.php');

//Abrimos la conexion a la DB MySQL
$conexion=conectar();

$libro_id=$_POST['libro_id'];
$titulo=$_POST['titulo'];
$autor_id=$_POST['autores'];
$anio=$_POST['anio'];
$especialidad=$_POST['especialidad'];
$editorial=$_POST['editorial'];
$URL=$_POST['URL_libro'];

//Definimos la consulta SQL
$query = $conexion->prepare('UPDATE libro SET titulo = ?, autor_id = ?, anio = ?, especialidad = ?, editorial = ?, URL_libro = ? WHERE libro_id = ?');
$query->bind_param('siisssi',$titulo,$autor_id,$anio,$especialidad,$editorial,$URL,$libro_id);

$msg = '';
if ($query->execute()){
    $msg='Libro Editado!';
} else {
    $msg='No se pudo editar el libro';
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
    <title>Editar Libro</title>
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
                        <a href="../autor/autores.php" class="nav-item nav-link">Autores</a>
                        <a href="../libro/libros.php" class="nav-item nav-link disabled">Libros</a>
                    </div>
                </div>
            </div>
        </nav>
    </div>
<h1>Editar Libro</h1>
    <h3><?php echo $msg; ?></h3>
    <button class="btn btn-danger" type="button" onclick="location.href='libros.php'">Regresar</button>
    <!-- <button onclick="location.href='libros.php'">Regresar</button> -->
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>
</html>