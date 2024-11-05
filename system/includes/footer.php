
</div>

<br>
<br>
<br>
<br>
<br>

<div>
<?php include('includes/foot.php'); ?>
</div>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<?php if (hasInternet()) { ?>

<!-- <source/bootstrap> -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
<!-- select2 -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<!-- alertify -->
<script src="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
<!-- jscdn pdf link -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js" integrity="sha512-BNaRQnYJYiPSqHHDb58B0yaPfCu+Wgds8Gp/gU33kqBtgNS4tSPHuGibyoeqMV/TJlSKda6FXzoEyYGjTe+vXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js" integrity="sha512-qZvrmS2ekKPF2mSznTQsxqPgnpkI4DNTlrdUmTzrDgektczlKNRRhy5X5AAOnx5S09ydFYWWNSfcEqDTTHgtNA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!-- jscdn pdf link -->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


<?php } else { ?>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="local-cdn/jquery.js"></script>
<script src="local-cdn/bootstrap.bundle.min.js"></script>
<script src="local-cdn/select2.min.js"></script>
<script src="local-cdn/alertify.min.js"></script>
<script src="local-cdn/html2canvas.min.js"></script>
<script src="local-cdn/jspdf.umd.min.js"></script>
<script src="local-cdn/sweetalert.min.js"></script>
<?php } ?>

<!-- system main js code -->
<script src="js/custom.js"></script>

</body>

</html>

<?php
$page = substr($_SERVER['SCRIPT_NAME'], strrpos($_SERVER['SCRIPT_NAME'], "/") +1);
if($page == 'footer.php'){
echo '<script>window.location.href = "index.html"; </script>';
}
?>