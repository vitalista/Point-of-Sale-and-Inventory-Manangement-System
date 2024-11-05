<?php include('includes/header.php'); ?>
<?php if($_SESSION['LoggedInUser']['user_role'] == 'ADMIN'){?>

    <div class="container-fluid px-4 main-cards">

        <div class="card mt-4 shadow-sm">
            <div class="card-header">
                <h4 class="mb-0">Add user
                    <a href="users.php" class="btn btn-primary float-end">Back</a>
                </h4>
            </div>

            <div class="card-body">
                <?php alertMessage(); ?>
                <form action="config/code.php" method="POST">

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label >Name *</label>
                            <input type="text" name="name" required class="form-control w-50">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label >Email *</label>
                            <input type="email" name="email" required class="form-control w-50">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label >Password *</label>
                            <input type="password" name="password" required class="form-control w-50" id="userInput"> 
                            <label>Show Password</label><br>
                            <input type="checkbox" style="width:30px;height:30px;" onclick="showPassword()">             
                        </div>
                        <div class="col-md-6 mb-3">
                            <label >Phone number *</label>
                            <input type="number" name="phone" required class="form-control w-50">
                        </div>
                        <hr>
                        <div class="col-md-1 mb-3">
                            <label >Is Ban</label><br>
                            <input type="checkbox" name="is_ban" style="width:30px;height:30px;">
                        </div>

                        <div class="col-md-1 mb-3">
                            <label >Can Create</label><br>
                            <input type="checkbox" name="create" style="width:30px;height:30px;">
                        </div>

                        <div class="col-md-1 mb-3">
                            <label >Can Edit</label><br>
                            <input type="checkbox" name="edit" style="width:30px;height:30px;">
                        </div>

                        <div class="col-md-1 mb-3">
                            <label >Can Delete</label><br>
                            <input type="checkbox" name="delete" style="width:30px;height:30px;">
                        </div>

                        <div class="col-md-12 mb-3 text-end">
                            <button type="submit" name="saveUser" class="btn btn-primary">Save</button>
                        </div>
                    </div>

                </form>
            </div>

        </div>

    </div>

<?php }else{
echo '<script>window.location.href = "index.html";</script>';
}
?>

<?php include('includes/footer.php'); ?>