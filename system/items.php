<?php include('includes/header.php'); ?>



<div class="container-fluid px-4 main-cards">

  <div class="card mt-4 shadow-sm">
    <div class="card-header">

      <div class="row">
        <div class="col-md-1">
          <h4 class="mb-0"></h4>
        </div>
        <div class="col-md-8">
          <form action="" method="GET">

            <div class="row g-1">

              <div class="col-md-2">
                <input type="date" name="date" class="form-control" value="<?= isset($_GET['date']) == true ? $_GET['date'] : ''; ?>">
              </div>

              <div class="col-md-3">
                <input type="week" name="week" class="form-control" value="<?= isset($_GET['week']) == true ? $_GET['week'] : ''; ?>">

              </div>

              <div class="col-md-2">
                <select id="yearPicker" name="year" class="form-select"></select>
                <script>
                  var select = document.getElementById("yearPicker");
                  var currentYear = new Date().getFullYear();

                  for (var i = currentYear + 5; i >= currentYear - 10; i--) {
                    var option = document.createElement("option");
                    option.text = i;
                    option.value = i;
                    if (i === currentYear) {
                      option.selected = true;
                    }
                    select.appendChild(option);
                  }
                </script>
              </div>

              <div class="col-md-4">
                <button type="submit" class="btn btn-primary">Filter</button>
                <a href="items.php" class="btn btn-danger">Reset</a>
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
  Between
</button>
              </div>

              <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Date Between</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Form Fields -->
        <div class="mb-3">
          <label for="field1" class="form-label">Start Date</label>
          <input type="date" name="start" class="form-control" id="field1">
        </div>
        <div class="mb-3">
          <label for="field2" class="form-label">End Date</label>
          <input type="date" name="end" class="form-control" id="field2">
        </div>
      </div>
      <div class="modal-footer">
        <!-- Close Button -->
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <!-- Save Button -->
        <button type="submit" class="btn btn-primary">Save</button>
      </div>
    </div>
  </div>
</div>

            </div>
          </form>

        </div>

        <div class="col-md-2">
          <button class="btn btn-warning" onclick="toggleDiv(); printMyBillingArea()">Print</button>
          <button class="btn btn-danger" onclick="toggleDiv(); downloadPDF('sold_items')">PDF</button>
        </div>

      </div>

    </div>

    <div class="card-body">
      <?php

      $select = "";

      if (isset($_GET['week']) && $_GET['week'] !== '') {
        $week = validate($_GET['week']);
        $select = $week;
        $week = date('Y-m-d', strtotime($week));

        $date = $week;
        $year = date("Y", strtotime($date));

        $sql = "SELECT * FROM order_items WHERE WEEK(item_date) = WEEK('$week') AND YEAR(item_date) = '$year'";
      } else if (isset($_GET['date']) && $_GET['date'] !== '') {
        $date = validate($_GET['date']);
        $sql = "SELECT * FROM order_items WHERE DATE(item_date) = '$date'";
        $select = $date;
      } else if (isset($_GET['start']) && isset($_GET['end']) && $_GET['start'] !== '' && $_GET['end'] !== ''){
        $start = validate($_GET['start']);
        $end = validate($_GET['end']);
        $sql = "SELECT * FROM order_items WHERE item_date BETWEEN '$start' AND '$end';";
      } else if (isset($_GET['year']) && $_GET['year'] !== '') {
        $year = validate($_GET['year']);
        $sql = "SELECT * FROM order_items WHERE YEAR(item_date) = '$year'";
        $select = $year;
      }
      else {
        $sql = "SELECT * FROM order_items";
      }


      

      ?>

      <div id="myBillingArea">
      <div style="display: none;" id="myDiv">
        <table style="width: 100%; margin-bottom: 20px;">
          <tbody>
            
            <tr>

            <td style="text-align: center;" colspan="2">
              <h4 style="font-size: 23px; line-height: 30px; margin:2px; padding: 0;">M&J Paint Enterprises</h4>
              <p style="font-size: 16px; line-height: 24px; margin: 2px; padding: 0;">306 A. Mabini St, Tibag</p>
              <p style="font-size: 16px; line-height: 24px; margin: 2px; padding: 0;">Baliwag Bulacan</p>
            </td>

            </tr>
           
            

            <tr>
              <td align="start">
                <p><?= $select; ?></p>
              </td>
            </tr>

          </tbody>
          
        </table>

        </div>
        <div class="table-responsive">

          <?php

$items = mysqli_query($conn, $sql);

          if ($items) {
            if (mysqli_num_rows($items) > 0) {

          ?>



              <table class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th align="start" style="border-bottom: 1px solid #ccc; font-weight: bold;" width="10%">Product Code</th>
                    <th align="start" style="border-bottom: 1px solid #ccc; font-weight: bold;" width="15%">Quantity</th>
                    <th align="start" style="border-bottom: 1px solid #ccc; font-weight: bold;" width="15%">Price</th>
                    <th align="start" style="border-bottom: 1px solid #ccc; font-weight: bold;" width="15%">Total</th>
                    <th align="start" style="border-bottom: 1px solid #ccc; font-weight: bold;" width="10%">Date</th>
                  </tr>
                </thead>
                <tbody>

                  <?php $total = 0;
                  foreach ($items as $item) : $total = ($item['price'] * $item['quantity']) + $total; ?>
                    <tr>
                      <td align="start" style="border-bottom: 1px solid #ccc;"><?= getProdCode('products', $item['product_id']) ?></td>
                      <td align="start" style="border-bottom: 1px solid #ccc;"><?= $item['quantity'] ?></td>
                      <td align="start" style="border-bottom: 1px solid #ccc;"><?= $item['price'] ?></td>
                      <td align="start" style="border-bottom: 1px solid #ccc;"><?= $item['price'] * $item['quantity'] ?></td>
                      <td align="start" style="border-bottom: 1px solid #ccc;"><?= $item['item_date'] ?></td>
                    </tr>
                  <?php endforeach; ?>
                  <tr>
                    <td colspan="2"></td>
                    <td align="center "><strong>Total amount</strong></td>
                    <td style="border-bottom: 1px solid #ccc;"> <strong><?= $total; ?></strong></td>
                    <td></td>
                  </tr>
                </tbody>
              </table>

              <table class="table table-striped table-bordered">
                <tbody>
                  <tr>

                  </tr>
                </tbody>
              </table>

          <?php
            } else {

              echo '<h5>No item Found</h5>';
            }
          } else {
            echo '<h5>Something Went Wrong</h5>';
          }
          ?>


        </div>
      </div>

    </div>
  </div>
</div>

<script>
function toggleDiv() {
  var div = document.getElementById("myDiv");
  if (div.style.display === "none") {
    div.style.display = "block";
    setInterval(function() {
      window.location.reload();
    }, 3000);
  } else {
    div.style.display = "none";
  }
}
</script>

<?php include('includes/footer.php'); ?>