<!DOCTYPE html>
<html lang="en" dir="ltr">
   <head>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>
      <link rel="stylesheet" href="/php-charts/style.css">
      <meta charset="utf-8">
      <title></title>
   </head>
   <body>
      <!-- Es 1 -->
      <!-- <div class="chart_cnt">
         <canvas id="myChartLine" width="800" height="600"></canvas>
      </div> -->

      <!-- Es 2 -->
      <!-- <div class="chart_cnt">
         <canvas id="myChartLine2" width="800" height="600"></canvas>
      </div>
      <div class="chart_cnt">
         <canvas id="myChartPie" width="800" height="600"></canvas>
      </div> -->

      <!-- ES 3 -->
      <div class="chart_cnt">
         <canvas id="myChartLine" width="800" height="600"></canvas>
      </div>
      <div class="chart_cnt">
         <canvas id="myChartPie" width="800" height="600"></canvas>
      </div>
      <div class="chart_cnt">
         <canvas id="myChartLines" width="800" height="600"></canvas>
      </div>

      <script type="text/javascript">
         $(document).ready(function(){

            <?php include 'data.php'; ?>;

            /*
            // variabile per es 1
            var data = <?php /*echo json_encode($data); */?>;
            // grafico esercizio 1
            var ctx = document.getElementById('myChartLine').getContext('2d');
            var lineChart = new Chart(ctx, {
               type:'line',
               data: {
                  labels: ['Gennaio', 'Febbraio', 'Marzo', 'Aprile', 'Maggio', 'Giugno', 'Luglio', 'Agosto', 'Settembre', 'Ottobre', 'Novembre', 'Dicembre'],
                  datasets: [{
                     label: 'Andamento vendite Esercizio 1',
                     data: data,
                     backgroundColor: 'rgba(255, 0, 0, 0.2)',
                     borderColor: 'orange'
                  }]
               }
            });
            */


            // variabili per ex 2
            // var firstGraph = <?php/* echo json_encode($graphs['fatturato']); */?>;
            // // grafici esercizio 2
            // var ctx1 = document.getElementById('myChartLine2').getContext('2d');
            // var lineChart = new Chart(ctx1, {
            //    type: firstGraph.type,
            //    data: {
            //       labels: ['Gennaio', 'Febbraio', 'Marzo', 'Aprile', 'Maggio', 'Giugno', 'Luglio', 'Agosto', 'Settembre', 'Ottobre', 'Novembre', 'Dicembre'],
            //       datasets: [{
            //          label: 'Andamento vendite Esercizio 2',
            //          data: firstGraph.data,
            //          backgroundColor: 'rgba(255, 0, 0, 0.2)',
            //          borderColor: 'orange'
            //       }]
            //    }
            // });
            // var labels = [];
            // var values = [];
            // <?php/* foreach ($graphs['fatturato_by_agent']['data'] as $key => $value) { */?>
            //    labels.push(<?php /*echo json_encode($key); */ ?>);
            //    values.push(<?php /* echo json_encode($value); */ ?>);
            // <?php/* } */?>
            // var ctx2 = document.getElementById('myChartPie').getContext('2d');
            // var pieChart = new Chart(ctx2, {
            //    type: <?php /* echo json_encode($graphs['fatturato_by_agent']['type']); */?>,
            //    data: {
            //       labels: labels,
            //       datasets: [{
            //          data: values,
            //          backgroundColor: ['orange', 'blue', 'pink', 'yellow']
            //       }]
            //    }
            // })

            // ESERCIZIO 3
            var access = <?php echo json_encode($_GET["level"]); ?>;
            access = access.toLowerCase();
            // controllo se la parola è stata inserita correttamente
            if((access == 'guest') || (access == 'employee') || (access == 'clevel')){
               generateLineChart();
               generatePieChart();
               generateMultipleLineChart();
               <?php
                  // foreach ($graphs as $key => $value) {
                  //    if($key == 'access'){ ?>
                  //
                  //    }
                  <?php /* } */?>
            }
            else{
               alert('inserito livello di accesso errato');
            }
         });

         function generateLineChart(){
            var ctx = document.getElementById('myChartLine').getContext('2d');
            var lineChart = new Chart(ctx, {
               type: <?php echo json_encode($graphs['fatturato']['type']) ?>,
               data: {
                  labels: ['Gennaio', 'Febbraio', 'Marzo', 'Aprile', 'Maggio', 'Giugno', 'Luglio', 'Agosto', 'Settembre', 'Ottobre', 'Novembre', 'Dicembre'],
                  datasets: [{
                     label: 'Andamento vendite Esercizio 2',
                     data: <?php echo json_encode($graphs['fatturato']['data']) ?>,
                     backgroundColor: 'rgba(255, 0, 0, 0.2)',
                     borderColor: 'orange'
                  }]
               }
            });
         }
         function generatePieChart(){
            var labels = [];
            var values = [];
            <?php foreach ($graphs['fatturato_by_agent']['data'] as $key => $value) { ?>
               labels.push(<?php echo json_encode($key); ?>);
               values.push(<?php echo json_encode($value); ?>);
            <?php } ?>
            var ctx = document.getElementById('myChartPie').getContext('2d');
            var pieChart = new Chart(ctx, {
               type: <?php echo json_encode($graphs['fatturato_by_agent']['type']); ?>,
               data: {
                  labels: labels,
                  datasets: [{
                     data: values,
                     backgroundColor: ['orange', 'blue', 'pink', 'yellow']
                  }]
               }
            })
         }
         function generateMultipleLineChart(){
            var ctx = document.getElementById('myChartLines').getContext('2d');
            var lineChart = new Chart(ctx, {
               type: <?php echo json_encode($graphs['team_efficiency']['type']) ?>,
               data: {
                  labels: ['Gennaio', 'Febbraio', 'Marzo', 'Aprile', 'Maggio', 'Giugno', 'Luglio', 'Agosto', 'Settembre', 'Ottobre', 'Novembre', 'Dicembre'],
                  datasets: [{
                     label: 'Team1',
                     data: <?php echo json_encode($graphs['team_efficiency']['data']['Team1']) ?>,
                     borderColor: 'orange',
                     // fill: 'false'
                  },
                  {
                     label: 'Team2',
                     data: <?php echo json_encode($graphs['team_efficiency']['data']['Team2']) ?>,
                     borderColor: 'green',
                     // fill: 'false'
                  },
                  {
                     label: 'Team3',
                     data: <?php echo json_encode($graphs['team_efficiency']['data']['Team3']) ?>,
                     borderColor: 'red',
                     // fill: 'false'
                  }]
               }
            });
         }
      </script>
   </body>
</html>
