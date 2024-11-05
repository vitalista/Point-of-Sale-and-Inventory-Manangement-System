<?php include('includes/header.php'); ?>

<div class="container-fluid px-4 main-cards">
  <?php alertMessage(); ?>
    <div class="card mt-4 shadow-sm">
      <div class="card-header">
        <div class="row">
          <div class="col-md-4">
            <h4 class="mb-0">Purchase Orders</h4>
          </div>
          <div class="col-md-8">
            <form action="" method="GET">

            <div class="row g-1">
              <div class="col-md-4">
                <input type="date" 
                name="date" 
                class="form-control"
                value="<?= isset($_GET['date']) == true ? $_GET['date']: ''; ?>">

              </div>
              <div class="col-md-4">
                <select name="payment_mode" class="form-select">
                <option value="">Select Payment Type</option>
                  <option value="Cash Payment"
                  
                  <?= isset($_GET['payment_mode']) == true ?
                  ($_GET['payment_mode'] == 'Cash Payment' ? 'selected' : ''):'';
                  ?>

                  >Cash Payment</option>
                  <option value="Online Payment"
                  
                  <?= isset($_GET['payment_mode']) == true ?
                  ($_GET['payment_mode'] == 'Online Payment' ? 'selected' : ''):'';
                  ?>
                  
                  >Online Payment</option>

                </select>
              </div>
              <div class="col-md-4">
                <button type="submit" class="btn btn-primary">Filter</button>
                <a href="orders.php" class="btn btn-danger">Reset</a>
              </div>

            </div>
            </form>

          </div>
        </div>
      </div>
      <div class="card-body">

        <?php

      if(isset($_GET['date']) || isset($_GET['payment_mode'])){

        $orderDate = validate($_GET['date']);
        $paymentmode = validate($_GET['payment_mode']);

        if($orderDate != '' && $paymentmode == ''){

          $query = "SELECT o.id as purchase_orders_id, o.*, c.* FROM purchase_orders o, suppliers c WHERE c.id =o.supplier_id AND o.purchase_order_date='$orderDate' ORDER BY o.id DESC";

        }elseif($orderDate == '' && $paymentmode != ''){

          $query = "SELECT o.id as purchase_orders_id, o.*, c.* FROM purchase_orders o, suppliers c WHERE c.id =o.supplier_id AND o.payment_mode='$paymentmode' ORDER BY o.id DESC";

        }elseif($orderDate != '' && $paymentmode != ''){

          $query = "SELECT o.id as purchase_orders_id, o.*, c.* FROM purchase_orders o, suppliers c WHERE c.id =o.supplier_id AND o.purchase_order_date='$orderDate' AND o.payment_mode='$paymentmode' ORDER BY o.id DESC";


        }else{
        $query = "SELECT o.id as purchase_orders_id, o.*, c.* FROM purchase_orders o, suppliers c WHERE c.id =o.supplier_id ORDER BY o.id DESC";

        }


      }else{
        $query = "SELECT po.id as purchase_orders_id, po.*, s.* FROM purchase_orders po, suppliers s WHERE s.id =po.supplier_id ORDER BY po.id DESC";


      }
      $orders = mysqli_query($conn, $query);

      if ($orders) {

        if (mysqli_num_rows($orders) > 0) {

      ?>
          <table class="table table-striped table-bordered align-items-center justify-content-center">

            <thead>
              <tr>

                <!-- <th>Id</th> -->
                <!-- <th>Tracking No.</th> -->
                <th>S Name</th>
                <th>S Phone</th>
                <th>Order Date</th>
                <th>Order Status</th>
                <th>Total Amount</th>
                <th>Delivery Confirmation</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($orders as $orderItem) : ?>
                <tr>

                <!-- <td><?= $orderItem['purchase_orders_id']; ?></td> -->

                  <!-- <td class="fw-bold"><?= $orderItem['tracking_no']; ?></td> -->
                  <td><?= $orderItem['name']; ?></td>
                  <td><?= $orderItem['phone']; ?></td>
                  <td><?= date('d M, Y', strtotime($orderItem['purchase_order_date'])); ?></td>
                  <td><?= $orderItem['confirmation'] > 0 ? 'arrived':'pending'; ?></td>
                  <td><?= $orderItem['total_amount']; ?></td>

  <!-- > >>> means confrim -->

                  <td><a href="purchase-orders-confirmation.php?id=<?= $orderItem['purchase_orders_id']; ?>" class="btn" style="color: white; background-color: <?= $orderItem['confirmation'] > 0 ? '#5C636A':'#F74527'; ?>;">
                  <?= $orderItem['confirmation'] > 0 ? 'Recieved':'Receive'; ?></a></td>

                  
                  <td>
                    <a href="purchase-orders-view.php?track=<?= $orderItem['tracking_no']; ?>" class="btn btn-success mb-0 px-2 btn-sm">View</a>
                    <!-- not working -->
                    <a href="purchase-orders-delete.php?id=<?= $orderItem['purchase_orders_id']; ?>" 
                    class="btn btn-danger mb-0 px-2 btn-sm"
                    onclick="return confirm('Deleting this may effect on DashBoard. Do you want to continue?');">delete</a>
                  </td>

                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
      <?php

        } else {
          echo "<h5>No Record Available</h5>";
        }
      } else {

        echo "<h5>Something Went Wrong</h5>";
      }



      ?>

    </div>
  </div>
</div>

<?php include('includes/footer.php'); ?>