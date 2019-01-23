<?php
 
/**
* Disk Status Class - Example
*
* http://pmav.eu/stuff/php-disk-status/
*
* 22/Aug/2009
*/
 
require_once 'DiskStatus.class.php';
 
try {
	$diskStatus = new DiskStatus('/opt/lampp/htdocs/deportesi/web/img/evento');
	 
	$freeSpace = $diskStatus->freeSpace();
	$totalSpace = $diskStatus->totalSpace();
	$barWidth = ($diskStatus->usedSpace()/100) * 400;
 
} catch (Exception $e) {
	echo 'Error ('.$e->getMessage().')';
	exit();
}
 
?>
 
<<? ?>?xml version="1.0" encoding="UTF-8"?<? ?>>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<style>
		body {
		font: bold 30px "Arial";
		letter-spacing: -1px;
		}
		 
		.disk {
		border: 4px solid black;
		width: 400px;
		padding: 2px;
		}
		 
		.used {
		display block;
		background: red;
		text-align: right;
		padding: 0 0 0 0;
		}
	</style>
	<title>Disk Status</title>
</head>
<body>
	<div class="disk">
	<div class="used" style="width: <?= $barWidth ?>px"><?= $diskStatus->usedSpace() ?>%&nbsp;</div>
	</div>
	Free: <?= $freeSpace ?> (of <?= $totalSpace ?>)
</body>
</html>