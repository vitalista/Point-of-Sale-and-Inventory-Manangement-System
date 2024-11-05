<?php
include('function.php');
include ('kick.php');

//Save User
if(isset($_POST['saveUser'])){
    $name = validate($_POST['name']);
    $email = validate($_POST['email']);
    $password = validate($_POST['password']);
    $phone = validate($_POST['phone']);
    $is_ban = isset($_POST['is_ban']) == true ? 1 : 0;

    $create = isset($_POST['create']) == true ? 1 : 0;
    $edit = isset($_POST['edit']) == true ? 1 : 0;
    $delete = isset($_POST['delete']) == true ? 1 : 0;

    if($name != '' && $email != '' && $password != ''){

        $emailCheck = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
        if(mysqli_num_rows($emailCheck) > 0){
            redirect('../users-create.php', 'Email Already used by another user.');    
        } else {
            $bcrypt_password = password_hash($password, PASSWORD_BCRYPT);

            $data = [
                'name' => $name,
                'email' => $email,
                'password' => $bcrypt_password,
                'phone' => $phone,
                'is_ban' => $is_ban,
                'user_role' => 'USER', //To insert new Admin change this

                'can_create' => $create,
                'can_edit' => $edit,
                'can_delete' => $delete

            ];

            $result = insert('users', $data);
            if($result){
                redirect('../users.php', 'User Created Successfully');      
            }else{
                redirect('../users-create.php', 'Something Went Wrong');          
            }
        }
    } else {
        redirect('../users-create.php', 'Please Fill Required Fields.');
    }
}

//Update User Needs to configure email logic
if(isset($_POST['updateUser'])){

  $adminId = validate($_POST['userId']);

  $adminData = getById('users',$adminId);
  if($adminData['status'] != 200){

    redirect('../users-edit.php?id='.$adminId ,'Please fill required fields');

  }

  $name = validate($_POST['name']);
    $email = validate($_POST['email']);
    $password = validate($_POST['password']);
    $phone = validate($_POST['phone']);
    $is_ban = isset($_POST['is_ban']) == true ? 1 : 0;

    $create = isset($_POST['create']) == true ? 1 : 0;
    $edit = isset($_POST['edit']) == true ? 1 : 0;
    $delete = isset($_POST['delete']) == true ? 1 : 0;

  $user_role = validate($_POST['user_role']);


    if($password != ''){

      $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    }else{

      $hashedPassword = $adminData['data']['password'];

    }

    if($name != '' && $email != ''){

      $data = [
        'name' => $name,
        'email' => $email,
        'password' => $hashedPassword,
        'phone' => $phone,
        'is_ban' => $is_ban,
        'user_role' => $user_role,

        'can_create' => $create,
        'can_edit' => $edit,
        'can_delete' => $delete
    ];

    $result = update('users',$adminId, $data);
    if($result){
      if($_SESSION['LoggedInUser']['user_role'] == 'ADMIN'){
        redirect('../users-edit.php?id='.$adminId , 'Admin Updated Successfully');
      }else{
        redirect('../users-edit.php?id='.$adminId , 'User Updated Successfully');
      }
            
    }else{
        redirect('../users-edit.php?id='.$adminId , 'Something Went Wrong');          
    }

    }
    else  {
      redirect('../users-create.php','Please fill required fields.');
    }
    
}

// Categories

if(isset($_POST['saveCategory'])){
 $name = validate($_POST['name']);
  $description = validate($_POST['description']);
  $data = [
    'name' => $name,
    'description' => $description,
  ];

  $result = insert('categories',$data);

  if($result){
     redirect('../categories.php', 'Category Created Successfully');      
  }else{
      redirect('../categories-create.php', 'Something Went Wrong');          
  }

}

if(isset($_POST['updateCategory'])){

  $categoryID = validate($_POST['categoryID']);
  $name = validate($_POST['name']);
  $description = validate($_POST['description']);

  $data = [
    'name' => $name,
    'description' => $description,
  ];

  $result = update('categories', $categoryID, $data);

  if($result){
    redirect('../categories-edit.php?id='.$categoryID, 'Category Updated Successfully');      
  }else{
      redirect('../categories-edit.php?id='.$categoryID, 'Something Went Wrong');          
  }
}

