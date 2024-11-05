<?php include('includes/header.php'); ?>
<?php if($_SESSION['LoggedInUser']['user_role'] == 'ADMIN'){?>
  <div class="container-fluid px-4 main-cards">

      <div class="card mt-4 shadow-sm">
          <div class="card-header">

          <?php if($_SESSION['LoggedInUser']['user_role'] == 'ADMIN'):?>
              <h4 class="mb-0"><a id="gear1">Edit User </a>
                <a id="gear">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-gear" viewBox="0 0 16 16">
                <path d="M8 4.754a3.246 3.246 0 1 0 0 6.492 3.246 3.246 0 0 0 0-6.492M5.754 8a2.246 2.246 0 1 1 4.492 0 2.246 2.246 0 0 1-4.492 0"/>
                <path d="M9.796 1.343c-.527-1.79-3.065-1.79-3.592 0l-.094.319a.873.873 0 0 1-1.255.52l-.292-.16c-1.64-.892-3.433.902-2.54 2.541l.159.292a.873.873 0 0 1-.52 1.255l-.319.094c-1.79.527-1.79 3.065 0 3.592l.319.094a.873.873 0 0 1 .52 1.255l-.16.292c-.892 1.64.901 3.434 2.541 2.54l.292-.159a.873.873 0 0 1 1.255.52l.094.319c.527 1.79 3.065 1.79 3.592 0l.094-.319a.873.873 0 0 1 1.255-.52l.292.16c1.64.893 3.434-.902 2.54-2.541l-.159-.292a.873.873 0 0 1 .52-1.255l.319-.094c1.79-.527 1.79-3.065 0-3.592l-.319-.094a.873.873 0 0 1-.52-1.255l.16-.292c.893-1.64-.902-3.433-2.541-2.54l-.292.159a.873.873 0 0 1-1.255-.52zm-2.633.283c.246-.835 1.428-.835 1.674 0l.094.319a1.873 1.873 0 0 0 2.693 1.115l.291-.16c.764-.415 1.6.42 1.184 1.185l-.159.292a1.873 1.873 0 0 0 1.116 2.692l.318.094c.835.246.835 1.428 0 1.674l-.319.094a1.873 1.873 0 0 0-1.115 2.693l.16.291c.415.764-.42 1.6-1.185 1.184l-.291-.159a1.873 1.873 0 0 0-2.693 1.116l-.094.318c-.246.835-1.428.835-1.674 0l-.094-.319a1.873 1.873 0 0 0-2.692-1.115l-.292.16c-.764.415-1.6-.42-1.184-1.185l.159-.291A1.873 1.873 0 0 0 1.945 8.93l-.319-.094c-.835-.246-.835-1.428 0-1.674l.319-.094A1.873 1.873 0 0 0 3.06 4.377l-.16-.292c-.415-.764.42-1.6 1.185-1.184l.292.159a1.873 1.873 0 0 0 2.692-1.115z"/>
              </svg>
                </a>
                  <a href="users.php" class="btn btn-danger float-end">Back</a>
              </h4>
          <?php else :?>
            <h4 class="mb-0">Edit User
                  <a href="users.php" class="btn btn-danger float-end">Back</a>
              </h4>
          <?php endif; ?>


          </div>

          <div class="card-body">
              <?php alertMessage(); ?>
              <form action="config/code.php" method="POST">

              <?php
              
              if(isset($_GET['id'])){

                if($_GET['id'] != ''){
                
                  $id = $_GET['id'];

              }else{
                echo '<h5>No ID Found</h5>';
                return false;
              }
            }else{
              echo '<h5>No ID Found</h5>';
                return false;
            }

            $data = getById('users', $id);

            if($data){

              if($data['data']['id'] === addminId($id)){
              
              if($data['status'] == 200){

                ?>
                <input type="hidden" name="userId" value="<?= $data['data']['id']; ?>">
                      <div class="row">
                      <div class="col-md-6 mb-3">
                          <label for="name">Name *</label>
                          <input type="text" name="name" required value="<?= $data['data']['name']; ?>" class="form-control">
                      </div>
                      <div class="col-md-6 mb-3">
                          <label for="email">Email *</label>
                          <input type="email" name="email" required value="<?= $data['data']['email']; ?>" class="form-control">
                      </div>
                      <div class="col-md-6 mb-3">
                          <label for="password">Password *</label>
                          <input type="password" name="password" class="form-control">
                      </div>
                      <div class="col-md-6 mb-3">
                          <label for="phone">Phone number *</label>
                          <input type="number" name="phone" required value="<?= $data['data']['phone']; ?>" class="form-control">
                      </div>

                      <div class="col-md-12 mb-3 text-end">
                          <button type="submit" name="updateUser" class="btn btn-primary">Update</button>
                      </div>
                  </div>

                    <div class="col-md-1 mb-3 fixDiv" id="fixDiv">
                          <label >Can Create</label><br>
                          <input type="checkbox" name="create" <?= $data['data']['can_create'] == true ? 'checked':''; ?> style="width:30px;height:30px;">
                      </div>

                      <div class="col-md-1 mb-3 fixDiv" id="fixDiv1">
                          <label >Can Edit</label><br>
                          <input type="checkbox" name="edit" <?= $data['data']['can_edit'] == true ? 'checked':''; ?> style="width:30px;height:30px;">
                      </div>

                      <div class="col-md-1 mb-3 fixDiv" id="fixDiv2">
                          <label >Can Delete</label><br>
                          <input type="checkbox" name="delete" <?= $data['data']['can_delete'] == true ? 'checked':''; ?> style="width:30px;height:30px;">
                      </div>

                      <div class="row">
                        <div class="col-md-12 mb-3 fixDiv" id="fixDiv3">
                            <label >User Role</label><br>
                            <input type="text" name="user_role" value="<?= $data['data']['user_role']; ?>">
                        </div>
                      </div>

                <?php

              }else{
                echo '<h5>'.$data['message'].'</h5>';
              }
              
            }else{

              ?>
              <input type="hidden" name="userId" value="<?= $data['data']['id']; ?>">
                    <div class="row">

                    <div class="col-md-6 mb-3">
                    
                    <label for="name">Name *
                        </label>
                        <input type="text" name="name" required value="<?= $data['data']['name']; ?>" class="form-control w-50">
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label for="email">Email *</label>
                        <input type="email" name="email" required value="<?= $data['data']['email']; ?>" class="form-control w-50">
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label for="password">Password *</label>
                        <input type="password" name="password" class="form-control w-50">
                        <label>Show Password</label><br>
                        <input type="checkbox" style="width:30px;height:30px;" onclick="showPassword()">   
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="phone">Phone number *</label>
                        <input type="number" name="phone" required value="<?= $data['data']['phone']; ?>" class="form-control w-50">
                    </div>
                    <hr>
                    <div class="col-md-1 mb-3">
                        <label for="is_ban">Is Ban</label><br>
                        <input type="checkbox" name="is_ban" <?= $data['data']['is_ban'] == true ? 'checked':''; ?> style="width:30px;height:30px;">
                    </div>

                    <div class="col-md-1 mb-3">
                          <label >Can Create</label><br>
                          <input type="checkbox" name="create" <?= $data['data']['can_create'] == true ? 'checked':''; ?> style="width:30px;height:30px;">
                      </div>

                      <div class="col-md-1 mb-3">
                          <label >Can Edit</label><br>
                          <input type="checkbox" name="edit" <?= $data['data']['can_edit'] == true ? 'checked':''; ?> style="width:30px;height:30px;">
                      </div>

                      <div class="col-md-1 mb-3">
                          <label >Can Delete</label><br>
                          <input type="checkbox" name="delete" <?= $data['data']['can_delete'] == true ? 'checked':''; ?> style="width:30px;height:30px;">
                      </div>

                    <div class="col-md-12 mb-3 text-end">
                        <button type="submit" name="updateUser" class="btn btn-primary">Update</button>
                    </div>

                    <div class="row">
                        <div class="col-md-12 mb-3 fixDiv" id="fixDiv4">
                            <label >User Role</label><br>
                            <input type="text" name="user_role" value="<?= $data['data']['user_role']; ?>">
                        </div>
                    </div>

                </div>


              <?php

            }

            }else{

              echo 'Something Went Wrong';
              return false;

            }
              ?>
              </form>
          </div>

      </div>

  </div>
<?php }else{
echo '<script>window.location.href = "index.html";</script>';
}
?>

<?php include('includes/footer.php'); ?>