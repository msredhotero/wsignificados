<?

require "../db/Singleton.class.php";
require "../Validator.class.php";
require "Persona.class.php";

require "cliente/Cliente.class.php";
require "cliente/Factory.class.php";

require('fpdf.php');
require('facturaDisenio.php');

$cliente = $_GET['idcliente'];

$factura = $_GET['idfactura'];

$comillas = "";

session_start();


//$pdf=new FPDF('P','mm','A4');
$pdf=new FPDF('P','mm',array(210,297));
$pdf->SetMargins(0,0,0,0);
$pdf->AddPage();


//session_start();
//$pdf->Image('reciboHaberes.jpg',0,0,'210','170'); 

$pdf->SetAutoPageBreak(true, 0);


$cant_r = 0;

$cambio = false;

$registros = 0;
$total_haberes = 0;
$total_aportes = 0;
$total_desc = 0;
$primero = 0;



$server = "localhost";
$database = "dbadministracionclientes";
$user = "root";
$password = "";

$conexion=mysql_connect($server,$user,$password) or die("Problemas en la conexion");
$base = mysql_select_db($database, $conexion);

//$conexion = odbc_connect("Driver={SQL Server};Server=$server;Database=$database;", $user, $password);



$cant = 0;
$cambio = false;
$agente = "";

//nuevo, esto es para los que tienen mas de un cargo en una liquidacion
$cargo = "";


$legajo_a = 9999;
$depe = "";	
$registros = 0;
$primero = 0;
$renglones = 0;
$aux = 1;


while ($row = odbc_fetch_array($rs_sql_sp)) {


	if ($aux == 2)
		$aux = 1;
		
		if ($row['liquido'] == "***************")
		{
			$legajo_a = 0;
			$aux++;
			//$cant=1;
		}
		
		
		if ($legajo_a <> (integer)$row['ref']) {
		$legajo_a = (integer)$row['ref'];
		//$cargo = $row['Ref'];
		$numeracion++;
	    $repite = 0;
		$cant++;
		$renglones = 0;
	    
	    switch ($cant) {
	    case 1:
	        Datos2($row['Legajo'],$row['APEYNOM'],$row['Cuil'],$row['Dependencia'],$row['Funcion'],$row['ProgramaDescripcion'],$row['Agrupamiento'],$row['categoria'],$row['Sucursal'],$row['nrocuenta'],$row['liquido'],$row['Mes'],$row['Anio'],$row['ref'],$row['RegHorario'],$row['Antiguedad'],$row['IConcepto'],$row['ICantidad'],$row['IImporte'],$row['DConcepto'],$row['DCantidad'],$row['DImporte'],$pdf,3 * $renglones,$repite,$row['fechatomaposesion'],$numeracion);
	        break;
	    case 2:
	        Datos2($row['Legajo'],$row['APEYNOM'],$row['Cuil'],$row['Dependencia'],$row['Funcion'],$row['ProgramaDescripcion'],$row['Agrupamiento'],$row['categoria'],$row['Sucursal'],$row['nrocuenta'],$row['liquido'],$row['Mes'],$row['Anio'],$row['ref'],$row['RegHorario'],$row['Antiguedad'],$row['IConcepto'],$row['ICantidad'],$row['IImporte'],$row['DConcepto'],$row['DCantidad'],$row['DImporte'],$pdf,(3 * $renglones)+148,$repite,$row['fechatomaposesion'],$numeracion);
			break;
	    case 3:

			$pdf->AddPage();
	        //$pdf->Image('recibos-vacio.jpg',0,0,'210','297'); 
	        $cant = 1;
	        
	        Datos2($row['Legajo'],$row['APEYNOM'],$row['Cuil'],$row['Dependencia'],$row['Funcion'],$row['ProgramaDescripcion'],$row['Agrupamiento'],$row['categoria'],$row['Sucursal'],$row['nrocuenta'],$row['liquido'],$row['Mes'],$row['Anio'],$row['ref'],$row['RegHorario'],$row['Antiguedad'],$row['IConcepto'],$row['ICantidad'],$row['IImporte'],$row['DConcepto'],$row['DCantidad'],$row['DImporte'],$pdf,3 * $renglones,$repite,$row['fechatomaposesion'],$numeracion);
	        
	        break;
		}
		$renglones++;
		
		
		
		
	} else {
		
			$repite = 1;	
		
			
			switch ($cant) {
			    case 1:
			        Datos2($row['Legajo'],$row['APEYNOM'],$row['Cuil'],$row['Dependencia'],$row['Funcion'],$row['ProgramaDescripcion'],$row['Agrupamiento'],$row['categoria'],$row['Sucursal'],$row['nrocuenta'],$row['liquido'],$row['Mes'],$row['Anio'],$row['ref'],$row['RegHorario'],$row['Antiguedad'],$row['IConcepto'],$row['ICantidad'],$row['IImporte'],$row['DConcepto'],$row['DCantidad'],$row['DImporte'],$pdf,3 * $renglones,$repite,$row['fechatomaposesion'],$numeracion);
			        
			        break;
			    case 2:
			        Datos2($row['Legajo'],$row['APEYNOM'],$row['Cuil'],$row['Dependencia'],$row['Funcion'],$row['ProgramaDescripcion'],$row['Agrupamiento'],$row['categoria'],$row['Sucursal'],$row['nrocuenta'],$row['liquido'],$row['Mes'],$row['Anio'],$row['ref'],$row['RegHorario'],$row['Antiguedad'],$row['IConcepto'],$row['ICantidad'],$row['IImporte'],$row['DConcepto'],$row['DCantidad'],$row['DImporte'],$pdf,(3 * $renglones)+148,$repite,$row['fechatomaposesion'],$numeracion);
			        break;
				}
			     
			
			$renglones++;
	
	}


//$resultado_cant = mysql_query("call consulta_simple(".$liq.", ".$leg.");",$conexion);


//$pdf->AddPage();



}