//product

  if(isset($_POST['saveProduct'])){

      $category_id = validate($_POST['category_id']);
      $name = validate($_POST['name']);
      $description = validate($_POST['description']);

      $price = validate($_POST['price']);
      $quantity = validate($_POST['quantity']);

      $prodCode = validate($_POST['prodCode']);

      $checkProdCode = mysqli_query($conn, "SELECT * FROM products WHERE product_code='$prodCode' LIMIT 1");
      if(mysqli_num_rows($checkProdCode) > 0){
        redirect('../products-create.php', 'Product Code Already Exist');
      }else{


          //conditions for 2divs
            if(!empty($_POST['volume'])){
              $volume = validate($_POST['volume']);
            }else{
              $volume = validate($_POST['volume2']);
            }

            if(!empty($_POST['numericSize'])){
              $numeriSize = validate($_POST['numericSize']);
            }else{
              $numeriSize = validate($_POST['numericSize2']);
            }

            if(!empty($_POST['size'])){
              $size = validate($_POST['size']);
            }else{
              $size = validate($_POST['size2']);
            }

            if(!empty($_POST['grit'])){
              $grit = validate($_POST['grit']);
            }else{
              $grit = validate($_POST['grit2']);
            }
          
              // if(!empty($_POST['type'])){
              //   $type = validate($_POST['type']);
              // }else{
              //   $type = validate($_POST['type2']);
              // }

              if(!empty($_POST['color'])){
                $color = validate($_POST['color']);
              }else{
                $color = validate($_POST['color2']);
              }
          //conditions for 2divs
        
      //////////////////////////////
      if (isset($_FILES['image']) && $_FILES['image']['size'] > 0 && $_FILES['image']['size'] < 100000) {
      
        $allowed_types = array('image/jpeg', 'image/png', 'image/gif');
        if (!in_array($_FILES['image']['type'], $allowed_types)) {
            //alert 
        }

        
        $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);// extracts extension


        $tmp_name = $_FILES['image']['tmp_name']; // tmp_name = C:\xampp\tmp\

        // Generate timestamp filename
        $finalfilename = time().'.'. $ext;
        $upload_dir = '../../img/'; //exit one code.php exit two admin locate img img 
        $sqlimag = '../img/';
        $sqlPathNName = $sqlimag.$finalfilename;


        if (move_uploaded_file($tmp_name, $upload_dir .$finalfilename)) {
            
        } else {
            //"Error uploading file"
        }
    }
      //



        $data = [
          'category_id' => $category_id,
          'name' => $name,
          'description' => $description,
          'price' => $price,
          'quantity' => $quantity,
          'image' => $sqlPathNName,
      
          'product_code' => $prodCode,

          'size' => $size,
          'numeric_size' => $numeriSize,
          'volume' => $volume,
          'grit_size' => $grit,
          'type' => $type,
          'color' => $color,
        ];

     

      $result = insert('products',$data);


      if($result){

        redirect('../products.php', 'Product Created Successfully');   
          

    }else{
        redirect('../products-create.php', 'Something Went Wrong');          
    }
  }
}

  ////////////////////////////////////////////////////////////////////
if(isset($_POST['updateProduct'])){

  $product_id = validate($_POST['product_id']);

  $productData = getById('products', $product_id);

  if(!$product_id){
    redirect('../products.php', 'No Search Product Found');
  }

  $category_id = validate($_POST['category_id']);
  $name = validate($_POST['name']);
  $description = validate($_POST['description']);

  $price = validate($_POST['price']);
  $quantity = validate($_POST['quantity']);

  //
  if (isset($_FILES['image']) && $_FILES['image']['size'] > 0 && $_FILES['image']['size'] < 100000) {
   
    $allowed_types = array('image/jpeg', 'image/png', 'image/gif');
    if (!in_array($_FILES['image']['type'], $allowed_types)) {
        //alert 
    }

    
     $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);// extracts extension


     $tmp_name = $_FILES['image']['tmp_name']; // tmp_name = C:\xampp\tmp\

    // Generate timestamp filename
    $finalfilename = time().'.'. $ext;
    $upload_dir = '../../img/'; //exit one code.php exit two admin locate img img outside
    $sqlimag = '../img/';
    $sqlPathNName = $sqlimag.$finalfilename;

    $uploadImg = move_uploaded_file($tmp_name, $upload_dir .$finalfilename);

    if ($uploadImg) {
        
    } else {
        //"Error uploading file"
    }
  }

  $deleteImage = $productData['data']['image'];
  if(file_exists('../'.$deleteImage)){
  unlink($deleteImage);
  }

    //
    $data = [
      'category_id' => $category_id,
      'name' => $name,
      'description' => $description,
      'price' => $price,
      'quantity' => $quantity,
      'image' => $sqlPathNName,
    ];

    $result = update('products',$product_id,$data);

    if($result){
      redirect('../products-edit.php?id='.$product_id, 'Product Updated Successfully');      
  }else{
      redirect('../products-edit.php?id='.$product_id, 'Something Went Wrong');          
  }

}
/////////

