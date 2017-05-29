<?php
session_start();
$correoF1;
$correoF2;
?>
<!DOCTYPE html>
<html>
  <head>
    <title></title>
    <link rel="stylesheet" type="text/css" href="../css/ventanas-modales.css">
  </head>
  <body>
<?php

$comprador="";
function sanear_string($string)
{
 
    $string = trim($string);
 
    $string = str_replace(
        array('á','Á'),
        array('&aacute;','&Aacute;'),
        $string
    );
 
    $string = str_replace(
        array('é', 'É'),
        array('&eacute;', '&Eacute;'),
        $string
    );
 
    $string = str_replace(
        array('í', 'Í'),
        array('&iacute;','&Iacute;'),
        $string
    );
 
    $string = str_replace(
        array('ó','Ó',),
        array('&oacute;','&Oacute;'),
        $string
    );
 
    $string = str_replace(
        array('ú','Ú'),
        array('&uacute;','&Uacute;'),
        $string
    );
 
    $string = str_replace(
        array('ñ', 'Ñ'),
        array('&ntilde;', '&Ntilde;'),
        $string
    );
 
    //Esta parte se encarga de eliminar cualquier caracter extraño
   
    return $string;
}

function sanear_string3($string)
{
 
    $string = trim($string);
 
    $string = str_replace(
        array('&aacute;','&Aacute;'),
        array('á','Á'),
        $string
    );
 
    $string = str_replace(
        array('&eacute;', '&Eacute;'),
        array('é', 'É'),
        $string
    );
 
    $string = str_replace(
        array('&iacute;','&Iacute;'),
        array('í', 'Í'),
        $string
    );
 
    $string = str_replace(
        array('&oacute;','&Oacute;'),
        array('ó','Ó',),
        $string
    );
 
    $string = str_replace(
        array('&uacute;','&Uacute;'),
        array('ú','Ú'),
        $string
    );
 
    $string = str_replace(
        array('&ntilde;', '&Ntilde;'),
        array('ñ', 'Ñ'),
        $string
    );
 
    //Esta parte se encarga de eliminar cualquier caracter extraño
   
    return $string;
}
$i=4;
date_default_timezone_set('America/Mexico_City');
$fecha_actual=date("d/m/Y H/M/S");
include "../acceso.inc.php";
require_once 'PHPExcel-1.8/Classes/PHPExcel.php';
include 'PHPExcel-1.8/Classes/PHPExcel/IOFactory.php';
$objPHPExcel = new PHPExcel();
// Se asignan las propiedades del libro
$objPHPExcel->getProperties()->setCreator("PacificStar") // Nombre del autor
    ->setLastModifiedBy("PacificStar") //Ultimo usuario que lo modificó
    ->setTitle("Reporte") // Titulo
    ->setSubject("Reporte Excel") //Asunto
    ->setDescription("Reporte posibles poductos") //Descripción
    ->setKeywords("reporte productos y codigos") //Etiquetas
    ->setCategory("Reporte excel"); //Categorias

$tituloReporte = "Relación de códigos";
$titulosColumnas = array('CATEGORÍA', 'Código CMU', 'Código SB', 'Costo','Calidad','Almacen','Existencia','Tipo de negocio','Características','Descripción','Proveedor','Sustituto');

// Se combinan las celdas A1 hasta D1, para colocar ahí el titulo del reporte
$objPHPExcel->setActiveSheetIndex(0)
    ->mergeCells('A1:H1'); 
    // Se agregan los titulos del reporte
$objPHPExcel->setActiveSheetIndex(0)
    ->setCellValue('A1',$tituloReporte) // Titulo del reporte
    ->setCellValue('A3',  $titulosColumnas[0])  //Titulo de las columnas
    ->setCellValue('B3',  $titulosColumnas[1])
    ->setCellValue('C3',  $titulosColumnas[2])  //Titulo de las columnas
    ->setCellValue('D3',  $titulosColumnas[3])
    ->setCellValue('E3',  $titulosColumnas[4])  //Titulo de las columnas
    ->setCellValue('F3',  $titulosColumnas[5])
    ->setCellValue('G3',  $titulosColumnas[6])  //Titulo de las columnas
    ->setCellValue('H3',  $titulosColumnas[7])
    ->setCellValue('I3',  $titulosColumnas[8])
    ->setCellValue('J3',  $titulosColumnas[9])
    ->setCellValue('K3',  $titulosColumnas[10])
    ->setCellValue('L3',  $titulosColumnas[11]);
