
	<!-- CSS Files -->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/material-kit.css" rel="stylesheet"/>
	
	

	<!-- CSS -->
	<link href="assets/css/allneat.css" rel="stylesheet" />

<?php 
include_once("conexion.php");
include_once("funciones.php");
//$codigo = isset($_GET['c']) ? $_GET['c'] : $_SESSION["codigo"];
$codigo = isset($_GET['c']) ? $_GET['c'] : '';
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset='utf-8' />
    <script type="text/javascript" src="js/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="js/jquery.e-calendar.js"></script>
    <!-- <script type="text/javascript" src="index.js"></script> -->
    <link rel="stylesheet" href="css/jquery.e-calendar.css"/>

    <style>
      .tab {
        overflow: hidden;
        border: 1px solid #ccc;
        background-color: #f1f1f1;
      }

      /* Style the buttons inside the tab */
      .tab button {
        background-color: inherit;
        float: left;
        border: none;
        outline: none;
        cursor: pointer;
        padding: 14px 16px;
        transition: 0.3s;
        font-size: 17px;
      }

      /* Change background color of buttons on hover */
      .tab button:hover {
        background-color: #ccc;
      }

      /* Create an active/current tablink class */
      .tab button.active {
        /*background-color: #ccc;*/
        background-color: #999;
      }

      /* Style the tab content */
      .tabcontent {
/*        display: none;*/
        padding: 6px 12px;
        border: 1px solid #ccc;
        border-top: none;
      }
    </style>
  </head>
  <body>
    <div class="tab">
      <button class="tablinks" onClick="opentab(event, 'almanaque')" id="defaultOpen">Calendario de eventos</button>
      <button class="tablinks" onClick="opentab(event, 'material')" id="descargas">Material para descargar</button>
    </div>

    <div id="almanaque" class="tabcontent">
      <div id='calendar' style="align-content: center;"></div>
      <script>
        //With links on the description
        $('#calendar').eCalendar({
          months: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio','Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
          textArrows: {previous: 'Ant.', next: 'Sig.'},
          eventTitle: 'Detalle de los Eventos',
          weekDays: ['Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab'],
          firstDayOfWeek: 0,
          events: [
          <?php
            $query = "select * from eventos order by inicio";
            $result = mysql_query($query,$link);
            $filas = mysql_num_rows($result);
            $linea = 0;
            while($row = mysql_fetch_array($result)) {
              $linea++;
              ?>
              {
                title: '<?php echo $row["evento"]; ?>', 
                description: '<?php echo $row["descripcion"]; ?>', 
                datetime: new Date(<?php echo substr($row["inicio"],0,4); ?>, <?php echo strval(substr($row["inicio"],5,2))-1; ?>, <?php echo substr($row["inicio"],8,2); ?>, <?php echo substr($row["inicio"],11,2); ?>) 
              }
              <?php
              if ($linea<$filas) { echo ","; }
            }
          ?>
          ]
        });
      </script>
    </div>

    <div id="material" class="tabcontent">
      <?php
        $query = "select * from material order by nombre";
        $result = mysql_query($query,$link);
        echo '<ul>';
        while($row = mysql_fetch_array($result)) {
          if ($row["activo"]) {
            echo '<li><a href="material/'.$row["archivo"].'" target="_blank" title="'.$row["descripcion"].'">'.$row["nombre"].'</a></li><br>';
          }
        }
        echo '</ul>';
      ?>
<!--       <p id="lista">Prueba</p>
      <script>
//        alert(document.getElementById('descargas').style.display);
      </script>
 -->
    </div>

    <script src="//code.jquery.com/jquery-1.12.4.js"></script>
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
      }

      // Get the element with id="defaultOpen" and click on it
      document.getElementById("defaultOpen").click();

    </script>
  </body>
</html>

<!-- /*            {title: 'Event Title 1', description: 'Description 1', datetime: new Date(2018, 0, 12, 17)},
            {title: 'Event Title 2', description: 'Description 2', datetime: new Date(2018, 0, 23, 16)},
            {
              title: 'Event Title 1', 
              description: 'Description 1. Without link', 
              datetime: new Date(2018, 0, 20, 17) 
            },
            {
              title: 'Event Title 2', 
              description: 'Description 2. Only with link opening in the same tab', 
              datetime: new Date(2018, 0, 24, 16), 
              url: "https://www.google.com"
            },
            {
              title: 'Event Title 2', 
              description: 'Description 3. With link opening on new tab', 
              datetime: new Date(2018, 0, 25, 16), 
              url: "https://www.google.com", 
              url_blank: true
            },
            {
              title: 'Event Title 2', 
              description: 'Description 4. Only with link opening in the same tab', 
              datetime: new Date(2018, 8, 26, 16), 
              url: "https://www.google.com", 
              url_blank: false
            }*/
 -->