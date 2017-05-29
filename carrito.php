
<?php
ob_start();
    session_start();
    $id= $_SESSION['id'];
    $usu= $_SESSION['usu'];

$servidor='localhost';
    $user='root';
    $password='crazy124';
    $bd= 'pizzeria';


//establece la conexion con la base de datos--------------------------------------

$conec = mysqli_connect($servidor , $user ,$password ,$bd);

if ($conec->connect_error) 
{
   die("Connection failed: " . $conec->connect_error);
} 

//inserta el producto al carrito-----------------------------------------------------

if(isset($_POST['cod_producto']))
{
	$cod_producto= $_POST['cod_producto'];
	$ca=$_POST['canti'];
	$resulti = mysqli_query($conec, "SELECT * FROM carrito"); //query de mysql
	$flag=false;
	$numero = mysqli_num_rows($resulti); //para saber el numero de filas de la tabla

	$mayor=-1;

	for ($i=0; $i < $numero ; $i++)
	{ 
	    mysqli_data_seek ($resulti, $i);
	    $extraidoo= mysqli_fetch_array($resulti); //obtiene el arreglo con los elementos de la fila

	    if($extraidoo['id_producto']== $cod_producto)//ya existe el prducto en el carrito y se suma la cantidad que habia sido ingresada
	    {
	    	$flag=true;
	    	break;
	    }

	    if($extraidoo['id_carrito']> $mayor)//verifica que exista el usuario
	        $mayor=$extraidoo['id_carrito'];

	}

	if($flag==false)
	{
		$result = mysqli_query($conec, "INSERT INTO carrito(id_carrito,id_producto,canti,id_cliente) VALUES($mayor+1,'$cod_producto','$ca','$id')"); //query de mysql

		if(!$result)
			echo "<script>alert('Error al agregar producto al carrito');</script>";
		else
		{
			$_POST['cod_producto']=null;
			 echo "<script>alert('Producto agregado correctamente al carrito');window.location.href=window.history.back();</script>";

		   
			//echo "<script>window.history.back()</script>"; //regresa a la pagina donde se mandó a llamar
		}

	}
	else
	{
		$result = mysqli_query($conec, "UPDATE carrito SET canti= canti+$ca WHERE id_producto='$cod_producto'"); //query de mysql que actualiza la cantidad del carrito en un producto

			if(!$result)
				echo "<script>alert('Error al agregar producto al carrito');window.location.href=window.history.back();</script>";
			else
			{
				$_POST['cod_producto']=null;
				  echo "<script>alert('Producto agregado correctamente al carrito');window.location.href=window.history.back();</script>";

			   
				//echo "<script>window.history.back()</script>"; //regresa a la pagina donde se mandó a llamar
			}
	}


	$_POST['cod_producto']=null;
	
	mysqli_close($conec); //cierra la conexion

}

//borra elemento de carrito-------------------------------------------------------------------------

if(isset($_POST['codigo']))
{


	$borrar=$_POST['codigo'];

	$resulti = mysqli_query($conec, "SELECT * FROM carrito"); //query de mysql

	$bool= false;

	$numero = mysqli_num_rows($resulti); //para saber el numero de filas de la tabla

	for ($i=0; $i < $numero ; $i++)
	{ 
	    mysqli_data_seek ($resulti, $i);
	    $extraidoo= mysqli_fetch_array($resulti); //obtiene el arreglo con los elementos de la fila
	    
	    if($extraidoo['id_producto']== $borrar)//verifica que exista el producto
	    {
	     
	        $resultii = mysqli_query($conec, "DELETE FROM carrito WHERE id_producto='$borrar';");//query de mysql



			if($resultii)
			{
				$borrar=null;
				$_POST['codigo']=null;
				echo "<script>alert('Producto eliminado correctamente del carrito');</script>";
				 header( 'Location: mostrar_carrito.php?act=1');
			}
			else
				echo "<script>alert('Error al eliminar producto del carrito');window.location.href=window.history.back();location.reload(true);</script>";

	    }

	}
	mysqli_close($conec); //cierra la conexion


}

//borra todo el carrito--------------------------------------------------------------------

if (isset($_POST['eli'])) 
{
	//echo "<script>alert('eli se paso');</script>";
	$d=$_POST['eli'];

	if($d=1)
	{

		
		$resultii = mysqli_query($conec, 'DELETE FROM carrito');
		header('Location: mostrar_carrito.php');
		mysqli_close($conec); //cierra la conexion
	
	}

	$_POST['eli']=null;
	$d=null;
}

//GENERAR ORDEN---------------------------------------------------------------------

