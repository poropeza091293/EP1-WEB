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
        <li class="active"><a href="pizza.php">Pizza</a></li>
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
		<!-- FORMULARIO PARA MOSTRAR LOS PRODUCTOS REGISTRADOS -->
		<div class="card col-xs-4">
			<select class="form-control" name="">
        <option value="">Productos Existentes</option>
				<?php
					foreach ($productos as $producto) {
				?>
						<option value=""><?php echo $producto['nombre']; ?></option>
				<?php
					}
				?> 
			</select>
		</div>
    <br>
    <!-- FORMULARIO PARA INGRESAR PRODUCTOS -->
    <div>
      <div class=" card col-xs-4">
        <h2 class ="white-text">Registrar nuevo producto</h2>
        <input type="text" class="form-control" id="nombre" value="" placeholder="Escribe el nombre del producto "><br>
        <input type="number" class="form-control" id="precio" value="" placeholder="Escribe el precio del producto "><br>
        <select id="categoria" class="form-control" name="">
					<option value="1">Pizzas</option>
					<option value="2">Postres</option>
					<option value="3">Bebidas</option>

        </select><br>
				<textarea class="form-control" id="descripcion"></textarea>
				<br>

        <button type="button" class="form-control" id="guardar">Guardar producto</button>
      </div>

      <br>
      <!-- FORMULARIO PARA ELIMINAR PRODUCTOS -->
    <div class="card col-xs-4">
      <div>
        <h2 class ="white-text">Eliminar producto</h2>
        <input type="text" class="form-control" id="nombre_eli" value="" placeholder="Escribe el nombre del producto "><br>
  

        <button type="button" class="form-control" id="eliminar">Eliminar producto</button>
      </div>
    </div>
      <br>
      <!-- FORMULARIO PARA actualizar PRODUCTOS -->
    <div>
      <div class=" card col-xs-4">
        <h2 class ="white-text">Actualizar producto</h2>
        <input type="text" class="form-control" id="nombre_act" value="" placeholder="Escribe el nombre del producto "><br>
        <input type="text" class="form-control" id="nom" value="" placeholder="Escribe el nombre del producto "><br>
        <input type="number" class="form-control" id="prec" value="" placeholder="Escribe el precio del producto "><br>
        <select id="cat" class="form-control" name="">
          <option value="1">Pizzas</option>
          <option value="2">Postres</option>
          <option value="3">Bebidas</option>

        </select><br>
        <textarea class="form-control" id="des"></textarea>
        <br>
        <button type="button" class="form-control" id="actualizar">Actualizar producto</button>
      </div>
    </div>



    </div>

    <!-- container -->
    <script src="./assets/js/script.js" charset="utf-8"></script>
    <script type="text/javascript">
      let actualizar = document.querySelector("#actualizar");
      actualizar.addEventListener('click',function()
        {
          let nom_act=document.querySelector("#nombre_act");
          let nom = document.querySelector("#nom");
          let prec = document.querySelector("#prec");
          let cat = document.querySelector("#cat");
          let des = document.querySelector("#des");
          let prod = new Producto(nom.value,prec.value,cat.value,des.value);
          let listas = new Array();
        listas.push(prod);
        let arrJSON = JSON.stringify(listas);
          console.log(arrJSON);
          $.ajax({
          method: "POST",
          url: "controllers/ProductsController.php",
          data: {productos: arrJSON,actualizarP: nom_act.value }
        }).done(function() {
          console.log( nom_act.value);
           console.log( "Productos actualizados");
         });

          history.go(0);

        });


      let eliminar = document.querySelector("#eliminar");


       eliminar.addEventListener('click',function()
      {
        let nombreeli = document.querySelector("#nombre_eli");

        console.log( nombreeli.value);

        $.ajax({
          method: "POST",
          url: "controllers/ProductsController.php",
          data: { eliminarP: nombreeli.value }
        })
        .done(function() {
           console.log( "Datos borrados ");
         });

        history.go(0);
      });




      let guardar = document.querySelector("#guardar");

      guardar.addEventListener('click',function()
      {
        let nombre = document.querySelector("#nombre");
        let precio = document.querySelector("#precio");
				let categoria = document.querySelector("#categoria");
        let descripcion = document.querySelector("#descripcion");



        let producto = new Producto(nombre.value,precio.value,categoria.value,descripcion.value);
				let listaproductos = new Array();
				listaproductos.push(producto);
				let arregloJSON = JSON.stringify(listaproductos);
				console.log(arregloJSON);
				$.ajax({
				  method: "POST",
				  url: "controllers/ProductsController.php",
				  data: { productos: arregloJSON, funcion: "insertarProductos" }
				})
				.done(function() {
				   console.log( "Datos guardados ");
				 });

        history.go(0);
      });

    </script>
  </body>
</html>
