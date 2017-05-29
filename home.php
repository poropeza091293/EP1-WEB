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
        <li class="active"><a href="home.php">Inicio</a></li>
        <li><a href="pizza.php">Pizza</a></li>
        <li><a href="postre.php">Postres</a></li>
        <li><a href="bebida.php">Bebidas</a></li>
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
    <br>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-success">
              <div class="panel-heading">
                <center><p  style="font-size:45px; color: #777777;">Bienvenido</p></center>
              </div>
              <div class="panel-body">
                <center>
                  <h4>Aqui podrias empezar...</h4>
                </center>
                <div class="panel panel-success">
                  <div class="panel-heading">
                    <h4 style="color: #777777;">Ve nuestras pizzas</h4>
                  </div>
                <div class="panel-body">
                  <p>Nosotros contamos con la mas amplia y mejor variedad de pizzas, postres y bebidas <b>¡Vamos! Hechale un Vistazo</b></p>
                  <a href="pizza.php" class="btn btn-raised btn-primary">Pizzas</a>
                  <a href="postre.php" class="btn btn-raised btn-primary">Postres</a>
                  <a href="bebida.php" class="btn btn-raised btn-primary">Bebidas</a>
                </div>
              </div>
               <div class="panel panel-success">
                  <div class="panel-heading">
                    <h4 style="color: #777777;">Aqui puedes organizar tus compras</h4>
                  </div>
                <div class="panel-body">
                  <p>Esta ventana te muestra cuanto has subido a tu carrito, antes de completar tu orden te recomendamos <b>hechale un vistazo</b></p>
                  <a href="mostrar_carrito.php" class="btn btn-raised btn-primary">Carrito</a>
                </div>
              </div>
               <div class="panel panel-success">
                  <div class="panel-heading">
                    <h4 style="color: #777777;">¿Tienes algun problema?</h4>
                  </div>
                <div class="panel-body">
                  <p>Es muy importante para nosotros la satisfaccion de nuestros clientes por lo que agradecemos si nos escriben enviandonos sus comentarios, quejas y/o sugerencias <b>¡No seas timido! te esperamos anciosos</b></p>
                  <a href="contacto.php" class="btn btn-raised btn-primary">Contacto</a>
                </div>
              </div>
              </div>
            </div>
        </div>
    </div>
    

  </body>
</html>
