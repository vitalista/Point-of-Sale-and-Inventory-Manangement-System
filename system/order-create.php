<?php include('includes/header.php'); ?>

<!-- Modal -->
<div class="modal fade" id="addCustomerModal" data-bs-backdrop="static" data-bs-keyboard="false"  tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Add Customer</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
     
       <div class="mb-3">
       <label>Enter Customer Name</label>
      <input type="text" class="form-control" id="c_name">
       </div>

       <div class="mb-3">
       <label>Enter Customer Phone No.</label>
      <input type="text" class="form-control" id="c_phone">
       </div>

       <div class="mb-3">
       <label>Address (optional)</label>
      <input type="text" class="form-control" id="c_email">
       </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary saveCustomer">Save</button>
      </div>
    </div>
  </div>
</div>
<!-- modal -->

<div class="container-fluid px-4 main-cards">

  <div class="card mt-4 shadow-sm">
    <div class="card-header">
      <h4 class="mb-0">Create Order
        <a href="orders.php" class="btn btn-primary float-end">Back</a>
      </h4>
    </div>

    <div class="card-body">
      <?php alertMessage(); ?>

      <form action="orders-code.php" method="POST">

        <div class="row">
          <div class="col-md-3 mb-3">
            <label>Select Product *</label>
            <select name="product_id" class="form-select mySelect2">

              <option value="" disabled selected>-- Select Product --</option>

              <?php
              $products = getAll('products');
              if ($products) {

                if (mysqli_num_rows($products) > 0) {

                  foreach ($products as $prodItem) {
              ?>
                    <option value="<?= $prodItem['id']; ?>">
                      <?=$prodItem['product_code'];?> - <?= $prodItem['name'];?>
                      <?= $prodItem['type'] == ''? '':$prodItem['type'];?>
                      <?= $prodItem['color'] == ''? '':$prodItem['color'];?> 
                      <?= $prodItem['type'] == ''? '':$prodItem['type'];?>
                      <?= $prodItem['size'] == ''? '':$prodItem['size'];?>
                      <?= $prodItem['numeric_size'] == ''? '':$prodItem['numeric_size'];?>
                      <?= $prodItem['volume'] == ''? '':$prodItem['volume'];?>
                      <?= $prodItem['grit_size'] == ''? '':$prodItem['grit_size'];?>
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
            <label for="quantity">Quantity *</label>
            <input type="number" name="quantity" min="1" value="1" class="form-control">
          </div>
          
          <div class="col-md-3 mb-3 text-end" style="padding-top: 20px;">
            <button type="submit" name="addItem" class="btn btn-primary">Add Item</button>
          </div>
        </div>
      </form>

    </div>

  </div>

  <?php
  // print_r($_SESSION['productItems']);
  // print_r($_SESSION['productItemIds']);
  ?>

  <div class="card mt-3">
    <div class="card-header">
      <h4 class="mb-0">Products</h4>
    </div>
    <div class="card-body" id="productArea">
      <?php
      if (isset($_SESSION['productItems']) && $_SESSION['productItems'] != null && $_SESSION['productItemIds'] != null){
        $sessionProducts = $_SESSION['productItems'];
        if (empty($sessionProducts)) {
          unset($sessionProducts['productItems']);
          unset($sessionProducts['productItemIds']);
        }
      ?>
        <div class="table-responsive mb-3" id="productContent">
          <!-- this notif not work id="productArea" id=" productContent" -->
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

              $grandtotal = 0;
              foreach ($sessionProducts as $key => $item) : ?>
                <tr>
                  <td><?= $item['product_code'] ?></td>
                  <td><?= $item['name']; ?></td>
                  <td><?= $item['price']; ?></td>
                  <td>
                    <div class="input-group qtyBox">
                      <input type="hidden" value="<?= $item['product_id']; ?>" class="prodId">

                      <button class="input-group-text decrement">-</button>
                      <input type="text" disabled value="<?= $item['quantity']; ?>" class="qty quantityInput" style=" width: 50px !important; padding: 6px 3px; text-align: center; border: 1px solid #cfb1b1; outline: 0; margin-right: 1px;">
                      <button class="input-group-text increment">+</button>

                    </div>
                  </td>
                  <td>
                    <?= $total = sprintf($item['price'] * $item['quantity'], 0); ?>
                    <?php $grandtotal = $grandtotal + $total;?>
                  </td>
                  <td>
                    <a href="order-item-delete.php?index=<?= $key; ?>" class="btn btn-danger">Remove</a>
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

        <!-- // -->
        <div class="mt-2">
          <hr>
          <div class="row">
            
            <div class="col-md-2">
              <label>Select Payment Mode</label>
              <select id="payment_mode" class="form-select">
                <option value="" selected disabled>-- Select Payment --</option>
                <option value="Cash Payment">Cash Payment</option>
                <option value="Online Payment">Online Payment</option>
              </select>
            </div>

            <!-- <div class="col-md-4">
              <label>Enter Customer Phone Number</label>
              <input type="number" id="cphone" class="form-control" value="" />
            </div> -->

            <div class="col-md-2 text-end">
            <button type="button" id="showModalBtn" class="btn btn-primary" style="margin-top: 24px;">
              Add Customer
            </button>
            </div>

              <div class="col-md-4">

                <label><b>Select Customer</b></label>

                <select name="supplier_id" class="form-select mySelect2" id="cphone">
                  <option disabled selected>-- Find Customer --</option>
                  <?php
                  $supplier = greeedy('customers');
                  if ($supplier) {
                    if (mysqli_num_rows($supplier) > 0) {
                      foreach ($supplier as $supplierItem) {
                  ?>
                        <option value="<?= $supplierItem['phone']; ?>"><?= $supplierItem['name']; ?> : <?= $supplierItem['phone']; ?></option>
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

            <div class="col-md-4">
              <br />

              <button type="button" class="btn btn-warning w-100 proceedToPlace" > Proceed to place order</button>
            </div>

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
<?php include('includes/footer.php'); ?>