require('PHPMailer/class.phpmailer.php');
require('PHPMailer/PHPMailerAutoload.php');
require('PHPMailer/class.smtp.php');
// generacion de contraseña
function generaPass(){
    //Se define una cadena de caractares. Te recomiendo que uses esta.
    $cadena = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
    //Obtenemos la longitud de la cadena de caracteres
    $longitudCadena=strlen($cadena);
     
    //Se define la variable que va a contener la contraseña
   
    //Se define la longitud de la contraseña, en mi caso 10, pero puedes poner la longitud que quieras
    $longitudPass=10;
     
    //Creamos la contraseña
    for($i=1 ; $i<=$longitudPass ; $i++){
        //Definimos numero aleatorio entre 0 y la longitud de la cadena de caracteres-1
        $pos=rand(0,$longitudCadena-1);
     
        //Vamos formando la contraseña en cada iteraccion del bucle, añadiendo a la cadena $pass la letra correspondiente a la posicion $pos en la cadena de caracteres definida.
        $pass .= substr($cadena,$pos,1);
    }
    return $pass;

}



$contar=0;
$varVertical;
function calidad($a)
{
    $variable1;
    switch ($a) {
            case 3:
                $variable1="BEST";
            break;
            case 2:
               $variable1="BETTER";
            break;
            case 1:
               $variable1="GOOD";
            break;
        }
        return $variable1;
}

function categorias($a)
{
    $variable1;
     switch ($a) {
      case '0':
      $variable1="";
        break;
      case '1':
      $variable1="ABARR";
        break;
      case '2':
      $variable1="BEBID";
        break;
      case '3':
      $variable1="ENTRA";
        break;
      case '4':
     $variable1="EMPAQ";
        break;
      case '5':
      $variable1="EQUIP";
        break;
      case '6':
      $variable1="FRUTA";
        break;
      case '7':
      $variable1="POSTR";
        break;
      case '8':
      $variable1="LACTE";
        break;
      case '9':
      $variable1="LIMPI";
        break;
      case '10':
      $variable1="PANAD";
        break;
      case '11':
      $variable1="PESCA";
        break;
      case '12':
     $variable1="PROTE";
        break;
      
      default:
        $variable1="";
        break;
    }
        return $variable1;
} 

function almacen($b)
{
    $variable;
         switch ($b) {
            case 1:
               $variable = "CONGELADO";
            break;
            case 2:
               $variable = "REFRIGERADO";
            break;
            case 3:
               $variable = "SECO";
            break;
            default:
               $variable = "NA";
            break;
 }
 return $variable;
}
function almacen2($b)
{
    $variable;
         switch ($b) {
            case 1:
               $variable = "< -12° C";
            break;
            case 2:
               $variable = ">1° C ; < 4° C";
            break;
            case 3:
               $variable = "TEMPERATURA AMBIENTE";
            break;
            default:
               $variable = "NA";
            break;
 }
 return $variable;
}

$body = "Contacto desde el sitio web"."\r\n";