if (isset($_POST['orden'])) 
{

	

	

	$us=$usu;
	$idd=$id;
	
	
	$resultix = mysqli_query($conec, "SELECT * FROM orden WHERE id_cliente='$id'");

	$numero = mysqli_num_rows($resultix); //para saber el numero de filas de la tabla

	$mayor=-1;

	if($numero>0)
	{
		for ($i=0; $i < $numero ; $i++)
		{ 
		    mysqli_data_seek ($resultix, $i);
		    $extraidoo= mysqli_fetch_array($resultix); //obtiene el arreglo con los elementos de la fila
		    
		    if($extraidoo['id_orden']> $mayor)
		        $mayor=$extraidoo['id_orden'];

		}

	}
	else
		$mayor=0;

	

	

	//echo "<script>alert($mayor);</script>";

	$resulti = mysqli_query($conec, "SELECT * FROM carrito WHERE id_cliente='$id'");
	$numero3 = mysqli_num_rows($resulti);

	for ($i=0; $i < $numero3 ; $i++)
	{ 
	    mysqli_data_seek ($resulti, $i);
	    $extraidoooo= mysqli_fetch_array($resulti); //obtiene el arreglo con los elementos de la fila

	    $cod=$extraidoooo['id_producto'];
	    $k=$extraidoooo['canti'];

	    $fecha_orden = date("Y-m-d H:i:s");//now();




	    $resultt = mysqli_query($conec, "INSERT INTO orden(id_orden,id_producto,id_cliente,cantidad,fecha_orden)VALUES($mayor+1,'$cod',$idd,$k,'$fecha_orden')"); 


	     
	

	}



	
	
	$xxxx= mysqli_query($conec,"SELECT * FROM orden WHERE id_cliente='$id'");

	$numero2 = mysqli_num_rows($xxxx);


	$body = "Orden de Pedido"."\r\n\n\n<br>";



	for ($i=0; $i < $numero2 ; $i++)
	{ 

		//echo "<script>alert($i);</script>";
	    mysqli_data_seek ($xxxx, $i);
	    $ex= mysqli_fetch_array($xxxx); //obtiene el arreglo con los elementos de la fila

	    $idO=$ex['id_orden'];
	    $codP=$ex['id_producto'];
	    $idU= $id;
	    $cant= $ex['cantidad'];
	    $date= $ex['fecha_orden'];

	   
	    //se arma el texto de todo el pedido para ser enviado por correo

	    if($idO==$mayor+1)
	    {
	    	$body.= "<br><label>Id de Orden : </label><label>$idO</label><br>";
			$body.= "<label>Id del Producto : </label><label>$codP</label><br>";
			$body.= "<label>Id del Cliente : </label><label>$idU</label><br>";
			$body.= "<label>Cantidad del Pedido : </label><label>$cant</label><br>";
			$body.= "<label>Fecha del Pedido : </label><label>$date</label><br>";
	    }

		
		

	}

	//se envia el correo
	require('pruebas/PHPMailer/PHPMailerAutoload.php');
	require('pruebas/PHPMailer/class.smtp.php');

	//Envio de correo 
		

		//la siguiente sección de $correo, está comentada para que sirva en un servidor web, pero en localhost, se descomenta para que funcione
	 
		$correo = new PHPMailer();
		$correo->IsSMTP(); 
		$correo->SMTPSecure = 'tls';
		$correo->SMTPAuth = true;
		$correo->Host = "smtp.gmail.com";
		$correo->Port = 587;
		$correo->SMTPDebug = 0;
		$correo->Username ='ompi152172@upemor.edu.mx';
		$correo->Password = '091293po'; //Su password
		$correo->SetFrom('ompi152172@upemor.edu.mx', 'Peter Oropeza');
		$correo->AddReplyTo('ompi152172@upemor.edu.mx', 'Peter Oropeza');
		$correo->Subject = "Prueba Pizzeria Producto";
		$correo->MsgHTML("$body");

		$correo->addAddress('ompi152172@upemor.edu.mx', 'Peter Oropeza');
	
		$correo->send();


	
	$resultiiiii = mysqli_query($conec, "DELETE FROM carrito WHERE id_cliente='$id'"); //se elimina el carrito despues de haberse generado una orden



	$_POST['orden']=null;



	
	echo "<script type=text/javascript>alert('Pedido efectuado exitosamente');</script>"; 
	header('Location:home.php');

	//echo "<a href='/aa/mostrar_carrito.php'>regresar</a>";
	
	
	mysqli_close($conec); //cierra la conexion


	
}


if(isset($_POST['envi']))
{
	$body = "Orden de Pedido"."\r\n\n\n<br>";

	$nombre= $_POST['nombre'];
	$correo= $_POST['correo'];
	$mensaje= $_POST['mensaje'];



	$body.= "<br><label>Persona interesada : </label><label>$nombre</label><br>";
	$body.= "<label>Correo: </label><label>$correo</label><br>";
	$body.= "<label>Mensaje : </label><label>$mensaje</label><br>";
		

	//se envia el correo
	require('pruebas/PHPMailer/PHPMailerAutoload.php');
	require('pruebas/PHPMailer/class.smtp.php');

	//Envio de correo 
		

		//la siguiente sección de $correo, está comentada para que sirva en un servidor web, pero en localhost, se descomenta para que funcione
		$correo = new PHPMailer();
		$correo->IsSMTP(); 
		$correo->SMTPSecure = 'tls';
		$correo->SMTPAuth = true;
		$correo->Host = "smtp.gmail.com";
		$correo->Port = 587;
		$correo->SMTPDebug = 0;
		$correo->Username ='ompi152172@upemor.edu.mx';
		$correo->Password = '091293po'; //Su password
		$correo->SetFrom("ompi152172@upemor.edu.mx", "Peter Savier");
		$correo->AddReplyTo("ompi152172@upemor.edu.mx", "Peter Savier");
		$correo->Subject = "Prueba Pizzeria Contacto";
		$correo->MsgHTML("$body");
		$correo->addAddress('ompi152172@upemor.edu.mx', 'Peter Oropeza');
	
		$correo->send();


	$_POST['contacto']=null;

	
	echo "<script type=text/javascript>alert('Mensaje enviado.');</script>"; 
	header('Location: contacto.php');

	

	//echo "<a href='/aa/mostrar_carrito.php'>regresar</a>";
}




	
?>

</body>
</html>

