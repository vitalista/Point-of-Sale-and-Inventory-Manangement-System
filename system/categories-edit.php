<?php include('includes/header.php'); ?>
<?php if($_SESSION['LoggedInUser']['can_edit'] == 1){?>
<div class="container-fluid px-4 main-cards">

    <div class="card mt-4 shadow-sm">
        <div class="card-header">
            <h4 class="mb-0">Edit Category
                <a href="categories.php" class="btn btn-primary float-end">Back</a>
            </h4>
        </div>

        <div class="card-body">
            <?php alertMessage(); ?>
            
            <form action="config/code.php" method="POST">

                <?php

                $paramValue = checkParamId('id');
                if (!is_numeric($paramValue)) {

                    echo '<h5>.$paraValue.</h5>';
                    return false;
                }

                $category = getById('categories', $paramValue);
                if ($category['status'] == 200) {
                ?>
                    <input type="hidden" name="categoryID" value="<?= $category['data']['id']; ?>">

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="name">Name *</label>
                            <input type="text" name="name" value="<?= $category['data']['name']; ?>" required class="form-control">
                        </div>
                        <!-- md to resize -->
                        <div class="col-md-12 mb-3">
                            <label for="email">Description *</label>
                            <textarea name="description" class="form-control" rows="3"><?= $category['data']['description']; ?></textarea>
                        </div>

                        <div class="col-md-6 mb-3">
                            <button type="submit" name="updateCategory" class="btn btn-primary">Update</button>
                        </div>
                    </div>
                <?php

                } else {
                    echo '<h5>' . $category['message'] . '</h5>';
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