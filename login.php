<?php
	ob_start();
	session_start();
?>


<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Pizza</title>
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
  <link rel="stylesheet" type="text/css" href="http://localhost/pizzeria/assets/css/bootstrap-material-design-master/dist/css/bootstrap-material-design.min.css">
  <link rel="stylesheet" type="text/css" href="http://localhost/pizzeria/assets/css/style.css">

  
      
  <script src="https://cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.7/prefixfree.min.js"></script>

</head>

<body style="background-color: #009688;">

	
  <div class="container">

	<center><h1>Pizza</h1></center>
    <form class="form-horizontal" method="post" action="login.php">
  <fieldset>
    <legend>Iniciar sesion</legend>
    <center>
    	<div class="form-group">
      <label for="inputId" class="control-label">Ingrese su Id</label>

      <div>
        <input type="text" name="usu" class="form-control" id="inputId" placeholder="ID Usuario" required>
      </div>
      <button type="submit" class="btn btn-raised btn-primary">Entrar</button>
    </div>
    </center>
  </fieldset>
</form>
</div>
  
    <script src="js/index.js"></script>
<?php

    	if(isset($_POST['usu']))
    	{

    		$servidor='localhost';
      $user='root';
      $password='crazy124';
      $bd= 'pizzeria';

		    if($_POST['usu']!=null)
		    {
		    	$id=$_POST['usu'];
		    }


		    $conec = mysqli_connect($servidor , $user ,$password ,$bd);

			// Check connection
			if ($conec->connect_error) {
			   die("Connection failed: " . $conec->connect_error);
			} 

			$resulti = mysqli_query($conec, "SELECT * FROM cliente"); //query de mysql

			$bool= false;

			$numero = mysqli_num_rows($resulti); //para saber el numero de filas de la tabla

			for ($i=0; $i < $numero ; $i++)
			{ 
			    mysqli_data_seek ($resulti, $i);
			    $extraidoo= mysqli_fetch_array($resulti); //obtiene el arreglo con los elementos de la fila
			    
			    if($extraidoo['id']==$id)//verifica que exista el usuario
			    {
			        $bool=true;
			        $id= $extraidoo['id'];
			    }

			}

			if($bool)//si existe el usuario
			{

				

				$_SESSION['usu']=$usu;
				$_SESSION['id']=$id;

				header( 'Location: home.php');



			}
			else
			{
				echo "<script type=text/javascript>alert('El cliente no existe');</script>";  
			}

			
    	}


    ?>

</body>
</html>
