<?php
$array = array();
$array2 = array();


array_push($array, array("Departamento","Servicios completos"));
array_push($array, array('Registo Inicial',0));
array_push($array, array('Asignacion visita inicial',2));
array_push($array, array('Registro visita inicial',1));
array_push($array, array('Auditoria visita inicial',5));
array_push($array, array('Registro de diseño',12));
array_push($array, array('Auditoria de diseño',1));
array_push($array, array('Presupuesto # 1',1));
array_push($array, array('Presupuesto # 2',1));
array_push($array, array('Aprobación de presupuesto',6));
array_push($array, array('Autorizacion de pagos',1));
array_push($array, array('Area financiera',1));
array_push($array, array('Inicio actividad',6));
array_push($array, array('Gestion de materiales',1));


array_push($array2, array("Departamento","Ordenes Dentro de Tiempo Estimado","Ordenes Fuera de Tiempo Estimado"));
array_push($array2, array('Registo Inicial',0,1));
array_push($array2, array('Asignacion visita inicial',2,1));
array_push($array2, array('Registro visita inicial',1,1));
array_push($array2, array('Auditoria visita inicial',5,1));
array_push($array2, array('Registro de diseño',12,1));
array_push($array2, array('Auditoria de diseño',1,1));
array_push($array2, array('Presupuesto # 1',1,1));
array_push($array2, array('Presupuesto # 2',1,1));
array_push($array2, array('Aprobación de presupuesto',6,1));
array_push($array2, array('Autorizacion de pagos',1,1));
array_push($array2, array('Area financiera',1,1));
array_push($array2, array('Inicio actividad',6,1));
array_push($array2, array('Gestion de materiales',1,1));

$array[1][1] = 20;
for ($i = 1; $i <= 13; $i++) { 
   $sql = "SELECT count(tbl_orders.id) cont,tbl_orders.dateSave,tbl_orders_state.days FROM tbl_orders JOIN tbl_orders_state
                                        ON tbl_orders.idOrderState = tbl_orders_state.id WHERE tbl_orders.idOrderState='$i' and
                                        DATEDIFF(CURDATE(), tbl_orders.dateSave) <= tbl_orders_state.days";
    $query = $this->db->query($sql)->row();
    $array[$i][1] = (int)$query->cont;
    
}

for ($i = 1; $i <= 13; $i++) { 
   $sql = "SELECT count(tbl_orders.id) cont,tbl_orders.dateSave,tbl_orders_state.days FROM tbl_orders JOIN tbl_orders_state
                                        ON tbl_orders.idOrderState = tbl_orders_state.id WHERE tbl_orders.idOrderState='$i' and
                                        DATEDIFF(CURDATE(), tbl_orders.dateSave) <= tbl_orders_state.days";
    $query = $this->db->query($sql)->row();
    
    $sql1 = "SELECT count(tbl_orders.id) cont,tbl_orders.dateSave,tbl_orders_state.days FROM tbl_orders JOIN tbl_orders_state
                                    ON tbl_orders.idOrderState = tbl_orders_state.id WHERE tbl_orders.idOrderState='$i' and
                                    DATEDIFF(CURDATE(), tbl_orders.dateSave) > tbl_orders_state.days";
                                        $query1 = $this->db->query($sql1)->row();
                                
    $array2[$i][1] = (int)$query->cont;
    $array2[$i][2] = (int)$query1->cont;   
}
?>
<script type="text/javascript">
      function drawStuff() {
        var data = new google.visualization.arrayToDataTable(<?php echo json_encode($array);?>);
        var options = {
          title: 'Indice de cumplimiento por area ',
          width: 900,
          height:500,
          legend: { position: 'none' },
          chart: { title: 'Indice de cumplimiento por area',
                   subtitle: 'Servicios completados por area' },
          bars: 'horizontal', // Required for Material Bar Charts.
          axes: {
            x: {
              0: { side: 'top', label: 'Cumplimiento'} // Top x-axis.
            }
          },
          bar: { groupWidth: "90%" }
        };

        var chart = new google.charts.Bar(document.getElementById('top_x_div'));
        chart.draw(data, options);
      };
      
      function asd(){
           // Define the chart to be drawn.
            var data = google.visualization.arrayToDataTable(<?php echo json_encode($array2);?>);

            var options = {
                title: 'Estado de los servicios',
                bars: 'horizontal',
                width: 900,
                 height:500,
                isStacked:true,
                series: {
                    0:{color:'#337ab7'},
                    1:{color:'#F48024'},
                },
                colors: ['#337ab7']
            };  

            // Instantiate and draw the chart.
            
          
          var chart = new google.charts.Bar(document.getElementById('top_y_div'));
        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>
<div class="content">
    <div id="top_x_div"></div>
    <br>
    <div id="top_y_div"></div>
</div>
<?php

?>

