<?php include('includes/header.php'); ?>

<div class="container-fluid px-4" style="background-color: none;">
                        <h1 class="mt-4">DashBoard</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active"></li>
                        </ol>
                        <div class="row" style="display: flex; justify-content: space-around;">
                            .
                            <div class="col-xl-3 col-md-6" style="margin-left: -300px;">
                                <div class="card bg-primary text-white mb-4">
                                    <div class="card-body" style="text-align: center;">
                                        <p>Daily Customers</p>
                                        <h1><?php
                            $todayDate = date('Y-m-d');
                            $todayOrders = mysqli_query($conn, "SELECT * FROM orders WHERE order_date='$todayDate'");
                            if($todayOrders){
                                if(mysqli_num_rows($todayOrders) > 0){
                                    $totalCountOrders = mysqli_num_rows($todayOrders);
                                    echo $totalCountOrders;
                                }else{
                                    echo '0';
                                }
                            }else{
                                echo 'Something Went Wrong';
                            }
                            ?></h1>
                                    </div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-danger text-white mb-4">
                                    <div class="card-body" style="text-align: center;">
                                        <p>Out Of Stock Products</p>
                                        <h1> <?= getCountProd('products',10); ?></h1>
                                    </div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>   
                            
                        </div>
                        <br>
                        <h4 style="margin-left: 400px; margin-bottom: -50px;">Sales</h4>
                        <div class="row">
                            <div style="display: flex; justify-content: space-around;">
                                <!-- Chart 1: chart_div -->
                                <div id="chart_div" style="width: 100%; height: 400px;"></div>

                                <!-- Chart 2: piechart -->
                                <div id="piechart" style="width: 900px; height: 500px;"></div>

                            </div>
                        </div>

                        <div class="row">
                            <div style="display: flex; justify-content: space-around;">
                            <div id="vaccination_chart" style="width: 900px; height: 500px;"></div>

                            </div>
                        </div>

        
                       
                        <?php
$tid = $tid1 = $tid2 = "null";
$tqnty = $tqnty1 = $tqnty2 = 0;

$result = top1('order_items');
if ($result && $row = mysqli_fetch_assoc($result)) {
    $check = getProdName($row['product_id']);
    if($check){
        $prodRow = mysqli_fetch_array($check); // Changed $row to $prodRow
        $tid = $prodRow['product_code']; // Changed $row to $prodRow
    }
    $tqnty = $row['total_quantity'];
}

$result1 = top2('order_items');
if ($result1 && $row1 = mysqli_fetch_assoc($result1)) {
    $check = getProdName($row1['product_id']); // Changed $row to $row1
    if($check){
        $prodRow1 = mysqli_fetch_array($check); // Changed $row to $prodRow1
        $tid1 = $prodRow1['product_code']; // Changed $row to $prodRow1
    }
    $tqnty1 = $row1['total_quantity'];
}