$contarId=0;
$idCorreoCliente=""; 
$body= $body. "<table border='2'>";
$body= $body. "<tr><th>CATEGORÍA</th><th>Código CMU</th><th>Código SB</th><th>Costo</th><th>Calidad</th><th>Almacen</th><th>Existencia</th>";
$body= $body. "<th>Tipo de negocio</th><th>Características</th><th>Descripción</th><th>Proveedor</th><th>Sustituto</th></tr>";
  foreach($_SESSION['carro'] as $id => $x)
    { 
      $varVertical="";
      $resultado = mysql_query("SELECT * FROM productos WHERE codigo='$id'");
      $mifila = mysql_fetch_array($resultado);
      $resultado2 = mysql_query("SELECT * FROM productos2 WHERE codigo='$id'");
      $mifila2 = mysql_fetch_array($resultado2);
      $proveedor=$mifila['Proveedor_idProveedor'];
      $ordensql2=" select nombre  from proveedor where idProveedor=$proveedor";
      $resultado2=mysql_query($ordensql2);
      $cuenta2=mysql_num_rows($resultado2);
      $row2=mysql_fetch_array($resultado2);
      $nomProveedor=$row2['nombre'];
      $sector=$mifila['Sector_idSector'];
      $sectores= categorias($sector);
 if($mifila['idVCasual'] =="SI")
    {
        $contar++;
        $varVertical="CASUAL";

    }
     if($mifila['idVComedor'] =="SI")
    {
        if ($contar>0) {
            $varVertical=$varVertical.", COMEDOR IND";
        }
        else
        {    
            $varVertical="COMEDOR IND";
        }
        $contar++;

    }
     if($mifila['idVEntretenimiento'] =="SI")
    {
        if ($contar>0) {
            $varVertical=$varVertical.", ENTRETENIMIENTO";
        }
        else
        {    
            $varVertical="ENTRETENIMIENTO";
        }
        $contar++;

    }
    if($mifila['idVHoteles'] =="SI")
    {
        if ($contar>0) {
            $varVertical=$varVertical.", HOTELES";
        }
        else
        {    
            $varVertical="HOTELES";
        }
        $contar++;

    }
    if($mifila['idVQSR'] =="SI")
    {
        if ($contar>0) {
            $varVertical=$varVertical.", QSR";
        }
        else
        {    
            $varVertical="QSR";
        }

    } 
      $id = $mifila['codigo'];
      $id2 = $mifila2['codigo2'];
      $costo= $mifila2['precio'];
      $calidad = calidad($mifila['Calidad_idCalidad']);
      $almacen = almacen($mifila['Almacen_idAlmacen1']);
      $existencia="Pendiente";
      $caracteristicas = $mifila['caracteristicas'];
      $descripcion = $mifila['descripcion'];
      $sustitutos= strtoupper($mifila[sustitutos]);

      $body= $body. "<tr>";
      $body= $body. "<td>$sectores</td>";
      $body= $body. "<td>$id</td>";
      $body= $body. "<td>$id2</td>";
      $body= $body. "<td>$costo</td>";
      $body= $body. "<td>$calidad</td>";
      $body= $body. "<td>$almacen</td>";
      $body= $body. "<td>$existencia</td>";
      $body= $body. "<td>$varVertical</td>";
      $body= $body. "<td>$caracteristicas</td>";
      $body= $body. "<td>$descripcion</td>";
      $body= $body. "<td>$nomProveedor</td>";
      $body= $body. "<td>$sustitutos</td>";
     // $body= $body."".$id." -- ".$producto."\r\n";
      $objPHPExcel->setActiveSheetIndex(0)
         ->setCellValue('A'.$i, $sectores)
         ->setCellValue('B'.$i, $id)
         ->setCellValue('C'.$i, $id2)
         ->setCellValue('D'.$i, $costo)
         ->setCellValue('E'.$i, $calidad)
         ->setCellValue('F'.$i, $almacen)
         ->setCellValue('G'.$i, $existencia)
         ->setCellValue('H'.$i, $varVertical)
         ->setCellValue('I'.$i, sanear_string3($caracteristicas))
         ->setCellValue('J'.$i, sanear_string3($descripcion))
         ->setCellValue('K'.$i, $nomProveedor)
         ->setCellValue('L'.$i, sanear_string3($sustitutos));
     $i++;


      $body= $body. "</tr>";
$contarId=0;
$idCorreoCliente="";  

if ($contarId == 0)
{
  $idCorreoCliente .=$id;
  $contarId ++;
} 
else
{
  $idCorreoCliente .=",".$id; 
   $contarId ++;
}



    } 
$body= $body. "</table>";

echo "entro del <br>";
$email_subject = "Contacto desde el sitio web";
//el correo del usuario
$email_from;
$body= $body."<br>";

