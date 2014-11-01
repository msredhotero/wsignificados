<?

//set_include_path("../class");

require "../class/db/Singleton.class.php";
require "../class/Validator.class.php";
require "../class/Persona.class.php";

require "../class/cliente/Cliente.class.php";
require "../class/cliente/Factory.class.php";

require "../class/factura/Factura.class.php";
require "../class/factura/Factory.class.php";

require "../includes/funcionesClientes.php";

require('fpdf.php');
require('facturaDisenio.php');

$idfactura = $_GET['idfactura'];

//$factura = $_GET['idfactura'];

$comillas = "";

session_start();

$ServiciosClientes = new ServiciosClientes();

$nombreTraido = "N°Factura:";
//$pdf=new FPDF('P','mm','A4');
$pdf=new FPDF('P','mm',array(210,297));
$pdf->SetMargins(0,0,0,0);
$pdf->AddPage();


//session_start();
$pdf->Image('../imagenes/LogoSEO1.jpg',50,0,'120','30'); 

$pdf->SetAutoPageBreak(true, 0);


$cant_r = 0;

$cambio = false;

$registros = 0;
$total_haberes = 0;
$total_aportes = 0;
$total_desc = 0;
$primero = 0;

//************************//Datos de la empresa////************************

$datosFacturacion = $ServiciosClientes->TraerDatosDeFacturacion(9999);

if (mysql_num_rows($datosFacturacion) > 0) {
							$nombreEmpresa			=	mysql_result($datosFacturacion,0,2);
							$direccionEmpresa		=	mysql_result($datosFacturacion,0,3);
							$ciudadEmpresa			=	mysql_result($datosFacturacion,0,4);
							$paisEmpresa			=	mysql_result($datosFacturacion,0,5);
							$nifEmpresa			=	mysql_result($datosFacturacion,0,6);
							$telefonofijoEmpresa	=	mysql_result($datosFacturacion,0,7);
							$telefonomovilEmpresa	=	mysql_result($datosFacturacion,0,8);

						} else {
							$nombreEmpresa			=	"";
							$direccionEmpresa		=	"";
							$ciudadEmpresa			=	"";
							$paisEmpresa			=	"";
							$nifEmpresa			=	"";
							$telefonofijoEmpresa	=	"";
							$telefonomovilEmpresa	=	"";
						
						}
			/*			
$nombreEmpresa = "SEO Madrid";
$direccionEmpresa = "Calle Ordicia, 15, 28041";
$paisEmpresa = "España";
$ciudadEmpresa = "Madrid";
$nifEmpresa = "111111";
$telefonofijoEmpresa = "91 032 70 49";
$telefonomovilEmpresa = "692 698 340";
*/

//************************//Fin Datos de la empresa////************************

try{

/*        $parametrosConexion =   Array(
                                        "host"=>"localhost",
                                        "user"=>"root",
                                        "pass"=>"",
                                        "db"=>"dbadministracionclientes"
        );*/
        
       
        $parametrosConexion =   Array(
                                        "host"=>"db494455387.db.1and1.com",
                                        "user"=>"dbo494455387",
                                        "pass"=>"Admin1234",
                                        "db"=>"db494455387"
        );

        /**
         * El patron singleton sirve para mantener una unica instancia de un objeto
         * alrededor de toda la ejecucion de un script.
         */

        $conexion   =   \Db\Singleton::getInstance($parametrosConexion);

        $usuario    =   new Cliente();
        $factura	=	new Factura();
       
        //$resultado  = 	\cliente\Factory::getInstanceById(1);
        //$resultado  = 	\cliente\Factory::getInstanceById($cliente);
        $resDetalleFactura = $ServiciosClientes->TraerDetalleCompraA($idfactura);
        $resFactura =	$ServiciosClientes->TraerCompraA($idfactura);
        
		
        while ($row = mysql_fetch_array($resFactura))
			{
				$iva = $row[4]*$row[5];
				$retencion = $row[4]*$row[12];
				if ($row[14] == "") {
					$otros = 0;
				} else {
					$otros = $row[14];
				}
				
				$subTotal = $row[4];
				$total = $row[2];
                $comentarios = $row[15];
				$nroFactura = $row[1];
				$date = date_create($row[17]);
				$fechaCreacion = date_format($date,'Y-m-d');
				$idcliente = $row[16];
			}
        
        $resFacturacion = $ServiciosClientes->TraerDatosDeFacturacion($idcliente);
        
        
		if (mysql_num_rows($resFacturacion) > 0) {
							$nombre			=	mysql_result($resFacturacion,0,2);
							$direccion		=	mysql_result($resFacturacion,0,3);
							$ciudad			=	mysql_result($resFacturacion,0,4);
							$pais			=	mysql_result($resFacturacion,0,5);
							$nif			=	mysql_result($resFacturacion,0,6);
							$telefonofijo	=	mysql_result($resFacturacion,0,7);
							$telefonomovil	=	mysql_result($resFacturacion,0,8);

						} else {
							$nombre			=	"";
							$direccion		=	"";
							$ciudad			=	"";
							$pais			=	"";
							$nif			=	"";
							$telefonofijo	=	"";
							$telefonomovil	=	"";
						
						}
		
		
		
	$nombreTraido = $nombreTraido.$nroFactura;	
/*
			while ($row = $resultado->FETCH_row())
			{
				echo $row[1]."<br>";
			}
*/
		//var_dump($resultado->FETCH_ASSOC());
    }catch(Exception $e){

        //SI el codigo esta siendo ejecutado en el localhost
        //echo "error";
        //require "404.php";
        die();
        
    }    

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


