<?php

/**
 * @author MESMERiZE
 * @copyright 2014
 */

include ('../includes/funcionesUsuarios.php');

$serviciosUsuarios = new ServiciosUsuarios();

$serviciosUsuarios->enviarPagoPayPal();
$serviciosUsuarios->enviarPagoTransferencia();


?>