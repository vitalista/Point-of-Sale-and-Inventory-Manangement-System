
<?php include('includes/header.php'); ?>

<div>


    <div class="row px-4 main-cards">
        <div class="col-md-12">

            <h1 class="mt-4">Dashboard</h1>
            <?php alertMessage(); ?>
        </div>
            
        <div class="col-md-3 mb-3">
                <div class="card card-body p-3">
                <table class="table">
            <tbody>
                <tr>
                    <td>
                        <p class="text-sm mb-0 text-capitalize fw-bold">Total Customers Orders</p>
                    </td>
                    <td>
                        <h5 class="fw-bold mb-0">
                            <?= getCount('orders', '', ''); ?>
                        </h5>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p class="text-sm mb-0 text-capitalize fw-bold">Orders Today</p>
                    </td>
                    <td>
                        <h5 class="fw-bold mb-0">
                            <?php
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
                            ?>
                        </h5>
                    </td>
                </tr>
            </tbody>
        </table>

                </div>
         </div>

            <div class="col-md-3 mb-3">
                <div class="card card-body p-3" style="text-align: center;">
                    <p class="text-sm mb-0 text-capitalize fw-bold">Out Of Stock Products</p>
                    <br>
                    <h5 class="fw-bold mb-0">
                    <?= getCountProd('products',10); ?>
                    </h5>
                    <br>
                </div>
            </div>

            <div class="col-md-3 mb-3">
                <div class="card card-body p-3" style="text-align: center;">
                    <p class="text-sm mb-0 text-capitalize fw-bold">Not Recieve Supplies</p>
                    <br>
                    <h5 class="fw-bold mb-0">
                    <?= getCount('purchase_orders', '', 0) - getCount('purchase_orders', '', 1); ?>
                     </h5>
                <br>
                </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card card-body p-3" style="text-align: center;">
                <p class="text-sm mb-0 text-capitalize fw-bold">Recieved Supplies</p>
                <br>
                <h5 class="fw-bold mb-0">
                <?= getCount('purchase_orders', '', 1); ?>
            </h5>
            <br>
            </div>
        </div>

        <div class="col-md-12 mb-3">
            <hr>
            <h5><b>Sales</b></h5>
            <?php 
            // echo $_SESSION['LoggedInUser']['can_create'];
            // echo $_SESSION['LoggedInUser']['can_edit'];
            // echo $_SESSION['LoggedInUser']['can_delete'];
            
            ?>
        </div>

        <div class="col-md-3 mb-3">
        <p class="text-sm mb-0 text-capitalize fw-bold">Total Sales</p>
                <h5 class="fw-bold mb-0">
                <?php
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
                    echo 'Something went wrong';
                }
                ?>
            </h5>
        </div>

        <div class="col-md-3 mb-3">
        <p class="text-sm mb-0 text-capitalize fw-bold">Sales Today</p>
                <h5 class="fw-bold mb-0">
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
                    echo 'No sales this Today';
                }
                }else{
                    echo 'Something went wrong';
                }
                ?>
            </h5>
        </div>

        <div class="col-md-3 mb-3">
        <p class="text-sm mb-0 text-capitalize fw-bold">Sales This Month</p>
                <h5 class="fw-bold mb-0">
                <?php
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
                    echo 'No sales this month';
                }
                }else{
                    echo 'Something went wrong';
                }
                ?>
            </h5>

        </div>

        <div class="col-md-3 mb-3">
    <p class="text-sm mb-0 text-capitalize fw-bold">Sales This Week</p>
    <h5 class="fw-bold mb-0">
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
            echo 'No sales this week';
        }
    } else {
        echo 'Something went wrong';
    }
    ?>
    </h5>
</div>


    </div>

</div>
<?php include('includes/footer.php'); ?>
