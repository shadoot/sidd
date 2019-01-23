<?php
	/*function roundsize($size){
	    $i=0;
	    $iec = array("B", "Kb", "Mb", "Gb", "Tb");
	    while (($size/1024)>1) {
	        $size=$size/1024;
	        $i++;}
	    return(round($size,1)." ".$iec[$i]);
	}

	$ds = disk_total_space("/opt/lampp/htdocs/deportesi/web/img/evento");

	echo roundsize($ds);*/
	//$echo __DIR__ .'<br>';
	function addUnits($bytes) {
		$units = array( 'B', 'KB', 'MB', 'GB', 'TB' );
		 
		for($i = 0; $bytes >= 1024 && $i < count($units) - 1; $i++ ) {
			$bytes /= 1024;
		}
		return round($bytes, 1).' '.$units[$i];
	}

	$dir=__DIR__."/img/evento";
	$directorio = opendir($dir); //ruta actual
	$c=0;
	$size=0;
	while ($archivo = readdir($directorio)) //obtenemos un archivo y luego otro sucesivamente
	{
	    if (!is_dir($archivo))
	    {
	        $size+=filesize($dir.'/'.$archivo);
	        $c++;
	    }
	    
	}
	echo $c .'<br>';
	echo addUnits($size) .'<br>';
	$limit=(50*1024)*1024;
	if($size>$limit){
		echo 'ha exedido el limite de almacenamiento';
	}
?>
