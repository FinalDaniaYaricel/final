<?php

	include 'template.php';
	include '../connection.php';

	if(isset($_SESSION['facebook_access_token'])){
		
		$query = "SELECT COUNT(`id`)'count', DATE_FORMAT(`date`, '%Y,%m,%d')'date' FROM `user` GROUP BY DATE_FORMAT(`date`, '%Y%m%d')";
		$result = $mysqli->query($query);
		while($result1 = $result->fetch_array(MYSQLI_ASSOC)){
			$user_count[] = $result1["count"];
			$user_date[] = $result1["date"];
		}
		$query = "SELECT COUNT(`id`)'count', DATE_FORMAT(`date`, '%Y,%m,%d')'date' FROM `anuncio` GROUP BY DATE_FORMAT(`date`, '%Y%m%d')";
		$result = $mysqli->query($query);
		while($result1 = $result->fetch_array(MYSQLI_ASSOC)){
			$advert_count[] = $result1["count"];
			$advert_date[] = $result1["date"];
		}
		//$mysqli->close();
	}
?>

<style>
#container {
	margin: 0 auto
}
</style>

<div id="container"></div>

<script>

Highcharts.chart('container', {
    chart: {
        type: 'spline'
    },
    title: {
        text: 'Estadisticas'
    },
    xAxis: {
        type: 'datetime',
        dateTimeLabelFormats: { // don't display the dummy year
            month: '%e %B %Y',
        },
        title: {
            text: 'Fecha'
        }
    },
    yAxis: {
        title: {
            text: 'Cantidad (C)'
        },
        min: 0
    },
    tooltip: {
        headerFormat: '<b>{series.name}: C: {point.y:f}</b><br>',
        pointFormat: '{point.x:%e de %b del %Y}'
    },

    plotOptions: {
        spline: {
            marker: {
                enabled: true
            }
        }
    },

    series: [{
        name: 'Usuarios',
        data: [
					<?php
					if(isset($user_count))
            foreach($user_count as $key => $count){ ?>
            	[Date.UTC(<?php echo $user_date[$key]; ?>), <?php echo $count; ?>],
					<?php } ?>
        ]
    },{
        name: 'Anuncios',
        data: [
					<?php
					if(isset($advert_count))
            foreach($advert_count as $key => $count){ ?>
            	[Date.UTC(<?php echo $advert_date[$key]; ?>), <?php echo $count; ?>],
					<?php } ?>
        ]
    }]
});

</script>