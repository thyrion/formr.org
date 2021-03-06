<?php
require_once '../../../define_root.php';
require_once INCLUDE_ROOT.'View/admin_header.php';
session_over($site, $user);
require_once INCLUDE_ROOT.'Model/SpreadsheetReader.php';

$SPR = new SpreadsheetReader();

if(!isset($_GET['format']) OR !in_array($_GET['format'], array("xlsx","xls","json"))) die("invalid format");
$format = $_GET['format'];


if($format == 'xlsx'):
	$items = $study->getItemsForSheet();
	$choices = $study->getChoicesForSheet();
	$SPR->exportItemTableXLSX($items,$choices,$study->name);
elseif($format == 'xls'):
	$items = $study->getItemsForSheet();
	$choices = $study->getChoicesForSheet();
	$SPR->exportItemTableXLS($items,$choices,$study->name);
else: // json
	$items = $study->getItems();
	$choices = $study->getChoices();
	$SPR->exportItemTableJSON($items,$choices,$study->name);
endif;

