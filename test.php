
<?php
$cdnLinks = [
  "https://cdn.lineicons.com/4.0/lineicons.css",
  "https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css",
  "https://kit.fontawesome.com/a2ecc89c01.js",
  "https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css",
  "https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css",
  "https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css",
];
$cdn = false;
foreach ($cdnLinks as $cdnLink) {
  $content = @file_get_contents($cdnLink); // Attempt to read the content of the file
  if ($content !== false) {

    // echo 'Working ' . $cdnCssLink. '<br>'; 

  } else {
    // echo 'Failed ' . $cdnCssLink. '<br>';

    break;
  }
}


?>

<script>
  
document.getElementById('fullscreen').addEventListener('click', function() {
  if (document.fullscreenElement) {
      exitFullscreen();
  } else {
      enterFullscreen();
  }
});

</script>

                    $product['data']['volume'] != '1 Bottle' &&
                    $product['data']['volume'] != '1/8 L' &&
                    $product['data']['volume'] != '1/4 L' &&
                    $product['data']['volume'] != '1/2 L' &&
                    $product['data']['volume'] != '1 L' &&
                    $product['data']['volume'] != '1 gal L' &&

                    $product['data']['size'] != 'Small' &&
                    $product['data']['size'] != 'Medium' &&
                    $product['data']['size'] != 'Big' &&

                    $product['data']['numeric_size'] != '3/8' &&
                    $product['data']['numeric_size'] != '1/2' &&
                    $product['data']['numeric_size'] != '3/4' &&
                    $product['data']['numeric_size'] != '1' &&
                    $product['data']['numeric_size'] != '1 1/2' &&
                    $product['data']['numeric_size'] != '2' &&
                    $product['data']['numeric_size'] != '2 1/2' &&
                    $product['data']['numeric_size'] != '3' &&
                    $product['data']['numeric_size'] != '4' &&

                    $product['data']['grit_size'] != '36' &&
                    $product['data']['grit_size'] != '60-100' &&
                    $product['data']['grit_size'] != '120-1500' &&
                    $product['data']['grit_size'] != '2000' &&

                    $product['data']['color'] != 'Blue' &&
                    $product['data']['color'] != 'Red' &&
                    $product['data']['color'] != 'Green' &&
                    $product['data']['color'] != 'Black'