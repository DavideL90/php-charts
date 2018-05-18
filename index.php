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
      <div class="chart_cnt">
         <canvas id="myChartLine" width="800" height="600"></canvas>
      </div>

      <script type="text/javascript">
         $(document).ready(function(){
            <?php include 'data.php'; ?>
            var data = <?php echo json_encode($data); ?>;

            var ctx = document.getElementById('myChartLine').getContext('2d');
            var lineChart = new Chart(ctx, {
               type: 'line',
               data: {
                  labels: ['Gennaio', 'Febbraio', 'Marzo', 'Aprile', 'Maggio', 'Giugno', 'Luglio', 'Agosto', 'Settembre', 'Ottobre', 'Novembre', 'Dicembre'],
                  datasets: [{
                     label: 'Andamento vendite',
                     data: data,
                     backgroundColor: 'rgba(255, 0, 0, 0.2)',
                     borderColor: 'orange'
                  }]
               }
            })
         });
      </script>
   </body>
</html>
