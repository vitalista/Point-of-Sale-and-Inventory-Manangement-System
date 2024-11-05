<!DOCTYPE html>
<html lang="en">
    <head>
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <script src="https://kit.fontawesome.com/a2ecc89c01.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link href="system/css/style.css" rel="stylesheet">
    <title>Login - M&J Paint Enterprises</title>
    <script>

        function setFavicon(iconClass) {
            var link = document.createElement('link');
            link.rel = 'icon';
            link.type = 'image/x-icon';
            link.href = 'data:image/svg+xml,' + encodeURIComponent('<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><text x="10" y="70" font-family="Arial" font-size="70" font-weight="bold" fill="white">' + iconClass + '</text></svg>');
            document.head.appendChild(link);
        }
        setFavicon('MJ'); 
    </script>
</head>

<body>
<?php

$_SESSION['otp'] = 123456;

?>
    <div class="container-fluid">

        <form class="loginForm" action="login-code.php" method="post" id="otpForm">

            <h4 class="text-center">Login</h4>
            <div class="mb-3 mt-3 d-flex align-items-center">
                <h3><i class="fas fa-user mr-4"></i></h3>
                <input type="text" class="form-control ml-2" id="email" name="email" placeholder="Email" onkeyup="this.setAttribute('value', this.value);" required>
            </div>

            <div class="mb-3 mt-3 d-flex align-items-center">
                <h3><i class="fas fa-key mr-4"></i></h3>
                <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
            </div>

            <button type="submit" class="btn btn-primary" name="submit" value="set">Login</button>
        </form>


    </div>

</body>

</html>

