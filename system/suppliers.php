<?php include('includes/header.php'); ?>

<div class="container-fluid px-4 main-cards">
  <div class="card mt-4 shadow-sm">
    <div class="card-header">
      <h4 class="mb-0">Suppliers
        <?php if($_SESSION['LoggedInUser']['can_create'] == 1):?>
        <a href="suppliers-create.php" class="btn btn-primary float-end">Add Supplier</a>
        <?php else:?>
        <?php endif;?>
        <label class="float-end"style="margin-top: 3px;  margin-right: 150px;">Show</label>
        <input type="checkbox" id="showCheckbox" class=" float-end" style="width:30px;height:30px; margin-right: 10px; margin-top: 3px;">
      </h4>
    </div>

    <div class="card-body" id="myTable" style="display: none;">
      <?php alertMessage(); ?>

      <div class="table-responsive">

      <?php
            $suppliers = getAll('suppliers');
          if($suppliers){
            if (mysqli_num_rows($suppliers) > 0) {

            ?>

        <table class="table table-striped table-bordered">
          <thead>
            <tr>
              <!-- <th>ID</th> -->
              <th>Name</th>
              <th>Address</th>
              <th>Phone</th>
              <?php if($_SESSION['LoggedInUser']['can_edit'] == 1 || $_SESSION['LoggedInUser']['can_delete'] == 1):?>
              <th>Action</th>
              <?php else:?>
              <?php endif; ?>
            </tr>
            </thread>
          <tbody>

              <?php foreach ($suppliers as $item) : ?>
                <tr>
                  <!-- <td><?= $item['id'] ?></td> -->
                  <input type="hidden" value="<?$item['id'] ?>">
                  <td><?= $item['name'] ?></td>
                  <td><?= $item['email']?></td>
                  <td><?= $item['phone']?></td>

                  <?php if($_SESSION['LoggedInUser']['can_edit'] == 1 || $_SESSION['LoggedInUser']['can_delete'] == 1):?>
                  <td>
                  <?php else:?>
                  <?php endif; ?>
 

               <?php if($_SESSION['LoggedInUser']['can_edit'] == 1):?>
                    <a href="suppliers-edit.php?id=<?= $item['id'] ?>" class="btn btn-success btn-sm">Edit</a>
              <?php else:?>
              <?php endif; ?>
              <?php if($_SESSION['LoggedInUser']['can_delete'] == 1):?>
                    <a href="suppliers-delete.php?id=<?= $item['id']?>" 
                    class="btn btn-danger btn-sm"
                    onclick="return confirm('Are you sure you want to delete it?')" 
                    >Delete</a>
              <?php else:?>
              <?php endif; ?>
              
                  </td>
                </tr>
              <?php endforeach; ?>
           
          </tbody>
        </table>

        <?php
            } else {

              echo '<h5>No Suppliers Found</h5>';

            }
          }else{
            echo '<h5>Something Went Wrong</h5>';
          }
            ?>

      </div>
    </div>
    
    <div class="card-body" id="myTable1" style="display: block;">
      <?php alertMessage(); ?>

      <div class="table-responsive">

      <?php
            $suppliers = getAll('suppliers');
          if($suppliers){
            if (mysqli_num_rows($suppliers) > 0) {

            ?>

        <table class="table table-striped table-bordered">
          <thead>
            <tr>
              <!-- <th>ID</th> -->
              <th>Name</th>
              <!-- <th>Email</th> -->
              <th>Phone</th>
              <?php if($_SESSION['LoggedInUser']['can_edit'] == 1 || $_SESSION['LoggedInUser']['can_delete'] == 1):?>
              <th>Action</th>
              <?php else:?>
              <?php endif; ?>
            </tr>
            </thread>
          <tbody>

              <?php foreach ($suppliers as $item) : ?>
                <tr>
                  <!-- <td><?= $item['id'] ?></td> -->
                  <input type="hidden" value="<?$item['id'] ?>">
                  <td><?= $item['name'] ?></td>
                  <!-- <td><?= $item['email']?></td> -->
                  <td><?= $item['phone']?></td>

                  <?php if($_SESSION['LoggedInUser']['can_edit'] == 1 || $_SESSION['LoggedInUser']['can_delete'] == 1):?>
                  <td>
                  <?php else:?>
                  <?php endif; ?>
 

               <?php if($_SESSION['LoggedInUser']['can_edit'] == 1):?>
                    <a href="suppliers-edit.php?id=<?= $item['id'] ?>" class="btn btn-success btn-sm">Edit</a>
              <?php else:?>
              <?php endif; ?>
              <?php if($_SESSION['LoggedInUser']['can_delete'] == 1):?>
                    <a href="suppliers-delete.php?id=<?= $item['id']?>" 
                    class="btn btn-danger btn-sm"
                    onclick="return confirm('Are you sure you want to delete it?')" 
                    >Delete</a>
              <?php else:?>
              <?php endif; ?>
              
                  </td>
                </tr>
              <?php endforeach; ?>
           
          </tbody>
        </table>

        <?php
            } else {

              echo '<h5>No Suppliers Found</h5>';

            }
          }else{
            echo '<h5>Something Went Wrong</h5>';
          }
            ?>

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


<?php include('includes/footer.php'); ?>