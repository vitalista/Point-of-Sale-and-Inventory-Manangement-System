<?php include('includes/header.php'); ?>

<div class="container-fluid px-4 main-cards">
  <div class="card mt-4 shadow-sm">
    <div class="card-header">
      <h4 class="mb-0">Products
        <!-- <?php echo $_SESSION['LoggedInUser']['can_delete'];?> -->
      <?php if($_SESSION['LoggedInUser']['can_create'] == 1):?>
        <a href="products-create.php" class="btn btn-primary float-end">Add Product</a>
       <?php else:?>
      <?php endif;?>
      <label class="float-end"style="margin-top: 3px;  margin-right: 150px;">Hide</label>
      <input type="checkbox" id="showCheckbox" class=" float-end" style="width:30px;height:30px; margin-right: 10px; margin-top: 3px;">
      </h4>
      <?php alertMessage(); ?>
    </div>

    <div class="card-body" id="myTable" style="display: none;">
      

      <div class="table-responsive">
        <table class="table table-striped table-bordered">
          <thead>
            <tr>
              <!-- <th>ID</th> -->
              <th>Product Code</th>
              <!-- <th>Image</th> -->
              <th>Name</th>
              <!-- <th>Price</th> -->
              <th>Quantity</th>
              <!-- <th>Product Status</th> -->
              <?php if($_SESSION['LoggedInUser']['can_edit'] == 1 || $_SESSION['LoggedInUser']['can_delete'] == 1):?>
              <th>Action</th>
              <?php else:?>
              <?php endif; ?>
            </tr>
            </thread>
          <tbody>
            <?php
            $products = getAll('products');
            if (mysqli_num_rows($products) > 0) {
            ?>
              <?php foreach ($products as $item) : ?>
                <tr>
                  <!-- <td><?= $item['id'] ?></td> -->
                  <input type="hidden" value="<?= $item['id'] ?>">
                  <td><b><?= $item['product_code'] ?></b></td>

                  <!-- <td>
                    <img src="<?= $item['image'];?>" onerror="this.src='images/M&J.png'" style="width: 50px; height: 50px; border-radius: 5%;" alt="Img">
  
                  </td> -->
                  <td><?= $item['name']?></td>

                  <!-- <td class="fw-bold"><?= $item['price'] ?></td> -->
                  <td class="fw-bold" style="color: 
                        <?php 
                        // if($item['category_id'] == 5){
                            if($item['quantity'] <= 10){
                                echo 'red';
                            } else {
                                echo '';
                            }
                        ?>;">
                        <?= $item['quantity']?>
                    </td>
                  <!-- 
                    <td>
                    <p class="btn btn-<?= $item['quantity'] <= 10 ? 'danger' : 'success' ?>"><?= $item['quantity'] <= 10 ? 'out of stock!':'good' ?></p>
                    </td> -->

                  <?php if($_SESSION['LoggedInUser']['can_edit'] == 1 || $_SESSION['LoggedInUser']['can_delete'] == 1):?>
                  <td>
                  <?php else:?>
                  <?php endif; ?>

               <?php if($_SESSION['LoggedInUser']['can_edit'] == 1):?>
                    <a href="products-edit.php?id=<?= $item['id'] ?>" class="btn btn-success btn-sm">Edit</a>
              <?php else:?>
              <?php endif; ?>
              <?php if($_SESSION['LoggedInUser']['can_delete'] == 1):?>
                    <a href="products-delete.php?id=<?= $item['id'] ?>" class="btn btn-danger btn-sm"
                    
                    onclick="return confirm('Are you sure you want to delete Product?.')"
                    >Delete</a>
              <?php else:?>
              <?php endif; ?>

                  </td>
                </tr>
              <?php endforeach; ?>
            <?php
            } else {
            ?>
              <tr>
                <td colspan="4"> No Record Found</td>
              </tr>
            <?php

            }
            ?>
          </tbody>
        </table>
      </div>
    </div>

    <div class="card-body" id="myTable1" style="display: block;">
     

      <div class="table-responsive">
        <table class="table table-striped table-bordered">
          <thead>
            <tr>
              <!-- <th>ID</th> -->
              <th>Product Code</th>
              <th>Image</th>
              <th>Name</th>
              <th>Price</th>
              <th>Quantity</th>
              <th>Product Status</th>
              <?php if($_SESSION['LoggedInUser']['can_edit'] == 1 || $_SESSION['LoggedInUser']['can_delete'] == 1):?>
              <th>Action</th>
              <?php else:?>
              <?php endif; ?>
            </tr>
            </thread>
          <tbody>
            <?php
            $products = getAll('products');
            if (mysqli_num_rows($products) > 0) {
            ?>
              <?php foreach ($products as $item) : ?>
                <tr>
                  <!-- <td><?= $item['id'] ?></td> -->
                  <input type="hidden" value="<?= $item['id'] ?>">
                  <td><b><?= $item['product_code'] ?></b></td>

                  <td>
                    <img src="<?= $item['image'];?>" onerror="this.src='images/M&J.png'" style="width: 50px; height: 50px; border-radius: 5%;" alt="Img">
                    <!-- diff in code php img inside...the file itself -->
                  </td>
                  <td><?= $item['name']?></td>

                  <td class="fw-bold"><?= $item['price'] ?></td>
                  <td class="fw-bold" style="color: 
                        <?php 
                        // if($item['category_id'] == 5){
                            if($item['quantity'] <= 10){
                                echo 'red';
                            } else {
                                echo '';
                            }
                        ?>;">
                        <?= $item['quantity']?>
                    </td>

                    <td>
                    <p class="btn btn-<?= $item['quantity'] <= 10 ? 'danger' : 'success' ?>"><?= $item['quantity'] <= 10 ? 'out of stock!':'good' ?></p>
                    </td>

                  <?php if($_SESSION['LoggedInUser']['can_edit'] == 1 || $_SESSION['LoggedInUser']['can_delete'] == 1):?>
                  <td>
                  <?php else:?>
                  <?php endif; ?>

               <?php if($_SESSION['LoggedInUser']['can_edit'] == 1):?>
                    <a href="products-edit.php?id=<?= $item['id'] ?>" class="btn btn-success btn-sm">Edit</a>
              <?php else:?>
              <?php endif; ?>
              <?php if($_SESSION['LoggedInUser']['can_delete'] == 1):?>
                    <a href="products-delete.php?id=<?= $item['id'] ?>" class="btn btn-danger btn-sm"
                    
                    onclick="return confirm('Are you sure you want to delete Product?.')"
                    >Delete</a>
              <?php else:?>
              <?php endif; ?>

                  </td>
                </tr>
              <?php endforeach; ?>
            <?php
            } else {
            ?>
              <tr>
                <td colspan="4"> No Record Found</td>
              </tr>
            <?php

            }
            ?>
          </tbody>
        </table>
      </div>
    </div>

  </div>
</div>

<script>
  
var showbox = document.getElementById('showCheckbox');
var myTable = document.getElementById('myTable');
var myTable1 = document.getElementById('myTable1');

showbox.addEventListener('change', function() {
  if (showbox.checked) {
    myTable.style.display = 'table';
    myTable1.style.display = 'none';
  } else {
    myTable.style.display = 'none';
    myTable1.style.display = 'table';

  }
});

</script>

<!-- <script>
  const imageLink = document.getElementById('image-link');
  const image = imageLink.querySelector('img');

  

  image.onerror = function() {
    this.src = '../img/defImage.jpeg';
    imageLink.href = this.src; // Update href if needed
  };


</script> -->


<?php include('includes/footer.php'); ?>