//datos de la empresa
$pdf->SetFillColor(2,157,116);
$pdf->SetTextColor(240, 255, 240);
$pdf->Rect(20,40,75,26,'DF');

$pdf->SetFont('Arial','',9);
$pdf->SetXY(20,42);
$pdf->cell(28,2,'Nombre: '.$nombreEmpresa,0,0,'L');
$pdf->SetXY(20,46);
$pdf->cell(28,2,'Dirección:'.$direccionEmpresa,0,0,'L');
$pdf->SetXY(20,50);
$pdf->cell(28,2,'Pais:'.$paisEmpresa,0,0,'L');
$pdf->SetXY(20,54);
$pdf->cell(28,2,'Ciudad/Provincial: '.$ciudadEmpresa,0,0,'L');
$pdf->SetXY(20,58);
$pdf->cell(28,2,'NIF/CIF:'.$nifEmpresa,0,0,'L');
$pdf->SetXY(20,62);
$pdf->cell(28,2,'Teléfonos, Fijo:'.$telefonofijoEmpresa.' - Movil:'.$telefonomovilEmpresa,0,0,'L');
//fin datos de la empresa

//datos de la factura
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial','B',10);
$pdf->SetXY(165,44);
$pdf->cell(10,4,'Factura',0,0,'L');
$pdf->SetXY(165,49);
$pdf->SetFont('Arial','B',8);

$pdf->SetFillColor(227,227,227); 
$pdf->cell(28,4,$fechaCreacion,1,0,'R',1);
$pdf->SetXY(165,54);

$pdf->SetFillColor(246,216,206); 
$pdf->cell(28,4,$nroFactura,1,0,'R',1);

$pdf->SetFont('Arial','B',10);
$pdf->SetXY(140,49);
$pdf->cell(13,4,'Fecha:',0,0,'L',0);
$pdf->SetXY(140,54);
$pdf->cell(13,4,'NºFactura:',0,0,'L',0);
//fin datos factura


//facturar datos del cliente
$pdf->SetXY(90,67);
$pdf->SetFillColor(138,176,36); 
$pdf->SetTextColor(255, 255, 255);
$pdf->cell(28,5,'FACTURAR A:',1,0,'C',1);

$pdf->SetFillColor(2,157,116);
$pdf->SetTextColor(240, 255, 240);
$pdf->Rect(85,73,75,25,'DF');

$pdf->SetFont('Arial','',9);
$pdf->SetXY(86,74);
$pdf->cell(28,2,'Nombre: '.$nombre,0,0,'L');
$pdf->SetXY(86,78);
$pdf->cell(28,2,'Dirección:'.$direccion,0,0,'L');
$pdf->SetXY(86,82);
$pdf->cell(28,2,'Pais:'.$pais,0,0,'L');
$pdf->SetXY(86,86);
$pdf->cell(28,2,'Ciudad/Provincial: '.$ciudad,0,0,'L');
$pdf->SetXY(86,90);
$pdf->cell(28,2,'NIF/CIF:'.$nif,0,0,'L');
$pdf->SetXY(86,94);
$pdf->cell(28,2,'Teléfonos, Fijo:'.$telefonofijo.' - Movil:'.$telefonomovil,0,0,'L');

//fin datos del cliente