// Customer
if(isset($_POST['saveCustomer'])){

  $name = validate($_POST['name']);
  $email = validate($_POST['email']);
  $phone = validate($_POST['phone']);

  if($name != ''){

    $emailCheck = mysqli_query($conn, "SELECT * FROM customers WHERE email='$email'");

    if($emailCheck){

      if(mysqli_num_rows($emailCheck) > 0 ){
        redirect('../customers.php','Email Already Used');
      }

    }

    $data = [
      'name' => $name,
      'email' => $email,
      'phone' => $phone,
    ];


    $result = insert('customers',$data);
    if($result){

      redirect('../customers.php','Customer Created Successfully');

    }else{

      redirect('../customers.php','Something Went wrong');

    }


  }else{
    redirect('../customers.php','Please fill required fields');
  }



}

if(isset($_POST['updateCustomer'])){

  $customerId = validate($_POST['customer_id']);


  $name = validate($_POST['name']);
  $email = validate($_POST['email']);
  $phone = validate($_POST['phone']);

  if($name != ''){

    $query = "SELECT * FROM customers  WHERE email='$email' AND id!='$customerId'";

    $emailCheck = mysqli_query($conn, $query);

    if($emailCheck){

      if(mysqli_num_rows($emailCheck) > 0 ){
        redirect('../customers-edit.php?id='.$customerId, 'Email Already Used');
      }

    }

    $data = [
      'name' => $name,
      'email' => $email,
      'phone' => $phone,

    ];


    $result = update('customers', $customerId , $data);

    if($result){

      redirect('../customers-edit.php?id='.$customerId, 'Customer Updated Successfully');

    }else{

      redirect('../customers-edit.php?id='.$customerId, 'Something Went wrong');

    }


  }else{
    redirect('../customers-edit.php?id='.$customerId, 'Please fill required fields');
  }  

}


if(isset($_POST['saveSupplier'])){

  $name = validate($_POST['name']);
  $email = validate($_POST['email']);
  $phone = validate($_POST['phone']);

  if($name != '' && $phone != ''){

    $emailCheck = mysqli_query($conn, "SELECT * FROM suppliers WHERE email='$email'");

    if($emailCheck){

      if(mysqli_num_rows($emailCheck) > 0 ){
        redirect('../suppliers.php','Email Already Used');
      }

    }

    $data = [
      'name' => $name,
      'email' => $email,
      'phone' => $phone,
    ];


    $result = insert('suppliers',$data);
    if($result){

      redirect('../suppliers.php','Supplier Created Successfully');

    }else{

      redirect('../suppliers.php','Something Went wrong');

    }


  }else{
    redirect('../suppliers.php','Please fill required fields');
  }
}

if(isset($_POST['updateSupplier'])){

  $supplierId = validate($_POST['supplier_id']);


  $name = validate($_POST['name']);
  $email = validate($_POST['email']);
  $phone = validate($_POST['phone']);

  if($name != '' && $phone != ''){

    $query = "SELECT * FROM suppliers  WHERE email='$email' AND id!='$supplierId'";

    $emailCheck = mysqli_query($conn, $query);

    if($emailCheck){

      if(mysqli_num_rows($emailCheck) > 0 ){
        redirect('../suppliers-edit.php?id='.$supplierId, 'Email Already Used');
      }

    }

    $data = [
      'name' => $name,
      'email' => $email,
      'phone' => $phone,

    ];


    $result = update('suppliers', $supplierId , $data);

    if($result){

      redirect('../suppliers-edit.php?id='.$supplierId, 'Supplier Updated Successfully');

    }else{

      redirect('../suppliers-edit.php?id='.$supplierId, 'Something Went wrong');

    }


  }else{
    redirect('../suppliers-edit.php?id='.$supplierId, 'Please fill required fields');
  }  

}

?>
