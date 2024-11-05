<?php include('includes/header.php'); ?>
<?php if($_SESSION['LoggedInUser']['can_edit'] == 1){?>
<div class="container-fluid px-4 main-cards">

  <div class="card mt-4 shadow-sm">



    <div class="card-header">
      <h4 class="mb-0">Edit Product
      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-gear" viewBox="0 0 16 16">
        <path d="M8 4.754a3.246 3.246 0 1 0 0 6.492 3.246 3.246 0 0 0 0-6.492M5.754 8a2.246 2.246 0 1 1 4.492 0 2.246 2.246 0 0 1-4.492 0"/>
        <path d="M9.796 1.343c-.527-1.79-3.065-1.79-3.592 0l-.094.319a.873.873 0 0 1-1.255.52l-.292-.16c-1.64-.892-3.433.902-2.54 2.541l.159.292a.873.873 0 0 1-.52 1.255l-.319.094c-1.79.527-1.79 3.065 0 3.592l.319.094a.873.873 0 0 1 .52 1.255l-.16.292c-.892 1.64.901 3.434 2.541 2.54l.292-.159a.873.873 0 0 1 1.255.52l.094.319c.527 1.79 3.065 1.79 3.592 0l.094-.319a.873.873 0 0 1 1.255-.52l.292.16c1.64.893 3.434-.902 2.54-2.541l-.159-.292a.873.873 0 0 1 .52-1.255l.319-.094c1.79-.527 1.79-3.065 0-3.592l-.319-.094a.873.873 0 0 1-.52-1.255l.16-.292c.893-1.64-.902-3.433-2.541-2.54l-.292.159a.873.873 0 0 1-1.255-.52zm-2.633.283c.246-.835 1.428-.835 1.674 0l.094.319a1.873 1.873 0 0 0 2.693 1.115l.291-.16c.764-.415 1.6.42 1.184 1.185l-.159.292a1.873 1.873 0 0 0 1.116 2.692l.318.094c.835.246.835 1.428 0 1.674l-.319.094a1.873 1.873 0 0 0-1.115 2.693l.16.291c.415.764-.42 1.6-1.185 1.184l-.291-.159a1.873 1.873 0 0 0-2.693 1.116l-.094.318c-.246.835-1.428.835-1.674 0l-.094-.319a1.873 1.873 0 0 0-2.692-1.115l-.292.16c-.764.415-1.6-.42-1.184-1.185l.159-.291A1.873 1.873 0 0 0 1.945 8.93l-.319-.094c-.835-.246-.835-1.428 0-1.674l.319-.094A1.873 1.873 0 0 0 3.06 4.377l-.16-.292c-.415-.764.42-1.6 1.185-1.184l.292.159a1.873 1.873 0 0 0 2.692-1.115z"/>
      </svg>
        <a href="products.php" class="btn btn-primary float-end">Back</a>
        <label class="float-end" style="margin-top: 3px;  margin-right: 150px;">Custom</label>
        <input type="checkbox" id="customCheckbox" onclick="reloadDiv()" class=" float-end"

        style="width:30px;height:30px; margin-right: 10px; margin-top: 3px;">
      </h4>
    </div>

    <div class="card-body">
      <?php alertMessage(); ?>

      <form action="config/code.php" method="POST" enctype="multipart/form-data">

      <?php
              $paramValue = checkParamId('id');
              if (!is_numeric($paramValue)) {

                echo '<h5>Id is not an Integer</h5>';
                return false;
              }
              $product = getById('products', $paramValue);
              if ($product) {

                if ($product['status'] === 200) {
              ?>

    <!-- ////////////////////////////////////////////////////////////////////////////////////////////////// -->
            <input type="hidden" name="product_id" value="<?= $product['data']['id']; ?>">

            <div class="row">

                    <div class="col-md-6 mb-3">
                        <label>Product Code <span style="color: red; font-weight: bold;">*</span></label>
                        <input type="text" name="prodCode" value="<?= $product['data']['product_code']; ?>" required class="form-control">
                        <label>Product Name <span style="color: red; font-weight: bold;">*</span></label>
                        <input type="text" name="name" value="<?= $product['data']['name']; ?>" required class="form-control">
                    </div>

                    <div class="col-md-6 mb-3">
                      <label for="email">Description </label>
                      <textarea name="description" class="form-control" rows="3"> <?= $product['data']['description']; ?> </textarea>
                    </div>

              <div class="col-md-6 mb-3">
                <label for="name">Category </label>
                <select name="category_id" id="selectOption" class="form-select mySelect2">
                  <option value="" disabled>-- Select Category --</option>
                  <?php
                  $categories = getAll('categories');
                  if ($categories) {



                    if (mysqli_num_rows($categories) > 0) {
                      foreach ($categories as $category) {
                  ?>
                        <option value="<?= $category['id'] ?>" <?= $product['data']['category_id'] === $category['id'] ? 'selected' : ''; ?>><?= $category['name'] ?></option>
                  <?php

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

            <!-- // -->

                <div class="col-md-6 mb-3" id="volume" style="display: 

                <?= $product['data']['volume'] == '1 Bottle' ||
                    $product['data']['volume'] == '1/8 L' ||
                    $product['data']['volume'] == '1/4 L' ||
                    $product['data']['volume'] == '1/2 L' ||
                    $product['data']['volume'] == '1 L' ||
                    $product['data']['volume'] == '1 gal L'

                ? 'block':'none'; ?>;">

                        <label>Volume</label>
                        <select name="volume" id="" class="form-select">
                            <option value="" selected disabled>-- Select Volume --</option>
                            <option value="1 Bottle" <?= $product['data']['volume'] == '1 Bottle'? 'selected':''; ?> >1 Bottle</option>
                            <option value="1/8 L" <?= $product['data']['volume'] == '1/8 L'? 'selected':''; ?> >1/8 L</option>
                            <option value="1/4 L" <?= $product['data']['volume'] == '1/4 L'? 'selected':''; ?> >1/4 L</option>
                            <option value="1/2 L" <?= $product['data']['volume'] == '1/2 L'? 'selected':''; ?> >1/2 L</option>
                            <option value="1 L" <?= $product['data']['volume'] == '1 L'? 'selected':''; ?> >1 L</option>
                            <option value="1 gal" <?= $product['data']['volume'] == '1 gal'? 'selected':''; ?> >1 gal</option>
                        </select>
                    </div>

                    <div class="col-md-6 mb-3" id="size" style="display: 

                <?= $product['data']['size'] == 'Small' ||
                    $product['data']['size'] == 'Medium' ||
                    $product['data']['size'] == 'Big'

                ? 'block':'none'; ?>;">

                        <label>Size</label>
                        <select name="size" id="" class="form-select">
                            <option value="" selected disabled>-- Select Size --</option>
                            <option value="Small" <?= $product['data']['size'] == 'Small'? 'selected':''; ?> >Small</option>
                            <option value="Medium" <?= $product['data']['size'] == 'Medium'? 'selected':''; ?> >Medium</option>
                            <option value="Big" <?= $product['data']['size'] == 'Big'? 'selected':''; ?> >Big</option>
                        </select>
                    </div>

                    <div class="col-md-6 mb-3" id="numeriSize" style="display: 
                    
                <?= $product['data']['numeric_size'] == '3/8' ||
                    $product['data']['numeric_size'] == '1/2' ||
                    $product['data']['numeric_size'] == '3/4' ||
                    $product['data']['numeric_size'] == '1' ||
                    $product['data']['numeric_size'] == '1 1/2' ||
                    $product['data']['numeric_size'] == '2' ||
                    $product['data']['numeric_size'] == '2 1/2' ||
                    $product['data']['numeric_size'] == '3' ||
                    $product['data']['numeric_size'] == '4'

                ? 'block':'none'; ?>;">

                        <label>Numeric Size</label>
                        <select name="numericSize" id="" class="form-select">
                            <option value="" selected disabled>-- Select Numeric Size --</option>
                            <option value="3/8" <?= $product['data']['numeric_size'] == '3/8'? 'selected':''; ?>      >3/8</option>
                            <option value="1/2" <?= $product['data']['numeric_size'] == '1/2'? 'selected':''; ?>      >1/2</option>
                            <option value="3/4" <?= $product['data']['numeric_size'] == '3/4'? 'selected':''; ?>      >3/4</option>
                            <option value="1"   <?= $product['data']['numeric_size'] == '1'? 'selected':''; ?>        >1</option>
                            <option value="1 1/2" <?= $product['data']['numeric_size'] == '1 1/2'? 'selected':''; ?>  >1 1/2</option>
                            <option value="2" <?= $product['data']['numeric_size'] == '2'? 'selected':''; ?>          >2</option>
                            <option value="2 1/2" <?= $product['data']['numeric_size'] == '2 1/2'? 'selected':''; ?>  >2 1/2</option>
                            <option value="3" <?= $product['data']['numeric_size'] == '3'? 'selected':''; ?>          >3</option>
                            <option value="4" <?= $product['data']['numeric_size'] == '4'? 'selected':''; ?>        >4</option>
                        </select>
                    </div>

                    <div class="col-md-6 mb-3"id="grit" style="display: 

                <?= $product['data']['grit_size'] == '36' ||
                    $product['data']['grit_size'] == '60-100' ||
                    $product['data']['grit_size'] == '120-1500'||
                    $product['data']['grit_size'] == '2000'

                ? 'block':'none'; ?>;">

                        <label>Grit Size</label>
                        <select name="grit" id="" class="form-select">
                            <option value="" selected disabled>-- Select Grit Size --</option>
                            <option value="36" <?= $product['data']['grit_size'] == '36'? 'selected':''; ?> >36</option>
                            <option value="60-100" <?= $product['data']['grit_size'] == '60-100'? 'selected':''; ?>>60-100</option>
                            <option value="120-1500" <?= $product['data']['grit_size'] == '120-1500'? 'selected':''; ?> >120-1500</option>
                            <option value="2000" <?= $product['data']['grit_size'] == '2000'? 'selected':''; ?>  >2000</option>
                        </select>
                    </div>

                    <!-- <div class="col-md-6 mb-3"id="types" style="display: none;">
                        <label>Type</label>
                        <select name="type" id="" class="form-select">
                            <option value="" selected disabled>--Select Type --</option>
                            <option value="">Urethane</option>
                            <option value="">Acrilic</option>
                            <option value="">Latex</option>
                            <option value="">2000</option>
                        </select>
                    </div> -->

                    <div class="col-md-6 mb-3"id="color" style="display: 
                    
                <?= $product['data']['color'] == 'Blue' ||
                    $product['data']['color'] == 'Red' ||
                    $product['data']['color'] == 'Green' ||
                    $product['data']['color'] == 'Black'

                    ? 'block':'none'; ?>;">

                        <label>Color</label>
                        <select name="color" id="" class="form-select">
                            <option value="" selected disabled>--Select Color --</option>
                            <option value="Blue" <?= $product['data']['color'] == 'Blue'? 'selected':''; ?> >Blue</option>
                            <option value="Red" <?= $product['data']['color'] == 'Red'? 'selected':''; ?> >Red</option>
                            <option value="Green" <?= $product['data']['color'] == 'Green'? 'selected':''; ?> >Green</option>
                            <option value="Black" <?= $product['data']['color'] == 'Black'? 'selected':''; ?> >Black</option>
                        </select>
                    </div>
                    
            <!-- // -->

            <!-- this -->

            <?php if(
                    $product['data']['size'] != 'Small' ||
                    $product['data']['size'] != 'Medium' ||
                    $product['data']['size'] != 'Big'
            ):?>
            
            <div class="col-md-2 mb-3" id="csize" style="display: <?= $product['data']['size'] == '' ||
             $product['data']['size'] == 'Small' ||
             $product['data']['size'] == 'Medium' ||
             $product['data']['size'] == 'Big'
            ? 'none':'block'; ?>;">
                        <label>Size </label>
                        <input type="text" name="size2"  class="form-control" placeholder="ex. Small"
                        value="<?= $product['data']['size']; ?>"
                        >
                    </div>
            <?php else:?>
            <?php endif;?>

            <?php if($product['data']['numeric_size'] != '3/8' ||
                      $product['data']['numeric_size'] != '1/2' ||
                      $product['data']['numeric_size'] != '3/4' ||
                      $product['data']['numeric_size'] != '1' ||
                      $product['data']['numeric_size'] != '1 1/2' ||
                      $product['data']['numeric_size'] != '2' ||
                      $product['data']['numeric_size'] != '2 1/2' ||
                      $product['data']['numeric_size'] != '3' ||
                      $product['data']['numeric_size'] != '4' ):?>

                    <div class="col-md-2 mb-3"  id="cnumeriSize" style="display: <?= $product['data']['numeric_size'] == '' ||
                    $product['data']['numeric_size'] == '3/8' ||
                    $product['data']['numeric_size'] == '1/2' ||
                    $product['data']['numeric_size'] == '3/4' ||
                    $product['data']['numeric_size'] == '1' ||
                    $product['data']['numeric_size'] == '1 1/2' ||
                    $product['data']['numeric_size'] == '2' ||
                    $product['data']['numeric_size'] == '2 1/2' ||
                    $product['data']['numeric_size'] == '3' ||
                    $product['data']['numeric_size'] == '4'
                    ? 'none':'block'; ?>;">
                        <label>Numeric Size </label>
                        <input type="text" name="numeriSize2" class="form-control" placeholder="ex. 1 or 1/2"
                        value="<?= $product['data']['numeric_size']; ?>"
                        >
                    </div>

            <?php else:?>
            <?php endif;?>

            <?php if(  $product['data']['volume'] != '1 Bottle' ||
                        $product['data']['volume'] != '1/8 L' ||
                        $product['data']['volume'] != '1/4 L' ||
                        $product['data']['volume'] != '1/2 L' ||
                        $product['data']['volume'] != '1 L' ||
                        $product['data']['volume'] != '1 gal L'):?>

                    <div class="col-md-1 mb-3" id="cvolume" style="display: <?= $product['data']['volume'] == '' ||
                    $product['data']['volume'] == '1 Bottle' ||
                    $product['data']['volume'] == '1/8 L' ||
                    $product['data']['volume'] == '1/4 L' ||
                    $product['data']['volume'] == '1/2 L' ||
                    $product['data']['volume'] == '1 L' ||
                    $product['data']['volume'] == '1 gal L'
                    ? 'none':'block'; ?>;">
                        <label>Volume </label>
                        <input type="text" name="volume2"   class="form-control" placeholder="ex. 1gal"
                        value="<?= $product['data']['volume']; ?>"
                        >
                    </div>
            <?php else:?>
            <?php endif;?>
   
                    <div class="col-md-6 mb-3" id="ctype" style="display: <?= $product['data']['type'] == ''? 'none':'block'; ?>;">
                        <label>Type (any type)</label>
                        <input type="text" name="type2"  class="form-control" placeholder="ex. Latex or Gloss"
                        value="<?= $product['data']['type']; ?>"
                        >
                    </div>

            <?php if(   $product['data']['color'] != 'Blue' ||
                        $product['data']['color'] != 'Red' ||
                        $product['data']['color'] != 'Green' ||
                        $product['data']['color'] != 'Black'
                    ):?>  
                    <div class="col-md-3 mb-3" id="ccolor" style="display: <?= $product['data']['color'] == '' ||
                     $product['data']['color'] == 'Blue' ||
                     $product['data']['color'] == 'Red' ||
                     $product['data']['color'] == 'Green' ||
                     $product['data']['color'] == 'Black'
                    ? 'none':'block'; ?>;">
                        <label>Color </label>
                        <input type="text" name="color2"  class="form-control" placeholder="ex. Black"
                        value="<?= $product['data']['color']; ?>"
                        >
                    </div>
            <?php else:?>
            <?php endif;?>

            <?php if( $product['data']['grit_size'] != '36' ||
                      $product['data']['grit_size'] != '60-100' ||
                      $product['data']['grit_size'] != '120-1500' ||
                      $product['data']['grit_size'] != '2000'
                    ):?>
                    <div class="col-md-2 mb-3" id="cgrit"  style="display: <?= $product['data']['grit_size'] == '' ||
                    $product['data']['grit_size'] == '36' ||
                    $product['data']['grit_size'] == '60-100' ||
                    $product['data']['grit_size'] == '120-1500' ||
                    $product['data']['grit_size'] == '2000'
                    ? 'none':'block'; ?>;">
                        <label>Grit Size (sand paper)</label>
                        <input type="text" name="grit2"  class="form-control" placeholder="ex. 1000"
                        value="<?= $product['data']['grit_size']; ?>"
                        >
                    </div>
            <?php else:?>
            <?php endif;?>
     
            <!-- this -->
              <div class="col-md-6 mb-3">
                <label for="name">Image </label>
                <input type="file" name="image" value="<?= $product['data']['image']; ?>" class="form-control">
                <img src="<?= $product['data']['image']; ?>" value alt="img" style="height: 100px;">
              </div>

              <div class="col-md-1 mb-3">
                <label for="">Price <span style="color: red; font-weight: bold;">*</span></label>
                <input type="text" name="price" value="<?= $product['data']['price']; ?>" required class="form-control">
              </div>

              <div class="col-md-1 mb-3">
                <label for="">Quantity <span style="color: red; font-weight: bold;">*</span></label>
                <input type="text" name="quantity" value="<?= $product['data']['quantity']; ?>" required class="form-control">
              </div>

              <div class="col-md-12 mb-3 text-end">
                <button type="submit" name="updateProduct" class="btn btn-primary">Update</button>
              </div>

            </div>



        <?php

          } else {
            echo '<h5>' . $product['message'] . '</h5>';
            return false;
          }
        } else {

          echo '<h5>Something Went Wrong</h5>';
          return false;
        }


        ?>


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