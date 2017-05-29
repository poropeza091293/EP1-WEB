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
        <li><a href="mostrar_carrito.php">Carrito</a></li>
        <li><a href="mod.php">Modificar Productos</a></li>
        <li class="active"><a href="contacto.php">Contactános</a></li>
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


		
    <div class="front absolute col-xs-12" style="background-color: rgba(255,255,255,0.4);width: 100%;">
  

  <div >


        
      </div>


      <div>
       
        <h1>Contacto</h1>
      </div>
        
      





        <div class="col-md-6">

          <form method="post" id="formu" action="carrito.php" style=" font-size: 1.2em;">
            <input class="form-control" style="color: white;" type="text" name="nombre" id="nombre" placeholder="Nombre" required>
            <input class="form-control" style="color: white;" type="text" name="correo" id="correo" placeholder="Correo" required>
            <textarea style="color: white;" form = "formu" class="form-control" rows="3" id="textArea" name="mensaje" placeholder="Mensaje"  required></textarea>

            <input style="visibility: hidden; display: none;" name="contacto" value="contacto"></input>

            <br>

            <center><input class="btn btn-raised btn-primary" type="submit" name="envi" value="ENVIAR" style="border: none; font-size: 1em;"></center>

          </form>
          
        </div>
    </div>
    

  </body>
</html>