$pdf->SetFont('Arial','B',9);
//tabla de detalle de la factura
	//encabezado
	$pdf->SetTextColor(255, 255, 255);
	
	$pdf->SetXY(10,100);
	$pdf->SetFillColor(138,176,36);  
	$pdf->cell(140,4,'DESCRIPCION',1,0,'C',1);

	$pdf->SetXY(150,100);
	$pdf->SetFillColor(138,176,36); 
	$pdf->cell(30,4,'IMPORTE',1,0,'C',1);
	//fin encabezado
	
	//detalle
	$pdf->Rect(10,104,140,90,'D');
	$pdf->Rect(150,104,30,90,'D');
    
    $pdf->SetXY(12,106);
        
        //seteo el color de la fuente
        $pdf->SetTextColor(0, 0, 0);
        

        $y=106;
        while ($rowDetalle = mysql_fetch_array($resDetalleFactura)) {
        	//descripcion
	        $pdf->SetXY(12,$y);
	        $pdf->cell(136,5,$rowDetalle[2],0,0,'L');
	    
	        //importe
	        $pdf->SetXY(152,$y);
	        $pdf->cell(26,5,number_format($rowDetalle[3],2,',','.').' €',0,0,'R');
			
			$y=$y+5;	
        }
        
	//fin detalle
	
	//subtotales
	$pdf->SetFillColor(227,227,227); 
	$pdf->Rect(150,195,30,5,'F');
    
        //seteo el color de la fuente
        $pdf->SetTextColor(0, 0, 0);
        //subtotal
            $pdf->SetXY(152,195);
            $pdf->cell(26,5,number_format($subTotal,2,',','.').' €',0,0,'R');
        //fin subtotales
	$pdf->SetFillColor(255,255,255); 
	$pdf->Rect(150,200,30,5,'F');
        
        //seteo el color de la fuente
        $pdf->SetTextColor(0, 0, 0);
        //IVA
            $pdf->SetXY(152,200);
            $pdf->cell(26,5,number_format($iva,2,',','.').' €',0,0,'R');
        //fin iva
	$pdf->SetFillColor(227,227,227); 
	$pdf->Rect(150,205,30,5,'F');
    
        //seteo el color de la fuente
        $pdf->SetTextColor(0, 0, 0);
        //Retenciones
            $pdf->SetXY(152,205);
            $pdf->cell(26,5,number_format((-1*$retencion),2,',','.').' €',0,0,'R');
        //fin retenciones
	$pdf->SetFillColor(255,255,255); 
	$pdf->Rect(150,210,30,5,'F');
    
        //seteo el color de la fuente
        $pdf->SetTextColor(0, 0, 0);
        //otros
            $pdf->SetXY(152,210);
            $pdf->cell(26,5,number_format($otros,2,',','.').' €',0,0,'R');
        //fin otros
	$pdf->SetFillColor(227,227,227); 
	$pdf->Rect(150,215,30,5,'DF');
        
        //seteo el color de la fuente
        $pdf->SetTextColor(0, 0, 0);
	    //totales
            $pdf->SetXY(152,215);
            $pdf->cell(26,5,number_format($total,2,',','.').' €',0,0,'R');
        //fin totales
       
	$pdf->SetTextColor(0, 0, 0);
	$pdf->SetXY(125,195); 
	$pdf->cell(20,5,'SUBTOTAL',0,0,'L');
	$pdf->SetXY(125,200); 
	$pdf->cell(20,5,'I.V.A. 21%',0,0,'L');
	$pdf->SetXY(125,205); 
	$pdf->cell(20,5,'RETENC. 9%',0,0,'L');
	$pdf->SetXY(125,210); 
	$pdf->cell(20,5,'OTROS',0,0,'L');
	$pdf->SetXY(125,215); 
	$pdf->cell(20,5,'TOTAL',0,0,'L');
	//fin subtotales

	//comentarios
	$pdf->SetXY(10,205);
	$pdf->SetFillColor(138,176,36);  
	$pdf->cell(90,4,'DESCRIPCION',1,0,'C',1);
	
    $pdf->SetFont('Arial','B',8);
    $pdf->Rect(10,209,90,40,'D');
    $pdf->SetXY(12,211);
    $pdf->MultiCell(86,3,$comentarios,0,'J');
	//fin comentarios
//fin detalle factura







$nombreLiquidacion = $nombreTraido.".pdf";

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

odbc_close($conexion);


