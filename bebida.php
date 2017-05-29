<?php
    include_once("controllers/ProductsController.php");
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

    <script type="text/javascript">
        
        $( document ).ready(function() 
        {
                $.ajax({
                  method: "POST",
                  url: "controllers/ProductsController.php",
                  data: { pizza:"obtener Pizza"}
                })
        });

    </script>


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
        <li class="active"><a href="bebida.php">Bebidas</a></li>
        <li><a href="mostrar_carrito.php">Carrito</a></li>
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
    <div class="clearout"></div>





<div class="front absolute col-xs-12">
    	

    <?php  
		$servidor='localhost';
        $user='root';
        $password='091293';
        $bd= 'pizzeria';


		$conec = mysqli_connect($servidor , $user ,$password ,$bd);

		// Check connection
		if ($conec->connect_error) {
		    die("Connection failed: " . $conec->connect_error);
		} 

		$result = mysqli_query($conec, "SELECT * FROM producto where categoria_id=3"); //query de mysql para obtener los tacos 

		

		$numero = mysqli_num_rows($result); //para saber el numero de filas de la tabla

		//se despliega el resultado 
		
    if($numero>0)
    {
      echo "<div class='container'>";
      echo "<form method='POST' action='carrito.php'>";
    }
		for ($i=0; $i < $numero ; $i++)
		{ 
			mysqli_data_seek ($result, $i);
			$extraido= mysqli_fetch_array($result); //obtiene el arreglo con los elementos de la fila

	?>
			<div class="panel panel-success">
      <div class="panel-heading">
      <h3 class="panel-title"><?php echo $extraido['nombre'];?></h3>
      </div>
      <div class="panel-body">
        <p>Descripcion: <?php echo $extraido['descripcion'];?><br> Precio: <b>$<?php echo $extraido['precio'];?> MXN</b></p>
        <input style="visibility: hidden;" name="cod_producto" value="<?php echo $extraido['id'];?>">
        <input style="visibility: hidden;" name="nombre_producto" value="<?php echo $extraido['nombre'];?>"></input>
        <div class="form-group label-floating">
          <label for="222" class="control-label">Cantidad</label>
          <input type="number" name="canti" class="form-control" id="222">
        </div>
        <button class="btn btn-raised btn-primary" type="submit">Ordenar</button>
      </div>
      </div>
	<?php
			 
		}
    echo "</form>";
    echo "</div>";
		mysqli_close($conec); //cierra la conexion
	?>

	
</div>

<div class="final"></div>

</body>
</html>

