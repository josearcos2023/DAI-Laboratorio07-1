<?php
include ('../conexion/conexion.php');

$conexion=conectar();

//Consulta a la base de datos
// $query = $conexion->prepare("SELECT libro_id, titulo, autor_id, anio, especialidad, editorial, URL_libro FROM libro");
$query=$conexion->prepare('SELECT * FROM libro l INNER JOIN autor a ON l.autor_id=a.autor_id');

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
    <title>Libros</title>
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
            <h1>Libros</h1>
            <a href="agregar_libro.html">Nuevo Libro</a>
                <table class="table" border="1">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>TÍTULO</th>
                            <th>AUTOR</th>
                            <th>AÑO</th>
                            <th>ESPECIALIDAD</th>
                            <th>EDITORIAL</th>
                            <th>URL</th>
                            <th colspan="2">ACCIONES</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        //recorrer el array con el resultado de la consulta
                        while($libro = $resultado->fetch_assoc())
                        {
                            //Ill try to use the code of the last lab, this is a little hard to the eyes
                            $libro_id=$libro['libro_id'];
                            $titulo=$libro['titulo'];
                            $autor_n=$libro['nombre'];
                            $autor_ap=$libro['ap_paterno'];
                            $autor_am=$libro['ap_materno'];
                            $anio=$libro['anio'];
                            $espec=$libro['especialidad'];
                            $edit=$libro['editorial'];
                            $url=$libro['URL_libro'];

                            echo '<tr>';
                            echo '<td>'.$libro_id.'</td>';
                            echo '<td>'.$titulo.'</td>';
                            echo '<td>'.$autor_n.' '.$autor_ap.' '.$autor_am.'</td>';
                            echo '<td>'.$anio.'</td>';
                            echo '<td>'.$espec.'</td>';
                            echo '<td>'.$edit.'</td>';
                            echo '<td><a target="_blank" href="'.$url.'">'.$url.'</a></td>';
                            echo '<form action="eliminar_libro.php" method="post">';
                            echo '<input type="hidden" name="libro_id" value="'.$libro_id.'">';
                            echo '<td><button class="btn btn-danger" type="submit">Eliminar</button></td>';
                            echo '</form>';
                            echo '<form action="editar_libro.php" method="post">';
                            echo '<input type="hidden" name="libro_id" value="'.$libro_id.'">';
                            echo '<td><button class="btn btn-success" type="submit">Editar</button></td>';
                            echo '</form>';     
                            echo '</tr>';
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