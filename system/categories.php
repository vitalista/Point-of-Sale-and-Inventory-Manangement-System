<?php include('includes/header.php'); ?>

<div class="container-fluid px-4 main-cards">
  <div class="card mt-4 shadow-sm">
    <div class="card-header">
      <h4 class="mb-0">Categories
      <?php if($_SESSION['LoggedInUser']['can_create'] == 1):?>
        <a href="categories-create.php" class="btn btn-primary float-end">Add Category</a>
        <?php else:?>
        <?php endif;?>
        <label class="float-end"style="margin-top: 3px;  margin-right: 150px;">Show</label>
        <input type="checkbox" id="showCheckbox" class=" float-end" style="width:30px;height:30px; margin-right: 10px; margin-top: 3px;">
      </h4>
    </div>

    <div class="card-body" id="myTable" style="display: none;">
      <?php alertMessage(); ?>

      <div class="table-responsive">
        <table id="myTable" class="table table-striped table-bordered">
          <thead>
            <tr>
              <!-- <th>ID</th> -->
              <th>Name</th>
              <th>Description</th>
              <?php if($_SESSION['LoggedInUser']['can_edit'] == 1 || $_SESSION['LoggedInUser']['can_delete'] == 1):?>
              <th style="padding-left: 59px;
              padding-right: 50px;
              ">Action</th>
              <?php else:?>
              <?php endif; ?>

            </tr>
            </thread>
          <tbody>
            <?php
            $categories = getAll('categories');
            if (mysqli_num_rows($categories) > 0) {

            ?>
              <?php foreach ($categories as $item) : ?>
                <tr>
                  <!-- <td><?= $item['id'] ?></td> -->
                  <input type="hidden" value="<?= $item['id'] ?>">
                  <td><?= $item['name'] ?></td>
                  <td><?= $item['description']?></td>

                  <?php if($_SESSION['LoggedInUser']['can_edit'] == 1 || $_SESSION['LoggedInUser']['can_delete'] == 1):?>
                  <td>
                  <?php else:?>
                  <?php endif; ?>

                  <?php if($_SESSION['LoggedInUser']['can_edit'] == 1):?>
                    <a href="categories-edit.php?id=<?= $item['id'] ?>" class="btn btn-success btn-sm">Edit</a>
                  <?php else:?>
                  <?php endif; ?>
                 <?php if($_SESSION['LoggedInUser']['can_delete'] == 1):?>
                    <a href="categories-delete.php?id=<?= $item['id'] ?>" class="btn btn-danger btn-sm"
                    onclick="return confirm('Are you sure you want to delete it?')" 
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
      <?php alertMessage(); ?>

      <div class="table-responsive">
        <table id="myTable" class="table table-striped table-bordered">
          <thead>
            <tr>
              <!-- <th>ID</th> -->
              <th>Name</th>
              <!-- <th>Description</th> -->
              <?php if($_SESSION['LoggedInUser']['can_edit'] == 1 || $_SESSION['LoggedInUser']['can_delete'] == 1):?>
              <th style="padding-left: 59px;
              padding-right: 50px;
              ">Action</th>
              <?php else:?>
              <?php endif; ?>

            </tr>
            </thread>
          <tbody>
            <?php
            $categories = getAll('categories');
            if (mysqli_num_rows($categories) > 0) {

            ?>
              <?php foreach ($categories as $item) : ?>
                <tr>
                  <!-- <td><?= $item['id'] ?></td> -->
                  <input type="hidden" value="<?= $item['id'] ?>">
                  <td><?= $item['name'] ?></td>
                  <!-- <td><?= $item['description']?></td> -->

                  <?php if($_SESSION['LoggedInUser']['can_edit'] == 1 || $_SESSION['LoggedInUser']['can_delete'] == 1):?>
                  <td>
                  <?php else:?>
                  <?php endif; ?>

                  <?php if($_SESSION['LoggedInUser']['can_edit'] == 1):?>
                    <a href="categories-edit.php?id=<?= $item['id'] ?>" class="btn btn-success btn-sm">Edit</a>
                  <?php else:?>
                  <?php endif; ?>
                 <?php if($_SESSION['LoggedInUser']['can_delete'] == 1):?>
                    <a href="categories-delete.php?id=<?= $item['id'] ?>" class="btn btn-danger btn-sm"
                    onclick="return confirm('Are you sure you want to delete it?')" 
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

<?php include('includes/footer.php'); ?>