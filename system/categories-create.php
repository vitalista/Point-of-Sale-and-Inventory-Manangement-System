<?php include('includes/header.php'); ?>
<?php if($_SESSION['LoggedInUser']['can_create'] == 1){?>
<div class="container-fluid px-4 main-cards">

    <div class="card mt-4 shadow-sm">
        <div class="card-header">
            <h4 class="mb-0">Add Category
                <a href="categories.php" class="btn btn-primary float-end">Back</a>
            </h4>
        </div>

        <div class="card-body">
            <?php alertMessage(); ?>
            <form action="config/code.php" method="POST">

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="name">Name *</label>
                        <input type="text" name="name" required class="form-control">
                    </div>

                    <div class="col-md-12 mb-3"> 
                        <label for="email">Description *</label>
                       <textarea name="description" class="form-control" rows="3"></textarea>
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <button type="submit" name="saveCategory" class="btn btn-primary">Save</button>
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