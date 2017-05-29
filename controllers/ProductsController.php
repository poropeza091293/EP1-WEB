<?php

if( isset($_POST['funcion']) ) {
	require_once("../models/Product.php");
	require_once("../models/Cleaner.php");

	//echo 'Hola AJAX '.$_POST['funcion'];
	$productos = json_decode($_POST['productos']);

	foreach ($productos as $item) 
	{
		$nombre = Cleaner::cleanInput($item->_nombre);
		$categoria = (int)Cleaner::cleanInput($item->_categoria);
		$producto = new Product($nombre,
		
		$item->_precio,
		$categoria,
		$item->_descripcion);

		$producto->save();
	}

} 
else if( isset($_POST['actualizarP']) )
{
	require_once("../models/Product.php");
	require_once("../models/Cleaner.php");
	$act = $_POST['actualizarP'];
	$productos = json_decode($_POST['productos']);

	foreach ($productos as $item) 
	{
		$nombre = Cleaner::cleanInput($item->_nombre);
		$categoria = (int)Cleaner::cleanInput($item->_categoria);
		$producto = new Product($nombre,$item->_precio,$categoria,$item->_descripcion);
		Product::update($act,$producto);

	}

}
else if( isset($_POST['eliminarP']) )
{
	require_once("../models/Product.php");
	$eli = $_POST['eliminarP'];
	Product::eliminarP($eli);

}
else if( isset($_POST['pizza']) )
{
	include_once("models/Product.php");
	$productos = Product::getPizza();
}
else if( isset($_POST['postre']) )
{
	include_once("models/Product.php");
	$productos = Product::getPostre();
}
else if( isset($_POST['bebida']) )
{
	include_once("models/Product.php");
	$productos = Product::getBebida();
}

else 
{
	include_once("models/Product.php");
	$productos = Product::get();
}
?>