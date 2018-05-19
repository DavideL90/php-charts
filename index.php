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
      <!-- <div class="chart_cnt">
         <canvas id="myChartLine" width="800" height="600"></canvas>
      </div>
      <div class="chart_cnt">
         <canvas id="myChartPie" width="800" height="600"></canvas>
      </div>
      <div class="chart_cnt">
         <canvas id="myChartLines" width="800" height="600"></canvas>
      </div> -->

      <script type="text/javascript">
         $(document).ready(function(){

            <?php include 'data.php'; ?>;

            // ESERCIZIO 1

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

            // ESERCIZIO 2

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

            //dichiaro un contatore per creare gli id canvas per più grafici dello stesso tipo
            cont = 1;
            //prendo la variabile dall'url
            var access = <?php echo json_encode($_GET["level"]); ?>;
            access = access.toLowerCase();
            // controllo se la parola è stata inserita correttamente
            if((access == 'guest') || (access == 'employee') || (access == 'clevel')){
               checkGraphsLevel(access);
            }
            else{
               alert('inserito livello di accesso errato');
            }
         });

         function checkGraphsLevel(entryWord){
            //ciclo l'array di grafici per stamparli in base alla parola inserita
            <?php foreach ($graphs as $graph) { ?>;
               //se la parola è guest stampo solo i grafici guest
               if(entryWord == 'guest'){
                  //per ogni array controllo la parola d'accesso, se corrisponde lo stampo
                  if(entryWord == <?php echo json_encode($graph['access']); ?>){
                     //salvo l'array
                     var arrayGraph = <?php echo json_encode($graph) ?>;
                     console.log(arrayGraph);
                     //salvo il tipo per controllare quale funzione chiamare
                     var graphType = <?php echo json_encode($graph['type']) ?>;
                     if(graphType == 'line'){
                        generateLineChart(arrayGraph);
                     }
                     else{
                        generatePieChart(graphName);

                     }
                     // incremento il contatore per i successivi id dei grafici
                     cont++
                  }
               }else if(entryWord == 'employee'){
                  //se la parola è employee stampo i grafici employee e guest
                  if((entryWord == <?php echo json_encode($graph['access']); ?>) || (<?php echo json_encode($graph['access']); ?> == 'guest')){
                     //salvo il nome del grafico cosi da non dover riciclare l'array
                     var graphName = <?php echo json_encode($key) ?>;
                     //salvo il tipo per controllare quale funzione chiamare
                     var graphType = <?php echo json_encode($graph['type']) ?>;

                     if(graphType == 'line'){
                        generateLineChart(graphName);
                     }
                     else{
                        generatePieChart(graphName);

                     }
                     // incremento il contatore per i successivi id dei graifici
                     cont++
                  }
               }
            <?php } ?>
         }

         function generateLineChart(arrGraph){
            //genero il contenitore per il grafico
            $('body').append('<div class="chart_cnt">' +
                             '<canvas id="myChartLine' + cont + '" width="800" height="600">' + '</canvas>');
            if(Array.isArray(arrGraph.data)){
               var ctx = $('#myChartLine' + cont);
               var lineChart = new Chart(ctx, {
                  type: 'line',
                  data: {
                     labels: ['Gennaio', 'Febbraio', 'Marzo', 'Aprile', 'Maggio', 'Giugno', 'Luglio', 'Agosto', 'Settembre', 'Ottobre', 'Novembre', 'Dicembre'],
                     datasets: [{
                        label: 'Andamento vendite',
                        data: arrGraph.data,
                        backgroundColor: 'rgba(255, 0, 0, 0.2)',
                        borderColor: 'orange'
                     }]
                  }
               });
            }
         }
         // function generatePieChart(){
         //    var labels = [];
         //    var values = [];
         //    <?php foreach ($graphs['fatturato_by_agent']['data'] as $key => $value) { ?>
         //       labels.push(<?php echo json_encode($key); ?>);
         //       values.push(<?php echo json_encode($value); ?>);
         //    <?php } ?>
         //    var ctx = document.getElementById('myChartPie').getContext('2d');
         //    var pieChart = new Chart(ctx, {
         //       type: <?php echo json_encode($graphs['fatturato_by_agent']['type']); ?>,
         //       data: {
         //          labels: labels,
         //          datasets: [{
         //             data: values,
         //             backgroundColor: ['orange', 'blue', 'pink', 'yellow']
         //          }]

         // function generateMultipleLineChart(){
         //    var ctx = document.getElementById('myChartLines').getContext('2d');
         //    var lineChart = new Chart(ctx, {
         //       type: <?php echo json_encode($graphs['team_efficiency']['type']) ?>,
         //       data: {
         //          labels: ['Gennaio', 'Febbraio', 'Marzo', 'Aprile', 'Maggio', 'Giugno', 'Luglio', 'Agosto', 'Settembre', 'Ottobre', 'Novembre', 'Dicembre'],
         //          datasets: [{
         //             label: 'Team1',
         //             data: <?php echo json_encode($graphs['team_efficiency']['data']['Team1']) ?>,
         //             borderColor: 'orange',
         //             // fill: 'false'
         //          },
         //          {
         //             label: 'Team2',
         //             data: <?php echo json_encode($graphs['team_efficiency']['data']['Team2']) ?>,
         //             borderColor: 'green',
         //             // fill: 'false'
         //          },
         //          {
         //             label: 'Team3',
         //             data: <?php echo json_encode($graphs['team_efficiency']['data']['Team3']) ?>,
         //             borderColor: 'red',
         //             // fill: 'false'
         //          }]
         //       }
         //    });
         // }
      </script>
   </body>
</html>
