<?php
include_once ("models/model.php");
include ("controllers/controller.php");
include ("views/view.php");
include "conf/config.inc.php";

session_start ();

$action = "";
if (! empty ( $_REQUEST ['action'] ))
	$action = $_REQUEST ['action'];

$model = new Model ();
$controller = new Controller ( $model, $action );
$view = new View ( $controller, $model );

$view->getHTMLOutput ();
?>