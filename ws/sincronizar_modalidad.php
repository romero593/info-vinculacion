<?php
ob_start();
require_once('conecta.php');

$id_modalidad=$_GET['id_modalidad'];
$modalidad=$_GET['modalidad'];
$estado=$_GET['estado'];

$resultados=array();

$verifica = 0;

mysqli_select_db($conecta,$database_conecta);

	if($id_modalidad!="-1"){
		$query=" UPDATE `tbl_modalidad` SET 
		`modalidad` = '".$modalidad."', 
		`estado` = '".$estado."'
		WHERE `id_modalidad` = ".$id_modalidad." ";

		if(mysqli_query($conecta,$query)){
			$resultados["mensaje"] = "Actualizados Correctamente";
			$resultados["validacion"] = "ok";
		}else{
			$resultados["mensaje"] = "Ha ocurrido un error por favor contanctese con el Administrador del sistema.";
			$resultados["validacion"] = "notOk: ".mysqli_error($conecta);
		}

	}else{
		$query=" INSERT INTO `tbl_modalidad` (`modalidad`)  value ('".$modalidad."') ";

		if(mysqli_query($conecta,$query)){
			$resultados["mensaje"] = "Guardado Correctamente";
			$resultados["validacion"] = "ok";
			
		}else{
			$resultados["mensaje"] = "Ha ocurrio un error al guardar por favor contanctese con el Administrador del sistema.";
			$resultados["validacion"] = "notOkuPDA: ".mysqli_error($conecta);
		}
	}
	
//}

$resultadosJson = json_encode($resultados);


echo $_GET['jsoncallback'] . '(' . $resultadosJson . ');';


			header('Content-type: text/html; charset=utf-8; application/json');
			
			//Se abre el acceso a las conexiones que requieran de esta aplicacion
			header("Access-Control-Allow-Origin: *");


ob_end_flush();
?>

