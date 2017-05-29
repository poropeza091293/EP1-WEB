<?php
    ob_start();
    session_start();
    $id= $_SESSION['id'];
    $usu= $_SESSION['usu'];


?>



<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Pizza</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="http://localhost/pizzeria/assets/css/bootstrap-material-design-master/dist/css/bootstrap-material-design.min.css">
    <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="  crossorigin="anonymous"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <!-- my css file -->
    <link rel="stylesheet" href="./assets/css/style.css">
  </head>
  <body>
    <!-- header -->
    <header>
       <div class="navbar navbar-primary">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="javascript:void(0)">Pizzeria</a>
    </div>
    <div class="navbar-collapse collapse navbar-responsive-collapse">
      <ul class="nav navbar-nav">
        <li><a href="home.php">Inicio</a></li>
        <li><a href="pizza.php">Pizza</a></li>
        <li><a href="postre.php">Postres</a></li>
        <li><a href="bebida.php">Bebidas</a></li>
        <li class="active"><a href="mostrar_carrito.php">Carrito</a></li>
        <li><a href="mod.php">Modificar Productos</a></li>
        <li><a href="contacto.php">Contactános</a></li>
      </ul>
      <form class="navbar-form navbar-left">
        <div class="form-group">
          <input type="text" class="form-control col-sm-8" placeholder="Buscar">
        </div>
      </form>
    </div>
  </div>
</div>
    </header>
    <div class="video-container">
      <video class="video" src="./public/video.mp4" autoplay loop="">
      </video>
    </div>

     <?php

//muestra los productos del carrito------------------------------------------------------

$servidor='localhost';
$user='root';
$password='091293';
$bd= 'pizzeria';

$conec = mysqli_connect($servidor , $user ,$password ,$bd);

// Check connection
if ($conec->connect_error) {
    die("Connection failed: " . $conec->connect_error);
} 

$resultii = mysqli_query($conec, "SELECT  producto.nombre, carrito.id_producto,producto.precio, carrito.id_carrito,carrito.canti FROM producto INNER JOIN carrito ON producto.id=carrito.id_producto order by id_carrito"); //query de mysql

$numero = mysqli_num_rows($resultii); //para saber el numero de filas de la tabla
?>



<?php

$suma=0;
if($numero>0)
    {
      echo "<div class='container'>";
      echo "<form method='POST' action='carrito.php'>";
    }
    else
    {
      echo "<div class='alert alert-dismissible alert-warning' style='color:#777777;'>
  <button type='button' class='close' data-dismiss='alert'>×</button>
  <h4>Hey!</h4>

  <p>Parece que aun no has registrado nada</p>
</div>";
    }
for ($i=0; $i < $numero ; $i++)
{ 
  //<input  type="image" src="assets/img/x.png" style="border: 0;width: 50px;height: 50px; margin-left: 3em;" alt="Submit">
  //mysqli_data_seek ($resultii, $i);
  $extraido= mysqli_fetch_array($resultii); //obtiene el arreglo con los elementos de la fila 
  ?>
    <div class="panel panel-success">
      <div class="panel-heading">
      <h3 class="panel-title"><?php echo $extraido['nombre'];?></h3>
      </div>
      <div class="panel-body">
        <p><br>Cantidad: <?php echo $extraido['canti']?> Precio: <b>$<?php echo $extraido['canti']*$extraido['precio']?> MXN</b></p>
        <input style="visibility: hidden;" name="codigo" value="<?php echo $extraido['id_producto'];?>">
        <button class="btn btn-raised btn-danger" alt="Submit">Eliminar</button>
      </div>
      </div>
  <?php
              $suma=$suma + ($extraido['canti']*$extraido['precio']);
    }
    echo "</form>";
    echo "</div>";
  ?>

  <center><h1>Precio Total: <?php echo $suma; ?></h1></center>


  <form method="post" action="carrito.php">

  <center><input class="btn btn-raised btn-primary" type="submit" name="orden" value="GENERAR ORDEN" style="margin-bottom: 3em;"></input></center>

  </form>

    
    <?php
    mysqli_close($conec); //cierra la conexion
  ?>




</body>
</html>



