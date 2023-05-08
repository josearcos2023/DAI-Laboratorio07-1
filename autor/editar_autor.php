<?php
include ('../conexion/conexion.php');

//Abrimos la conexion a la DB MySQL
$conexion=conectar();

$autor_id=$_POST['autor_id'];

//Definimos la consulta SQL
$query = $conexion->prepare('SELECT * FROM autor WHERE autor_id = ?');
$query->bind_param('i',$autor_id);
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
    <title>Editar Autor</title>
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
            <form method="post" action="editar_autor_registro.php">
                <input type="hidden" name="autor_id" id="autor_id" value="<?php echo $autor_id ?>">
                <table border=0>
                    <?php
                        $autor = $resultado->fetch_assoc();
                        $nombre=$autor['nombre'];
                        $ape_paterno=$autor['ap_paterno'];
                        $ape_materno=$autor['ap_materno'];
                    ?>
                    
                    <tr>
                        <td>Nombre: </td><td><input type="text" name="nombre" id="nombre" size=30 value=<?php echo $nombre ?>></td>
                    </tr>
                    <tr>
                        <td>Apellido paterno: </td><td><input type="text" name="ap_paterno" id="ap_paterno" size=30 value=<?php echo $ape_paterno ?>></td>
                    </tr>
                    <tr>
                        <td>Apellido materno: </td><td><input type="text" name="ap_materno" id="ap_materno" size=30 value=<?php echo $ape_materno ?>></td>
                    </tr>
                </table>
                    <div class="mt-2">
                        <button class="btn btn-success" type="submit">Guardar</button>
                        <button class="btn btn-danger" type="button" onclick="location.href='autores.php'">Regresar</button>
                    </div>
            </form>
            </div>
        </div>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>
</html>