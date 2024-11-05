<?php include('includes/header.php'); ?>


<div class="container-fluid px-4 main-cards">

  <div class="card mt-4 shadow-sm">
    <div class="card-header">
      <h4 class="mb-0">Create Purchase Order
        <a href="purchase-orders.php" class="btn btn-primary float-end">Back</a>
      </h4>
    </div>

    <div class="card-body">
      <?php alertMessage();
      alertCustom('');
      ?>

      <form action="purchase-orders-code.php" method="POST">

        <div class="row">
          <div class="col-md-3 mb-3">
            <label>Select Product *</label>
            <select name="product_id" class="form-select mySelect2">

              <option value="">-- Select Product --</option>

              <?php
              $products = getAll('products');
              if ($products) {

                if (mysqli_num_rows($products) > 0) {

                  foreach ($products as $prodItem) {
              ?>
                    <option value="<?= $prodItem['id']; ?>">
                      <?= $prodItem['product_code']; ?> - <?= $prodItem['name']; ?>
                      <?= $prodItem['type'] == '' ? '' : $prodItem['type']; ?>
                      <?= $prodItem['color'] == '' ? '' : $prodItem['color']; ?>
                      <?= $prodItem['type'] == '' ? '' : $prodItem['type']; ?>
                      <?= $prodItem['size'] == '' ? '' : $prodItem['size']; ?>
                      <?= $prodItem['numeric_size'] == '' ? '' : $prodItem['numeric_size']; ?>
                      <?= $prodItem['volume'] == '' ? '' : $prodItem['volume']; ?>
                      <?= $prodItem['grit_size'] == '' ? '' : $prodItem['grit_size']; ?>
                    </option>
              <?php

                  }
                } else {
                  echo '<option value="">No Product Found </option>';
                }
              } else {
                echo '<option value="">Something Went Wrong</option>';
              }
              ?>

            </select>
          </div>
          <!-- md to resize -->
          <div class="col-md-1 mb-3">
            <label>Quantity *</label>
            <input type="number" name="quantity" min="1" value="1" required class="form-control">
          </div>

          <div class="col-md-3 mb-3 text-end" style="padding-top: 20px;">
            <button type="submit" name="addOrder" class="btn btn-primary">Add Order</button>
          </div>
        </div>
      </form>
    </div>

  </div>

  <?php
  // print_r($_SESSION['Items']);
  // echo '<br>';
  // print_r($_SESSION['ItemIds']);
  // echo date('y-m-d');
  ?>

  <div class="card mt-3">
    <div class="card-header">
      <h4 class="mb-0">Products</h4>
    </div>
    <div class="card-body">
      <?php
      if (isset($_SESSION['Items']) && $_SESSION['Items'] != null && $_SESSION['ItemIds'] != null) {
        $sessionProducts = $_SESSION['Items'];
        if (empty($sessionProducts)) {
          unset($sessionProducts['Items']);
          unset($sessionProducts['ItemIds']);
       }

       $grandtotal = 0;
      ?>
        <div class="table-responsive mb-3">

          <table class="table table-bordered table-striped">
            <thead class="thead">
              <tr>
                <th>Product Code</th>
                <th>Product name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total Price</th>
                <th>Remove</th>
              </tr>
            </thead>
            <tbody class="tbod">
              <?php

              
              foreach ($sessionProducts as $key => $item) : ?>
                <tr>
                  <td><?= $item['product_code']; ?></td>
                  <td><?= $item['name']; ?></td>
                  <td><?= $item['price']; ?></td>
                  <td>
                    <div class="input-group qtyBox">
                      <input type="hidden" value="<?= $item['product_id']; ?>" class="prodId">

                      <input disabled type="text" value="<?= $item['quantity']; ?>" class="qty quantityInput" style=" width: 50px !important; padding: 6px 3px; text-align: center; border: 1px solid #cfb1b1; outline: 0; margin-right: 1px;">

                    </div>
                  </td>
                  <td>
                    <?= $total = number_format($item['price'] * $item['quantity'], 0); ?>
                    <?php $grandtotal = $grandtotal + $total;?>
                  </td>
                  <td>
                    <a href="purchase-order-item-delete.php?index=<?= $key; ?>" class="btn btn-danger">Remove</a>
                  </td>
                </tr>
              <?php endforeach; ?>

              <tr>
                  <td colspan="3"></td>
                  <td><b>Total</b></td>
                  <td><b><?= $grandtotal?></b></td>
              </tr>

            </tbody>
          </table>
        </div>
     

        <hr>
        <div class="mt-2">

          <form action="purchase-orders-code.php" method="POST">
            <div class="row">
              <div class="col-md-4">
                <label><b>Select Payment Mode</b></label>

                <select name="payment_mode" class="form-select" required>
                  <option disabled selected>-- Choose Payment --</option>
                  <option value="Cash Payment">Cash Payment</option>
                  <option value="Online Payment">Online Payment</option>
                </select>
              </div>

              <div class="col-md-4">

                <label><b>Select Supplier</b></label>

                <select name="supplier_id" class="form-select mySelect2" required>
                  <option disabled selected>-- Find Supplier --</option>
                  <?php
                  $supplier = getAll('suppliers');
                  if ($supplier) {
                    if (mysqli_num_rows($supplier) > 0) {
                      foreach ($supplier as $supplierItem) {
                  ?>
                        <option value="<?= $supplierItem['id']; ?>"><?= $supplierItem['name']; ?> : <?= $supplierItem['phone']; ?></option>
                  <?php
                      }
                    } else {
                      echo '<option value="">No Product Found </option>';
                    }
                  } else {
                    echo '<option value="">Something Went Wrong</option>';
                  }
                  ?>
                </select>
              </div>
              
              <input type="hidden" name="total_amount" value="<?= $grandtotal; ?>">

              <div class="col-md-4">
                <br />
                <button type="submit" class="btn btn-warning w-100" name="saveOrder"> Proceed to place order</button>
              </div>

          </form>
        </div>
 
    </div>
    <?php
      } else {
        echo '<h5>No Items added</h5>';
      }
      ?>
    </div>
  </div>
</div>


</div>

<?php include('includes/footer.php'); ?>