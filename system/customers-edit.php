<?php include('includes/header.php'); ?>
<?php if($_SESSION['LoggedInUser']['can_edit'] == 1){?>
<div class="container-fluid px-4 main-cards">

    <div class="card mt-4 shadow-sm">
        <div class="card-header">
            <h4 class="mb-0">Edit Customer
                <a href="customers.php" class="btn btn-primary float-end">Back</a>
            </h4>
        </div>

        <div class="card-body">
            <?php alertMessage(); ?>

            <?php
            $paramvalue = checkParamId('id');
            if(!is_numeric($paramvalue)){

              echo '<h5>'.$paramvalue.'</h5>';
              return false;

            }

            $customer = getById('customers',$paramvalue);

            if($customer['status'] === 200){

              ?>

             
              
              <form action="config/code.php" method="POST">

                <div class="row">
                    <div class="col-md-7 mb-3">

                    <input type="hidden" name="customer_id" value="<?= $customer['data']['id']; ?>">

                        <label for="">Name *</label>
                        <input type="text" name="name" value="<?= $customer['data']['name']; ?>" required class="form-control">
                    </div>

                    <div class="col-md-7 mb-3">
                        <label for="">Email *</label>
                        <input type="text" name="email" value="<?= $customer['data']['email']; ?>" class="form-control">
                    </div>

                    <div class="col-md-7 mb-3">
                        <label for="">Phone *</label>
                        <input type="number" name="phone" value="<?= $customer['data']['phone']; ?>" class="form-control">
                    </div>
                    
                    <div class="col-md-12 mb-3 text-end">
                        <button type="submit" name="updateCustomer" class="btn btn-primary">Update</button>
                    </div>
                </div>

            </form>

              <?php

            }else{
              echo '<h5>'.$customer['message'].'</h5>';
              return false;
            }

            ?>

            
        </div>

    </div>






</div>
<?php }else{
echo '<script>window.location.href = "index.html";</script>';
}
?>
<?php include('includes/footer.php'); ?>