$correoF1=$_POST['correo'];
$correoF2=$_POST['EmailContacto'];

 if($correoF1=="")
 {
  $email_from = $_POST['EmailContacto']; 
  $body= $body." Enviado por:  CATALOGO DIGITAL";

echo "entro al if del emailContacto";

// correo del cliente



$contraPass="";
while ($passVar==false) {
  $contraPass=generaPass();
 $resultado2 = mysql_query("SELECT count(idCliente) as num FROM cliente WHERE idCliente='".$contraPass."'");
      $mifila2 = mysql_fetch_array($resultado2);
      if ($mifila2["num"] == 0 || $mifila2["num"]=="") {
         $passVar=true;
         $otrs="entra al if";
      }else
      {
        $passVar=false;
        $otrs="No entra al if";
      } 
  
}

$EmailContac=$email_from;
$nomEmpresa=strtoupper($_POST["nomEmpresa"]);
$nomContacto=strtoupper($_POST["rfcEmpresa"]);
$Telefono=$_POST["Telefono"];
$vertical=$_POST["vertical"];
$pais=strtoupper($_POST["pais"]);
$estado=strtoupper($_POST["estado"]);
$municipio=strtoupper($_POST["ciudad"]);
$cp=$_POST["postal"];
$domicilio=strtoupper($_POST["domicilio"]);

$comprador.= "<label>Nombre de la Empresa : </label><label>$nomEmpresa</label><br>";
$comprador.= "<label>Nombre del Contacto : </label><label>$nomContacto</label><br>";
$comprador.= "<label>Correo Electrónico de Contacto : </label><label>$EmailContac</label><br>";
$comprador.= "<label>Teléfono de Contacto : </label><label>$Telefono</label><br>";
$comprador.= "<label>Vertical : </label><label>$vertical</label><br>";
$comprador.= "<label>País : </label><label>$pais</label><br>";
$comprador.= "<label>Estado : </label><label>$estado</label><br>";
$comprador.= "<label>Municipio : </label><label>$municipio</label><br>";
$comprador.= "<label>CP : </label><label>$cp</label><br>";

$comprador2= "Nombre de la Empresa : $nomEmpresa   - ";
 $objPHPExcel->getActiveSheet()->SetCellValue('B'.($i+4), $comprador2);
$comprador2= "Nombre del Contacto : $nomContacto  - ";
 $objPHPExcel->getActiveSheet()->SetCellValue('B'.($i+5), $comprador2);
$comprador2= "Correo Electrónico de Contacto : $EmailContac  - ";
 $objPHPExcel->getActiveSheet()->SetCellValue('B'.($i+6), $comprador2);
$comprador2= "Teléfono de Contacto : $Telefono - ";
 $objPHPExcel->getActiveSheet()->SetCellValue('B'.($i+7), $comprador2);
$comprador2= "Vertical : $vertical";
 $objPHPExcel->getActiveSheet()->SetCellValue('B'.($i+8), $comprador2);
$numeroSemana = date("W"); 

$sql="insert into cliente (idCliente,correo,nomEmpresa,nomContacto,tel,vertical,pais,estado,municipio,cp,domicilio,semana) values('$contraPass','$EmailContac','$nomEmpresa','$nomContacto','$Telefono','$vertical','$pais','$estado','$municipio','$cp','$domicilio',$numeroSemana)";
//echo "$sql"."<br>";

$result = mysql_query($sql);
if ($result) {
  echo "Hecho";
}else
{
  echo "No hecho";
}
$usuarioNumero= $EmailContac."- correo  registrado<br>".$contraPass. " - Numero de Cliente.";
$correo2 = new PHPMailer();
$correo2->Timeout=20;
$correo2->IsSMTP();
$correo2->SMTPAuth = true;
$correo2->SMTPSecure = "tls";
$correo2->Host = "smtp.office365.com";
$correo2->Port = 587;
 echo "Eviar correo 2";
//Nuestra cuenta
$correo2->Username ='telemarketing@pacificstar.com.mx';
$correo2->Password = 'Inicio01'; //Su password
// Codificación UTF8. Obligado utilizarlo en aplicaciones en Español
$correo2->CharSet = 'UTF-8';
$correo2->IsHTML(true);
$correo2->SetFrom("telemarketing@pacificstar.com.mx", "CATALOGO DIGITAL");
$correo2->AddReplyTo("telemarketing@pacificstar.com.mx","CATALOGO DIGITAL");

$correo2->Subject = "CATALOGO DIGITAL Usuario";
$correo2->MsgHTML("$usuarioNumero");

//$direcciones2["direccion2"]=$otroCorreo;
//$direcciones2["direccion2"]="mbustillo@pacificstar.com.mx";
//$direcciones2["direccion3"]="telemarketing@pacificstar.com.mx";
$direcciones2["direccion1"]=$EmailContac;

 reset($direcciones2);
 while (list($clave, $valor)=each($direcciones2)) {
  $correo2->AddAddress($valor);

  //se envia el mensaje, si no ha habido problemas la variable $success 
  //tendra el valor true
$exito = $correo2->Send();
if(!$exito)
  {
     echo "Problemas enviando correo electrónico a ".$valor;
     echo "<br/>".$correo2->ErrorInfo; 
  }
  else
  {
     //Mostramos un mensaje indicando las direccion de 
     //destino y fichero  adjunto enviado en el mensaje 
     $mensaje="<p>Has enviado un mensaje a:<br/>";
     $mensaje.=$valor." ";
     
     $mensaje.="</p>";
         echo $mensaje;
  $correo2->ClearAddresses(); 

 
  }
$correo2->ClearAddresses(); 
} 



//fin correo del cliente



}
else if($correoF2=="")
{
  echo "entro al if del email";
  $email_from = $_POST["correo"];
  $numCliente = $_POST['cuenta'];
$comprador.= "<label>Correo Electrónico de Contacto : </label><label>$email_from</label><br>";
$comprador2= "Correo Electrónico de Contacto : $email_from ";
$comprador3= "Número de Cliente: $numCliente ";
$body= $body."Enviado por:  CATALOGO DIGITAL <br>";

 $objPHPExcel->getActiveSheet()->SetCellValue('B'.($i+4), $comprador2);
 $objPHPExcel->getActiveSheet()->SetCellValue('B'.($i+5), $comprador3);
  }
