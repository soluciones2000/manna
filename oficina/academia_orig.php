<?php 
include_once("conexion.php");
include_once("funciones.php");
//$codigo = isset($_GET['c']) ? $_GET['c'] : $_SESSION["codigo"];
$codigo = isset($_GET['c']) ? $_GET['c'] : '';


$bdd = new PDO('mysql:host=localhost;dbname=manna;charset=utf8', 'root', 'rootmyapm');
$sql = "SELECT id, evento, inicio, fin, color FROM eventos";

$req = $bdd->prepare($sql);
$req->execute();
$events = $req->fetchAll();

?>
<!DOCTYPE html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/> 
<html>
<head> 
	<!-- fullcalendar -->
	<link href='css/fullcalendar.min.css' rel='stylesheet' />
	<link href='css/fullcalendar.print.min.css' rel='stylesheet' media='print' />
	<script src='js/moment.min.js'></script>
	<script src='js/jquery.min.js'></script>
	<script src='js/fullcalendar.min.js'></script>
	<script src='js/locale/es.js'></script>

	<script>
		var f = new Date();
		var mes;
		switch (f.getMonth() +1) {
			case 1:
				mes = '01';
				break;
			case 2:
				mes = '02';
				break;
			case 3:
				mes = '03';
				break;
			case 4:
				mes = '04';
				break;
			case 5:
				mes = '05';
				break;
			case 6:
				mes = '06';
				break;
			case 7:
				mes = '07';
				break;
			case 8:
				mes = '08';
				break;
			case 9:
				mes = '09';
				break;
			case 10:
				mes = '10';
				break;
			case 11:
				mes = '11';
				break;
			case 12:
				mes = '12';
				break;
		}
		var fecha = f.getFullYear() + "-" + mes + "-" + f.getDate();

		$(document).ready(function() {
			$('#calendar').fullCalendar({
				header: {
					left: 'prev,next today',
					center: 'title',
					right: 'month,agendaWeek,agendaDay,listWeek'
				},
				defaultDate: fecha,
				navLinks: true, // can click day/week names to navigate views
				editable: true,
				eventLimit: true, // allow "more" link when too many events
				events: [
					<?php
						foreach($events as $event): 
							$start = explode(" ", $event['inicio']);
							$end = explode(" ", $event['fin']);
							if ($start[1] == '00:00:00') { $start = $start[0]; } else { $start = $event['inicio'];	}
							if ($end[1] == '00:00:00') { $end = $end[0]; } else { $end = $event['fin']; }
							echo $event['evento'];
					?>
					{
						id: '<?php echo $event['id']; ?>',
						title: '<?php echo $event['evento']; ?>',
						start: '<?php echo $start; ?>',
						end: '<?php echo $end; ?>',
						color: '<?php echo $event['color']; ?>',
					},
					<?php endforeach; ?>
				]
		    });
		});

	</script>
	<style>
	#calendar {
		max-width: 800px;
	}

	.col-centered{
		float: none;
		margin: 0 auto;
	}

	.tab {
    	overflow: hidden;
	    border: 1px solid #ccc;
    	background-color: #f1f1f1;
	}

	.tabcontent {
	    display: none;
	    padding: 6px 12px;
	    border: 1px solid #ccc;
	    border-top: none;
	}

    </style>

</head>
<body>
	<!-- <h3>Bienvenido <b><?php echo $_SESSION["user"]; ?></b>,</h3> -->
	<div class="tab">
		<div width="50%" style="display:inline-block;">
			<a href="#" class="tablinks" onclick="opentab(event, 'calendario')" id="defaultOpen">Calendario</a>
		</div>
		<div width="50%" style="display:inline-block;">
			<a href="#" class="tablinks" onclick="opentab(event, 'descargas')" id="descargas">Descargas</a>
		</div>
	</div>
	<div id="calendario" class="tabcontent">
<!-- ******************************************************************************************************** -->
        <div class="row">
            <div class="col-lg-12 text-center">
                <div id="calendar" class="col-centered">
                </div>
            </div>
			
        </div>
        <!-- /.row -->
		
<!-- ******************************************************************************************************** -->
	</div>

	<div id="descargas" class="tabcontent">
		<h3>
			En construcción!
		</h3>
	</div>

	<!-- <script src="//code.jquery.com/jquery-1.12.4.js"></script> -->

	<script>
	function opentab(evt, opcion) {
		var i, tabcontent, tablinks;
		tabcontent = document.getElementsByClassName("tabcontent");
		for (i = 0; i < tabcontent.length; i++) {
			tabcontent[i].style.display = "none";
		}
		tablinks = document.getElementsByClassName("tablinks");
		for (i = 0; i < tablinks.length; i++) {
			tablinks[i].className = tablinks[i].className.replace(" active", "");
		}
		document.getElementById(opcion).style.display = "block";
		evt.currentTarget.className += " active";

		for (i = 0; i < tablinks.length; i++) {
			tablinks[i].className = tablinks[i].className.replace(" active", "");
		}
		evt.currentTarget.className += " active";
	}
	// Get the element with id="defaultOpen" and click on it
	document.getElementById("defaultOpen").click();

	function enabletab(opcion) {
		document.getElementById(opcion).disabled = false;
		document.getElementById(opcion).click();
	}

	</script>
</body>
</html>