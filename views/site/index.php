<?php

use yii\console\widgets\Table;
/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>

<?php 
    /*echo Table::widget([
        'headers' => ['test1', 'test2', 'test3'],
        'rows' => [
            ['col1', 'col2', 'col3'],
            ['col1', 'col2', ['col3-0', 'col3-1', 'col3-2']],
        ],
    ]);*/
    /*$table= new Table;
    $table->setHeaders(['test1', 'test2', 'test3'])
    ->setRows([
        ['col1', 'col2', 'col3'],
        ['col1', 'col2', ['col3-0', 'col3-1', 'col3-2']],
    ]);
    echo $table->run();*/

 ?>
<!--
<div class="site-index">

    <div class="jumbotron">
        <h1>Congratulations!</h1>

        <p class="lead">You have successfully created your Yii-powered application.</p>

        <p><a class="btn btn-lg btn-success" href="http://www.yiiframework.com">Get started with Yii</a></p>
    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-4">
                <h2>Heading</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-default" href="http://www.yiiframework.com/doc/">Yii Documentation &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Heading</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-default" href="http://www.yiiframework.com/forum/">Yii Forum &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Heading</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-default" href="http://www.yiiframework.com/extensions/">Yii Extensions &raquo;</a></p>
            </div>
        </div>

    </div>
</div>
-->
<?php
# definimos los valores iniciales para nuestro calendario
$month=date("n");
$year=date("Y");
$diaActual=date("j");
 
# Obtenemos el dia de la semana del primer dia
# Devuelve 0 para domingo, 6 para sabado
$diaSemana=date("w",mktime(0,0,0,$month,1,$year))+7;
//if ($diaSemana>7) {
//    $diaSemana+=7;
//}
# Obtenemos el ultimo dia del mes
$ultimoDiaMes=date("d",(mktime(0,0,0,$month+1,1,$year)-1));
 echo $diaSemana.'<br>';
 echo $ultimoDiaMes.'<br>';
$meses=array(1=>"Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio",
"Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
?>
 
<!DOCTYPE html>
<html lang="es">
<head>
    <!--http://www.lawebdelprogramador.com-->
    <title>Ejemplo de un simple calendario en PHP</title>
    <meta charset="utf-8">
    <style>
        #calendar {
            font-family:Arial;
            font-size:12px;
        }
        #calendar caption {
            text-align:left;
            padding:5px 10px;
            background-color:#003366;
            color:#fff;
            font-weight:bold;
        }
        #calendar th {
            background-color:#006699;
            color:#fff;
            width:40px;
        }
        #calendar td {
            text-align:right;
            padding:2px 5px;
            background-color:silver;
        }
        #calendar .hoy {
            background-color:red;
        }
    </style>
</head>
 
<body>
<h1>Ejemplo de un simple calendario en PHP</h1>
<table id="calendar">
    <caption><?php echo $meses[$month]." ".$year?></caption>
    <tr>
        <th>Lun</th><th>Mar</th><th>Mie</th><th>Jue</th>
        <th>Vie</th><th>Sab</th><th>Dom</th>
    </tr>
    <tr bgcolor="silver">
        <?php
        $last_cell=$diaSemana+$ultimoDiaMes;
        echo $last_cell.'<br>';
        // hacemos un bucle hasta 42, que es el máximo de valores que puede
        // haber... 6 columnas de 7 dias
        //$day=1;
        for($i=1;$i<=42;$i++)
        {
            if($i==$diaSemana)
            {
                // determinamos en que dia empieza
                $day=1;
            }
            if($i<$diaSemana || $i>=$last_cell)
            {
                // celca vacia
                echo "<td>&nbsp;</td>";
            }else{
                // mostramos el dia
                if($day==$diaActual)
                    echo "<td class='hoy'>$day</td>";
                else
                    echo "<td>$day</td>";
                $day++;
            }
            // cuando llega al final de la semana, iniciamos una columna nueva
            if($i%7==0)
            {
                echo "</tr><tr>\n";
            }
        }
    ?>
    </tr>
</table>
</body>
</html>