$body .= $comprador;
$body= $body."<br>";
// Mensaje que tiene que recibir

$estiloTituloReporte = array(
    'font' => array(
        'name'      => 'Verdana',
        'bold'      => true,
        'italic'    => false,
        'strike'    => false,
        'size' =>16,
        'color'     => array(
            'rgb' => 'FFFFFF'
        )
    ),
    'fill' => array(
        'type'  => PHPExcel_Style_Fill::FILL_SOLID,
        'color' => array(
            'argb' => 'FF220835')
    ),
    'borders' => array(
        'allborders' => array(
            'style' => PHPExcel_Style_Border::BORDER_NONE
        )
    ),
    'alignment' => array(
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
        'rotation' => 0,
        'wrap' => TRUE
    )
);
 
$estiloTituloColumnas = array(
    'font' => array(
        'name'  => 'Arial',
        'bold'  => true,
        'color' => array(
            'rgb' => 'FFFFFF'
        )
    ),
    'fill' => array(
        'type'  => PHPExcel_Style_Fill::FILL_SOLID,
        'color' => array(
            'argb' => '2089CA')
    ),
    'borders' => array(
        'top' => array(
            'style' => PHPExcel_Style_Border::BORDER_MEDIUM ,
            'color' => array(
                'rgb' => '143860'
            )
        ),
        'bottom' => array(
            'style' => PHPExcel_Style_Border::BORDER_MEDIUM ,
            'color' => array(
                'rgb' => '143860'
            )
        )
    ),
    'alignment' =>  array(
        'horizontal'=> PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        'vertical'  => PHPExcel_Style_Alignment::VERTICAL_CENTER,
        'wrap'      => TRUE
    )
);
 echo "entra a excel1";
