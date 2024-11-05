<?php include('includes/header.php'); ?>
<?php if($_SESSION['LoggedInUser']['can_create'] == 1){?>
<div class="container-fluid px-4 main-cards">

    <div class="card mt-4 shadow-sm">

        <div class="card-header">
        <?php
        $isChecked = isset($_POST['custom']) && $_POST['checkbox_name'] == 'on';
        ?>
            <h4 class="mb-0">Add Product
                <a href="products.php" class="btn btn-primary float-end">Back</a>
                <label class="float-end"style="margin-top: 3px;  margin-right: 150px;">Custom</label>
                <input type="checkbox" id="customCheckbox" onclick="reloadDiv()" class=" float-end" style="width:30px;height:30px; margin-right: 10px; margin-top: 3px;">
                
            </h4>
        </div>

        <div class="card-body">
        <?php alertMessage();?>
            <form action="config/code.php" method="POST" enctype="multipart/form-data">

                <div class="row">

                    <div class="col-md-6 mb-3">
                        <label>Product Code <span style="color: red; font-weight: bold;">*</span></label>
                        <input type="text" name="prodCode" required class="form-control">
                        <label>Product Name <span style="color: red; font-weight: bold;">*</span></label>
                        <input type="text" name="name" required class="form-control">
                    </div>
                    <!-- md to resize -->

                    <div class="col-md-6 mb-3">
                        <label>Description </label>
                        <textarea name="description" class="form-control" rows="3"></textarea>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Category </label>
                        <select name="category_id" id="selectOption" class="form-select mySelect2">
                            <option value="" selected disabled>-- Select Category --</option>
                            <?php
                            $categories = getAll('categories');
                            if ($categories) {

                                if (mysqli_num_rows($categories) > 0) {

                                    foreach ($categories as $category) {
                                        echo '<option value="' . $category['id'] . '" name="'.$category['name'].'">' . $category['name'] . '</option>';
                                    }
                                } else {
                                    echo '<option value="">No Categories Found.</option>';
                                }
                            } else {
                                echo '<option value="">Something Went Wrong</option>';
                            }
                            ?>
                        </select>
                    </div>



                    <div class="col-md-6 mb-3" id="volume" style="display: none;">
                        <label>Volume</label>
                        <select name="volume" id="" class="form-select">
                            <option value="" selected disabled>-- Select Volume --</option>
                            <option value="1 Bottle">1 Bottle</option>
                            <option value="1/8 L">1/8 L</option>
                            <option value="1/4 L">1/4 L</option>
                            <option value="1/2 L">1/2 L</option>
                            <option value="1 L">1 L</option>
                            <option value="1 gal">1 gal</option>
                        </select>
                    </div>

                    <div class="col-md-6 mb-3" id="size" style="display: none;">
                        <label>Size</label>
                        <select name="size" id="" class="form-select">
                            <option value="" selected disabled>-- Select Size --</option>
                            <option value="Small">Small</option>
                            <option value="Medium">Medium</option>
                            <option value="Big">Big</option>
                        </select>
                    </div>

                    <div class="col-md-6 mb-3" id="numeriSize" style="display: none;">
                        <label>Numeric Size</label>
                        <select name="numericSize" id="" class="form-select">
                            <option value="" selected disabled>-- Select Numeric Size --</option>
                            <option value="3/8">3/8</option>
                            <option value="1/2">1/2</option>
                            <option value="3/4">3/4</option>
                            <option value="1">1</option>
                            <option value="1 1/2">1 1/2</option>
                            <option value="2">2</option>
                            <option value="2 1/2">2 1/2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                        </select>
                    </div>

                    <div class="col-md-6 mb-3"id="grit" style="display: none;">
                        <label>Grit Size</label>
                        <select name="grit" id="" class="form-select">
                            <option value="" selected disabled>-- Select Grit Size --</option>
                            <option value="36">36</option>
                            <option value="60-100">60-100</option>
                            <option value="120-1500">120-1500</option>
                            <option value="2000">2000</option>
                        </select>
                    </div>

                    <!-- <div class="col-md-6 mb-3"id="types" style="display: none;">
                        <label>Type</label>
                        <select name="type" id="" class="form-select">
                            <option value="" selected disabled>-- Type --</option>
                            <option value="">Urethane</option>
                            <option value="">Acrilic</option>
                            <option value="">Latex</option>
                            <option value="">2000</option>
                        </select>
                    </div> -->

                    <div class="col-md-6 mb-3" id="color" style="display: none;">
                        <label>Color</label>
                        <select name="color" id="" class="form-select">
                            <option value="" selected disabled>-- Color --</option>
                            <option value="Blue">Blue</option>
                            <option value="Red">Red</option>
                            <option value="Green">Green</option>
                            <option value="Black">Black</option>
                        </select>
                    </div>
                    
                    <!-- // -->

                    <div class="col-md-2 mb-3" id="csize" style="display: none;">
                        <label>Size </label>
                        <input type="text" name="size2"  class="form-control" placeholder="ex. Small">
                    </div>

                    <div class="col-md-2 mb-3"  id="cnumeriSize" style="display: none;">
                        <label>Numeric Size </label>
                        <input type="text" name="numericSize2" class="form-control" placeholder="ex. 1 or 1/2">
                    </div>

                    <div class="col-md-1 mb-3" id="cvolume" style="display: none;">
                        <label>Volume </label>
                        <input type="text" name="volume2"   class="form-control" placeholder="ex. 1gal">
                    </div>
   
                    <div class="col-md-6 mb-3" id="ctype" style="display: none;">
                        <label>Type (any type)</label>
                        <input type="text" name="type2"  class="form-control" placeholder="ex. Latex or Gloss">
                    </div>

                    
                    <div class="col-md-3 mb-3" id="ccolor" style="display: none;">
                        <label>Color </label>
                        <input type="text" name="color2"  class="form-control" placeholder="ex. Black">
                    </div>

                    <div class="col-md-2 mb-3" id="cgrit"  style="display: none;">
                        <label>Grit Size (sand paper)</label>
                        <input type="text" name="grit2"  class="form-control" placeholder="ex. 1000">
                    </div>
               

                    <div class="col-md-6 mb-3">
                        <label>Image </label>
                        <input type="file" name="image" class="form-control">
                    </div>

                    <div class="col-md-1 mb-3">
                        <label>Price <span style="color: red; font-weight: bold;">*</span></label>
                        <input type="text" name="price" required class="form-control">
                    </div>

                    <div class="col-md-1 mb-3">
                        <label>Quantity <span style="color: red; font-weight: bold;">*</span></label>
                        <input type="text" name="quantity" required class="form-control">
                    </div>

                    <div class="col-md-12 mb-3 text-end">
                        <button type="submit" name="saveProduct" class="btn btn-primary">Save</button>
                    </div>



                </div>

            </form>

        </div>

    </div>

<script>

    function reloadDiv() {

        var volume = '<label>Volume</label><select name="volume" id="" class="form-select"><option value="" selected disabled>-- Select Volume --</option></select>';
        var size = '<label>Size</label><select name="size" id="" class="form-select"><option value="" selected disabled>-- Select Size --</option></select>';
        var numeriSize = '<select name="numericSize" id="" class="form-select"><option value="" selected disabled>-- Select Numeric Size --</option></select>';
        var grit = '<select name="grit" id="" class="form-select"><option value="" selected disabled>-- Select Grit Size --</option></select>';
        // var types = '';
        var color = '<select name="color" id="" class="form-select"><option value="" selected disabled>-- Color --</option></select>';




        var volumeDiv = document.getElementById('volume');
        var sizeDiv = document.getElementById('size');
        var numeriSizeDiv = document.getElementById('numeriSize');
        var gritDiv = document.getElementById('grit');
        // var typesDiv = document.getElementById('types');
        var colorDiv = document.getElementById('color');
    
    
            volumeDiv.innerHTML = volume;
            sizeDiv.innerHTML = size;
            numeriSizeDiv.innerHTML = numeriSize;
            gritDiv.innerHTML = grit;
            // typesDiv.innerHTML = types;
            colorDiv.innerHTML = color;

    }

    document.addEventListener('DOMContentLoaded', function() {
 
        var checkbox = document.getElementById('customCheckbox');

        var color = document.getElementById('color');
        var volumeDiv = document.getElementById('volume');
        var size = document.getElementById('size');
        var numeriSize = document.getElementById('numeriSize');
        var grit = document.getElementById('grit');

        var ccolor = document.getElementById('ccolor');
        var cvolumeDiv = document.getElementById('cvolume');
        var csize = document.getElementById('csize');
        var cnumeriSize = document.getElementById('cnumeriSize');
        var cgrit = document.getElementById('cgrit');
        var ctype = document.getElementById('ctype');


        checkbox.addEventListener('change', function() {

            if (checkbox.checked) {

                cvolumeDiv.style.display = 'block';
                csize.style.display = 'block';
                cnumeriSize.style.display = 'block';
                cgrit.style.display = 'block';
                ccolor.style.display = 'block';
                ctype.style.display = 'block';

                volumeDiv.style.display = 'none';
                size.style.display = 'none';
                numeriSize.style.display = 'none';
                grit.style.display = 'none';
                color.style.display = 'none';
                // type.style.display = 'block';

            } else {


                location.reload();

                cvolumeDiv.style.display = 'none';
                csize.style.display = 'none';
                cnumeriSize.style.display = 'none';
                cgrit.style.display = 'none';
                ccolor.style.display = 'none';
                ctype.style.display = 'none';

                volumeDiv.style.display = 'none';
                size.style.display = 'none';
                numeriSize.style.display = 'none';
                grit.style.display = 'none';
                color.style.display = 'none';

            }

        });

        $('#selectOption').on('select2:select', function (e) {
            var selectedOption = e.params.data.text;

    
                    if(!checkbox.checked){
                    switch (selectedOption) {
                        case 'Paint':
                            color.style.display = 'block';
                            volumeDiv.style.display = 'block';
                            size.style.display = 'none';
                            numeriSize.style.display = 'none';
                            grit.style.display = 'none';

                            break;
                        case 'Brush':
                            color.style.display = 'none';
                            volumeDiv.style.display = 'none';
                            size.style.display = 'block';
                            numeriSize.style.display = 'block';
                            grit.style.display = 'none';
                            break;
                        case 'Body Filler':
                            color.style.display = 'none';
                            volumeDiv.style.display = 'block';
                            size.style.display = 'none';
                            numeriSize.style.display = 'none';
                            grit.style.display = 'none';
                            break;
                        case 'Tape':
                            volumeDiv.style.display = 'none';
                            size.style.display = 'none';
                            numeriSize.style.display = 'block';
                            grit.style.display = 'none';
                        color.style.display = 'none';

                            break;
                        case 'Thinner':
                            volumeDiv.style.display = 'block';
                            size.style.display = 'none';
                            numeriSize.style.display = 'none';
                            color.style.display = 'none';
                            grit.style.display = 'none';
                            break;
                        case 'Paint Supplies':
                            volumeDiv.style.display = 'none';
                            size.style.display = 'block';
                            color.style.display = 'none';
                            numeriSize.style.display = 'block';
                            grit.style.display = 'block';
                            break;
                        case 'Primer Coat':
                        case 'Top Coat':
                            volumeDiv.style.display = 'block';
                            size.style.display = 'none';
                            color.style.display = 'none';
                            numeriSize.style.display = 'none';
                            grit.style.display = 'none';
                            break;
                        default:
                            volumeDiv.style.display = 'none';
                            size.style.display = 'none';
                        numeriSize.style.display = 'none';
                        grit.style.display = 'none';
                        color.style.display = 'none';
                    }
                }
            });

       
    });
</script>



</div>
<?php }else{
echo '<script>window.location.href = "index.html";</script>';
}
?>

<?php include('includes/footer.php'); ?>