/*
//PRIMER RECIBO

		//cabecera del recibo
		
		//mes
		$pdf->SetFont('Arial','B',9);
		$pdf->SetXY(9.5,21);
		$pdf->cell(8,4,'06',0,0,'C');
		
		//año
		$pdf->SetFont('Arial','B',9);
		$pdf->SetXY(20,21);
		$pdf->cell(8,4,'2013',0,0,'C');
		
		//legajo
		$pdf->SetFont('Arial','B',9);
		$pdf->SetXY(36,21);
		$pdf->cell(8,4,'671306',0,0,'C');
		
		//nro documento
		$pdf->SetFont('Arial','B',9);
		$pdf->SetXY(56,21);
		$pdf->cell(8,4,'31552466',0,0,'C');
		
		//apellido y nombre
		$pdf->SetFont('Arial','B',9);
		$pdf->SetXY(73,21);
		$pdf->cell(90,4,'SAUPUREIN SAFAR MARCOS DANIEL',0,0,'C');
		
		//fecha ingreso
		$pdf->SetFont('Arial','B',9);
		$pdf->SetXY(178,21);
		$pdf->cell(12,4,'01/08/2009',0,0,'C');
		
		//segundo reglon
		
		//antiguedad
		$pdf->SetFont('Arial','B',9);
		$pdf->SetXY(9.5,33);
		$pdf->cell(8,4,'06',0,0,'C');
		
		//cuil
		$pdf->SetFont('Arial','B',9);
		$pdf->SetXY(19,33);
		$pdf->cell(24,4,'20-315524666-1',0,0,'C');
		
		//dependencia
		$pdf->SetFont('Arial','B',9);
		$pdf->SetXY(44,33);
		$pdf->cell(80,4,'HOSP. INT. GRAL. A. "SAN MARTIN"',0,0,'C');
		
		//PROGRAMA
		$pdf->SetFont('Arial','B',9);
		$pdf->SetXY(125.5,33);
		$pdf->cell(36,4,'ACE0007',0,0,'C');
		
		//Grupo
		$pdf->SetFont('Arial','B',9);
		$pdf->SetXY(168,33);
		$pdf->cell(8,4,'05',0,0,'C');
		
		//Categoria
		$pdf->SetFont('Arial','B',9);
		$pdf->SetXY(184,33);
		$pdf->cell(8,4,'05',0,0,'C');
		
		//FIN CABECERA
		
		
		
		
		
		
		//CONCEPTOS DEL RECIBO
		
		
		//ICONCEPTO
		$pdf->SetFont('Arial','B',8);
		$pdf->SetXY(9.5,44);
		$pdf->cell(60,3,'010-1 - Sueldo Básico con Aportes',0,0,'L');
		
		//icantidad
		$pdf->SetFont('Arial','B',8);
		$pdf->SetXY(75,44);
		$pdf->cell(7,3,'1',0,0,'C');
		
		
		//iImporte
		$pdf->SetFont('Arial','B',8);
		$pdf->SetXY(86.5,44);
		$pdf->cell(15,3,'66.652,25',0,0,'C');
		
		
		
		//DCONCEPTO
		$pdf->SetFont('Arial','B',8);
		$pdf->SetXY(102.5,44);
		$pdf->cell(60,3,'030-1 - Bonificación de Informático %60',0,0,'L');
		
		//Dcantidad
		$pdf->SetFont('Arial','B',8);
		$pdf->SetXY(169,44);
		$pdf->cell(7,3,'1',0,0,'C');
		
		
		//DImporte
		$pdf->SetFont('Arial','B',8);
		$pdf->SetXY(179.5,44);
		$pdf->cell(15,3,'9822,25',0,0,'C');
		
		//FIN CONCEPTOS
		
		
		
		
		//pie del recibo
		
		
		//RH
		$pdf->SetFont('Arial','B',9);
		$pdf->SetXY(75,136);
		$pdf->cell(6,4,'30',0,0,'C');
		
		//sucrusal
		$pdf->SetFont('Arial','B',9);
		$pdf->SetXY(93,136);
		$pdf->cell(8,4,'2000',0,0,'C');
		
		//cta
		$pdf->SetFont('Arial','B',9);
		$pdf->SetXY(115,136);
		$pdf->cell(20,4,'563789/1',0,0,'C');
		
		//liquido
		$pdf->SetFont('Arial','B',9);
		$pdf->SetXY(157,136);
		$pdf->cell(30,4,'***9.000,00*',0,0,'C');
		
		//FIN PIE

//Fin del primer recibo







//SEGUNDO RECIBO

		//cabecera del recibo
		
		//mes
		$pdf->SetFont('Arial','B',9);
		$pdf->SetXY(9.5,172);
		$pdf->cell(8,4,'06',0,0,'C');
		
		//año
		$pdf->SetFont('Arial','B',9);
		$pdf->SetXY(20,172);
		$pdf->cell(8,4,'2013',0,0,'C');
		
		//legajo
		$pdf->SetFont('Arial','B',9);
		$pdf->SetXY(36,172);
		$pdf->cell(8,4,'671306',0,0,'C');
		
		//nro documento
		$pdf->SetFont('Arial','B',9);
		$pdf->SetXY(56,172);
		$pdf->cell(8,4,'31552466',0,0,'C');
		
		//apellido y nombre
		$pdf->SetFont('Arial','B',9);
		$pdf->SetXY(73,172);
		$pdf->cell(90,4,'SAUPUREIN SAFAR MARCOS DANIEL',0,0,'C');
		
		//fecha ingreso
		$pdf->SetFont('Arial','B',9);
		$pdf->SetXY(178,172);
		$pdf->cell(12,4,'01/08/2009',0,0,'C');
		
		//segundo reglon
		
		//antiguedad
		$pdf->SetFont('Arial','B',9);
		$pdf->SetXY(9.5,184);
		$pdf->cell(8,4,'06',0,0,'C');
		
		//cuil
		$pdf->SetFont('Arial','B',9);
		$pdf->SetXY(19,184);
		$pdf->cell(24,4,'20-315524666-1',0,0,'C');
		
		//dependencia
		$pdf->SetFont('Arial','B',9);
		$pdf->SetXY(44,184);
		$pdf->cell(80,4,'HOSP. INT. GRAL. A. "SAN MARTIN"',0,0,'C');
		
		//PROGRAMA
		$pdf->SetFont('Arial','B',9);
		$pdf->SetXY(125.5,184);
		$pdf->cell(36,4,'ACE0007',0,0,'C');
		
		//Grupo
		$pdf->SetFont('Arial','B',9);
		$pdf->SetXY(168,184);
		$pdf->cell(8,4,'05',0,0,'C');
		
		//Categoria
		$pdf->SetFont('Arial','B',9);
		$pdf->SetXY(184,184);
		$pdf->cell(8,4,'05',0,0,'C');
		
		
		//FIN CABECERA
		
		
		
		
		
		
		//CONCEPTOS DEL RECIBO
		
		
		//ICONCEPTO
		$pdf->SetFont('Arial','B',8);
		$pdf->SetXY(9.5,195);
		$pdf->cell(60,3,'010-1 - Sueldo Básico con Aportes',0,0,'L');
		
		//icantidad
		$pdf->SetFont('Arial','B',8);
		$pdf->SetXY(75,195);
		$pdf->cell(7,3,'1',0,0,'C');
		
		
		//iImporte
		$pdf->SetFont('Arial','B',8);
		$pdf->SetXY(86.5,195);
		$pdf->cell(15,3,'66.652,25',0,0,'C');
		
		
		
		//DCONCEPTO
		$pdf->SetFont('Arial','B',8);
		$pdf->SetXY(102.5,195);
		$pdf->cell(60,3,'030-1 - Bonificación de Informático %60',0,0,'L');
		
		//Dcantidad
		$pdf->SetFont('Arial','B',8);
		$pdf->SetXY(169,195);
		$pdf->cell(7,3,'1',0,0,'C');
		
		
		//DImporte
		$pdf->SetFont('Arial','B',8);
		$pdf->SetXY(179.5,195);
		$pdf->cell(15,3,'9822,25',0,0,'C');
		
		//FIN CONCEPTOS
		
		
		
		
		//pie del recibo
		
		
		//RH
		$pdf->SetFont('Arial','B',9);
		$pdf->SetXY(75,287);
		$pdf->cell(6,4,'30',0,0,'C');
		
		//sucrusal
		$pdf->SetFont('Arial','B',9);
		$pdf->SetXY(93,287);
		$pdf->cell(8,4,'2000',0,0,'C');
		
		//cta
		$pdf->SetFont('Arial','B',9);
		$pdf->SetXY(115,287);
		$pdf->cell(20,4,'563789/1',0,0,'C');
		
		//liquido
		$pdf->SetFont('Arial','B',9);
		$pdf->SetXY(157,287);
		$pdf->cell(30,4,'***9.000,00*',0,0,'C');
		
		//FIN PIE

//Fin del segundo recibo
*/



$nombreLiquidacion = $nombreTraido."-".$tipoPago."-TODOS.pdf";

$pdf->Output($nombreLiquidacion,'D');
//$pdf->Output();


/*
header('Content-type: application/pdf');
header ("Content-Disposition: attachment; filename=".$nombreLiquidacion);
readfile($nombreLiquidacion);
*/


//echo "<br><br><a href='".$nombreLiquidacion."'>Descargar Recibo</a>";
/*
header('Content-type: application/pdf');
header('Content-Disposition: attachment; filename="'.$nombre.'.pdf"');
readfile("nada");
*/

$contador = odbc_exec($conexion,"exec [dbo].[spContabilizarRecibos] ".$numeracionInicial.",".$numeracion);

odbc_close($conexion);