$estiloInformacion = new PHPExcel_Style();
$estiloInformacion->applyFromArray( array(
    'font' => array(
        'name'  => 'Arial',
        'color' => array('rgb' => '000000')),
    'fill' => array(
    'type'  => PHPExcel_Style_Fill::FILL_SOLID,
    'color' => array(
            'argb' => 'FFd9b7f4')
    ),
    'borders' => array(
        'left' => array(
            'style' => PHPExcel_Style_Border::BORDER_THIN ,
        'color' => array(
                'rgb' => '3a2a47'
            )
        )
    )
));

 echo "entra a excel2";
$objPHPExcel->getActiveSheet()->getStyle('A1:L1')->applyFromArray($estiloTituloReporte);
$objPHPExcel->getActiveSheet()->getStyle('A3:L3')->applyFromArray($estiloTituloColumnas);
$objPHPExcel->getActiveSheet()->setSharedStyle($estiloInformacion, "A4:L".($i-1));
// Se asigna el nombre a la hoja
$objPHPExcel->getActiveSheet()->setTitle('codigos');
 echo "entra a excel2.1";
 
// Se activa la hoja para que sea la que se muestre cuando el archivo se abre
$objPHPExcel->setActiveSheetIndex(0);
 
// Inmovilizar paneles
//$objPHPExcel->getActiveSheet(0)->freezePane('A4');
$objPHPExcel->getActiveSheet(0)->freezePaneByColumnAndRow(0,4);
echo "entra a excel2.2";
 $excelSalida=$fecha_actual;
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');

$objWriter->save("EXCEL/excelSalida.xlsx");


 echo "entra a excel3";

echo "Eviar correo 1";
echo "Eviar correo 1";
$correo = new PHPMailer();
// Seteo del uso
$correo->IsSMTP(); // Uso SMTP
// Seteo de la seguridad
$correo->SMTPSecure = 'tls';
// Autenticación
$correo->SMTPAuth = true;
// Host
$correo->Host = "smtp.office365.com";
// Puerto
$correo->Port = 587;
// Degug. Valores 1 -> errores y mensajes // 2 solo mensajes // 0 no informa nada
$correo->SMTPDebug = 0;
// Usuario
$correo->Username ='telemarketing@pacificstar.com.mx';
$correo->Password = 'Inicio01'; //Su password
// Codificación UTF8. Obligado utilizarlo en aplicaciones en Español
$correo->CharSet = 'UTF-8';
$correo->IsHTML(true);
// Quien envia
$correo->SetFrom("telemarketing@pacificstar.com.mx", "COMPRAS OPORTUNIDAD");
// A quien se responderá
$correo->AddReplyTo("telemarketing@pacificstar.com.mx", "COMPRAS OPORTUNIDAD");
$correo->AddAttachment("EXCEL/excelSalida.xlsx");
$correo->Subject = "CATALOGO DIGITAL";
$body=sanear_string($body);
$correo->MsgHTML("$body");

echo "Eviar correo 3";
//$direcciones["direccion2"]="mbustillo@pacificstar.com.mx";
//$direcciones["direccion3"]="telemarketing@pacificstar.com.mx";
$direcciones["direccion4"]="juanjoreynara@hotmail.com";
$direcciones["direccion1"]=$email_from;

 reset($direcciones);
 while (list($clave, $valor)=each($direcciones)) {
  $correo->AddAddress($valor);

$exito = $correo->Send();
  //se envia el mensaje, si no ha habido problemas la variable $success 
  //tendra el valor true 
  if(!$exito)
  {
     echo "Problemas enviando correo electrónico a ".$valor;
     echo "<br/>".$correo->ErrorInfo; 
  }
  else
  {
     //Mostramos un mensaje indicando las direccion de 
     //destino y fichero  adjunto enviado en el mensaje 
     $mensaje="<p>Has enviado un mensaje a:<br/>";
     $mensaje.=$valor." ";
     
     $mensaje.="</p>";
         echo $mensaje;
  $correo->ClearAddresses(); 

  }

}


$correo->ClearAddresses(); 
echo "Eviar correo 4";
session_destroy();
echo "<script languaje='javascript' type='text/javascript'>window.open('../catalogo.php','ventanaprincipal');</script>";


?>
</body>
</html>