$result2 = top3();
if ($result2 && $row2 = mysqli_fetch_assoc($result2)) {
    $check = getProdName($row2['product_id']); // Changed $row to $row2
    if($check){
        $prodRow2 = mysqli_fetch_array($check); // Changed $row to $prodRow2
        $tid2 = $prodRow2['product_code']; // Changed $row to $prodRow2
    }
    $tqnty2 = $row2['total_quantity'];
}
?>


                     
        <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Load the Visualization API and the corechart package.
            google.charts.load('current', {'packages':['corechart']});

            // Set a callback to run when the Google Visualization API is loaded.
            google.charts.setOnLoadCallback(drawCharts);

            function drawCharts() {
            var data1 = google.visualization.arrayToDataTable([
                ['Task', 'Count'], // Change the column label from 'Hours per Day' to 'Count'
                ['Yes', <?= getCount('purchase_orders', '', 1); ?>], // Specify the actual count for 'Yes' category
                ['No', <?= getCount('purchase_orders', '', 0) - getCount('purchase_orders', '', 1); ?>]   // Specify the actual count for 'No' category
            ]);

            var options1 = {
                title: 'Recieve Supplies',
                backgroundColor: 'transparent'
            };

            var chart1 = new google.visualization.PieChart(document.getElementById('piechart'));
            chart1.draw(data1, options1);

            // Draw Bar Chart for Number of Students per Course/Strand
            var num = 11;
            var data2 = google.visualization.arrayToDataTable([
                ['Course/Strand', 'Sales'],
                ['Total Sales', <?php
                    $orders = getAll('orders');
                    if($orders){
                    if(mysqli_num_rows($orders) > 0){
                    $salesTotal = 0;
                        foreach ($orders as $item){
                            if($item['order_date']){
                                $salesTotal = $item['total_amount'] + $salesTotal; 
                            }
                        }
                        echo $salesTotal;

                    }else{
                        echo '0';
                    }
                    }else{
                        echo '0';
                    }
                    ?>],
                ['Today', 
            
                <?php
                    $orders = getAll('orders');
                    if($orders){
                    if(mysqli_num_rows($orders) > 0){
                    $salesToday = 0;
                        foreach ($orders as $item){
                            if($todayDate == $item['order_date']){
                                $salesToday = $item['total_amount'] + $salesToday; 
                            }
                        }
                        echo $salesToday;

                    }else{
                        echo '0';
                    }
                    }else{
                        echo '0';
                    }
                    ?>
            
            ],
                ['Week', 
            
                <?php
        if ($orders) {
            if (mysqli_num_rows($orders) > 0) {
                // Calculate start and end dates for the current week
                $startOfWeek = date('Y-m-d', strtotime('last monday'));
                $endOfWeek = date('Y-m-d', strtotime('next sunday'));

                $salesWeek = 0;
                foreach ($orders as $item) {
                    $orderDate = date('Y-m-d', strtotime($item['order_date']));
                    // Check if the order date falls within the current week
                    if ($orderDate >= $startOfWeek && $orderDate <= $endOfWeek) {
                        $salesWeek += $item['total_amount'];
                    }
                }
                echo $salesWeek;
            } else {
                echo '0';
            }
        } else {
            echo '0';
        }
        ?>
            
            ],
                ['Month', <?php
                    if($orders){
                    if(mysqli_num_rows($orders) > 0){
                        $monthToday =date('m', strtotime(date('Y-m-d')));

                    $salesMonth = 0;
                        foreach ($orders as $item){
                            if($monthToday == date('m', strtotime($item['order_date']))){
                                $salesMonth = $item['total_amount'] + $salesMonth; 
                            }
                        }
                        echo $salesMonth;

                    }else{
                        echo '0';
                    }
                    }else{
                        echo '0';
                    }
                    ?>]
                // Add more data here as needed
            ]);

            var options2 = {
                title: '',
                chartArea: {width: '50%'},
                hAxis: {
                    title: 'In (₱ or Php)',
                    minValue: 0
                },
                vAxis: {
                    title: 'Sales'
                },
                backgroundColor: 'transparent'
            };

            var chart2 = new google.visualization.BarChart(document.getElementById('chart_div'));
            chart2.draw(data2, options2);


             // Draw Pie Chart for Vaccination Status of Students
        var vaccinationData = google.visualization.arrayToDataTable([
            ['Top Selling', 'Products'],
            ['<?= $tid; ?>', <?= $tqnty; ?>],
            ['<?= $tid1; ?>', <?= $tqnty1; ?>],
            ['<?= $tid2; ?>', <?= $tqnty2; ?>]
        ]);

        var vaccinationOptions = {
            title: 'Top Selling Products',
            // colors: ['#FFC107', '#198754']
            backgroundColor: 'transparent'
        };

        var vaccinationChart = new google.visualization.PieChart(document.getElementById('vaccination_chart'));
        vaccinationChart.draw(vaccinationData, vaccinationOptions);

    }
});
</script>
    <?php include('includes/footer.php'); ?>
