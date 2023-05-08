<?php
include ('../conexion/conexion.php');

//Abrimos la conexion a la DB MySQL
$conexion=conectar();

$libro_id=$_POST['libro_id'];

//Definimos la consulta SQL
$query = $conexion->prepare('SELECT * FROM libro l INNER JOIN autor a ON l.autor_id=a.autor_id WHERE libro_id = ?');
$query->bind_param('i',$libro_id);
$query->execute();
$resultado = $query->get_result();

$query2 = $conexion->prepare('SELECT autor_id, nombre, ap_paterno, ap_materno FROM autor');
$query2->execute();
$resultado2=$query2->get_result();

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
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 mt-2">
                <form method="post" action="editar_libro_registro.php">
                    <input type="hidden" name="libro_id" id="libro_id" value="<?php echo $libro_id ?>">
                    <table border="0">
                        <tbody>
                        <?php
                            $libro = $resultado->fetch_assoc();
                            $titulo=$libro['titulo'];
                            $autor_nom=$libro['nombre'];
                            $autor_ap=$libro['ap_paterno'];
                            $autor_am=$libro['ap_materno'];
                            $anio=$libro['anio'];
                            $especialidad=$libro['especialidad'];
                            $editorial=$libro['editorial'];
                            $URL=$libro['URL_libro'];
                        ?>
                        
                        <tr>
                            <td>Titulo: </td><td><input type="text" name="titulo" id="titulo" size=30 value="<?php echo $titulo ?>"></td>
                        </tr>
                        <tr>
                            <td><label for="autores">Autor: </label> </td>
                            <td><select class="form-select" name="autores" id="autores">
                                <option value=""></option>
                        <?php
                        while($autores=$resultado2->fetch_assoc())
                        {
                            $autor_id=$autores['autor_id'];
                            $autor_n=$autores['nombre'];
                            $autor_p=$autores['ap_paterno'];
                            $autor_m=$autores['ap_materno'];
                        ?>

                        <?php
                       
                        
                            echo '<option value="'.$autor_id.'">' .$autor_n.' '.$autor_p.' '.$autor_m .'</option>';
                        }
                        ?>
                            </select>
                        </tr>
                        <tr>
                            <td>Año: </td><td><input type="number" name="anio" id="anio" size="30" value="<?php echo $anio ?>"></td>
                        </tr>
                        <tr>
                            <td>Especialidad: </td><td><input type="text" name="especialidad" id="especialidad" size=30 value="<?php echo $especialidad ?>"></td>
                        </tr>
                        <tr>
                            <td>Editorial: </td><td><input type="text" name="editorial" id="editorial" size=30 value="<?php echo $editorial ?>"></td>
                        </tr>
                        <tr>
                            <td>URL: </td><td><input type="text" name="URL_libro" id="URL_libro" size=30 value="<?php echo $URL ?>"></td>
                        </tr>
                        </tbody>
                    </table>
                    <div class="mt-2">
                        <button class="btn btn-success" type="submit">Guardar</button>
                        <button class="btn btn-danger" type="button" onclick="location.href='libros.php'">Regresar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>
</html>