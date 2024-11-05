
//sidebar toggle button
const hamBurger = document.querySelector(".toggle-btn");

hamBurger.addEventListener("click", function () {
  document.querySelector("#sidebar").classList.toggle("expand");
});

$(document).ready(function() {
  $('.mySelect2').select2();
});

//reload button
document.getElementById('refresh').addEventListener('click', function() {
  location.reload();
});

$(document).ready(function () {

  alertify.set('notifier', 'position', 'top-right');
  //alert('hi');


  // if ($('.increment').length === 0 || $('.decrement').length === 0) {
  //   console.error('Elements with classes "increment" and "decrement" not found.');
  //   return; // Prevent further execution if they're missing
  // }

  $(document).on('click', '.increment', function () {
    var $quantityInput = $(this).closest('.qtyBox').find('.qty');
    var productId = $(this).closest('.qtyBox').find('.prodId').val();

    var currentValue = parseInt($quantityInput.val());

    if (!isNaN(currentValue) && currentValue >= 0) {
      var qtyVal = currentValue + 1;
      $quantityInput.val(qtyVal);

      quantityIncDec(productId, qtyVal);

    } else {
      // Optional: Handle cases where currentValue is NaN or <= 1
      console.warn('Cannot increment quantity further.');
    }
  });

  // Fix the logic error in the decrement function
  $(document).on('click', '.decrement', function () {
    var $quantityInput = $(this).closest('.qtyBox').find('.qty');
    var productId = $(this).closest('.qtyBox').find('.prodId').val();

    var currentValue = parseInt($quantityInput.val());

    if (!isNaN(currentValue) && currentValue > 1) {
      var qtyVal = currentValue - 1;
      $quantityInput.val(qtyVal);
      quantityIncDec(productId, qtyVal);

    } else {
      // Optional: Handle cases where currentValue is NaN or <= 1
      //console.warn('Cannot decrement quantity further.');
      window.location.reload();
    }
  });



  function quantityIncDec(prodId, qty) {
    $.ajax({
      type: "POST",
      url: "orders-code.php",
      data: {
        productIncDec: true,
        product_id: prodId,
        quantity: qty
      },
      success: function (response) {
        var res = JSON.parse(response);

        var delayInMilliseconds = 1500;

        if (res.status === 200) {

          setTimeout(function () {
            window.location.reload();
          }, delayInMilliseconds);

          alertify.success(res.message, { delay: 5000 }); // 5 seconds



        } else {
          alertify.error(res.message);
        }
      }
    });
  }

  // proceed to place order button click
  $(document).on('click', '.proceedToPlace', function () {
    var payment_mode = $('#payment_mode').val();
    var cphone = $('#cphone').val();
    if (payment_mode == '') {
      swal("Select Payment Mode", "Select your payment mode", "warning");
      return false;
    }

    if (cphone == '' && !$.isNumeric(cphone)) {
      swal("Enter Phone Number", "Enter Valid Phone Number", "warning");
      return false;
    }

    var data = {
      'proceedToPlaceBtn': true,
      'cphone': cphone,
      'payment_mode': payment_mode,
    };

    $.ajax({
      type: "POST",
      url: "orders-code.php",
      data: data,
      success: function (response) {


        var res = JSON.parse(response);
        if (res.status == 200) {
          window.location.href = "order-summary.php";
        }
        else if (res.status == 404) {
          swal(res.message, res.message, res.status_type, {
            buttons: {
              catch: {
                text: "Add Customer",
                value: "catch"
              },
              cancel: "Cancel"
            }
          })
            .then((value) => {

              switch (value) {

                case "catch":

                  $('#c_phone').val(cphone);
                  $('#addCustomerModal').modal('show');
                  //console.log('Pop the customer add modal');
                  break;

                default:

              }

            });
        } else {
          swal(res.message, res.message, res.status_type);
        }


      }// success
    });

  });

  $(document).ready(function(){
    $("#showModalBtn").click(function(){
      $('#addCustomerModal').modal('show');
    });
  });

  //add customer to database using modal
  $(document).on('click', '.saveCustomer', function () {

    var c_name = $('#c_name').val();
    var c_phone = $('#c_phone').val();
    var c_email = $('#c_email').val();

    if (c_name != '' && c_phone != '') {

      if ($.isNumeric(c_phone)) {

        var datta = {

          'saveCustomerBtn': true,
          'name': c_name,
          'phone': c_phone,
          'email': c_email,

        };

        $.ajax({
          type: "POST",
          url: "orders-code.php",
          data: datta,
          success: function (response) {

            var res = JSON.parse(response);
            if (res.status == 200) {

              swal(res.message, res.message, res.status_type);
              $('#addCustomerModal').modal('hide');
            } else if (res.status == 422) {

              swal(res.message, res.message, res.status_type);

            }

            else {
              swal(res.message, res.message, res.status_type);

            }

          }
        });



      } else {
        swal("Enter Valid Phone Number", "", "warning");
      }

    } else {
      swal("Please fill required filds", "", "warning");
    }


  });

  // the simplest ajax js code
  $(document).on('click', '#saveOrder', function () {

    $.ajax({

      type: "POST",
      url: "orders-code.php",
      data: {
        'saveOrder': true
      },

      success: function (response) {

        var res = JSON.parse(response);

        if (res.status == 200) {

          swal(res.message, res.message, res.status_type);
          $('#orderPlaceSuccessMessage').text(res.message);
          $('#orderSuccessModal').modal('show');



        } else {

          swal(res.message, res.message, res.status_type);


        }

      }

    });

  });



});

function printMyBillingArea() {

    var divContents = document.getElementById("myBillingArea").innerHTML;
    var a = window.open('', '');
    a.document.write('<html><title>POS and Inventory System</title>');
    a.document.write('<body style="font-family: fangsong;">');
    a.document.write(divContents);
    a.document.write('</body></html>');
    a.document.close();
    a.print();
}


window.jsPDF = window.jspdf.jsPDF;
var docPDF = new jsPDF();

function downloadPDF(invoiceNum) {

    var elementHTML = document.querySelector("#myBillingArea");

    docPDF.html(elementHTML, {

      callback: function () {
        docPDF.save(invoiceNum + '.pdf');
      },
      x: 15,
      y: 15,
      width: 170,
      windowWidth: 650

    });


}

$("#fullscreen").on("click", function toggleFullScreen() {
  if ((document.fullScreenElement !== undefined && document.fullScreenElement === null) || (document.msFullscreenElement !== undefined && document.msFullscreenElement === null) || (document.mozFullScreen !== undefined && !document.mozFullScreen) || (document.webkitIsFullScreen !== undefined && !document.webkitIsFullScreen)) {
    if (document.documentElement.requestFullScreen) {
      document.documentElement.requestFullScreen();
    } else if (document.documentElement.mozRequestFullScreen) {
      document.documentElement.mozRequestFullScreen();
    } else if (document.documentElement.webkitRequestFullScreen) {
      document.documentElement.webkitRequestFullScreen(Element.ALLOW_KEYBOARD_INPUT);
    } else if (document.documentElement.msRequestFullscreen) {
      document.documentElement.msRequestFullscreen();
    }
  } else {
    if (document.cancelFullScreen) {
      document.cancelFullScreen();
    } else if (document.mozCancelFullScreen) {
      document.mozCancelFullScreen();
    } else if (document.webkitCancelFullScreen) {
      document.webkitCancelFullScreen();
    } else if (document.msExitFullscreen) {
      document.msExitFullscreen();
    }
  }
})

function showPassword() {
  var x = document.getElementById("userInput");
  if (x.type === "password") {
      x.type = "text";
  } else {
      x.type = "password";
  }
}

var button = document.getElementById("gear");
var button1 = document.getElementById("gear1");


var div = document.getElementById("fixDiv");
var div1 = document.getElementById("fixDiv1");
var div2 = document.getElementById("fixDiv2");
var div3 = document.getElementById("fixDiv3");

var div4 = document.getElementById("fixDiv4");

if (button) { // Check if the button element exists
    button.addEventListener("click", function() {
        if (div.style.display === "none" && div1.style.display === "none" && div2.style.display === "none" && div3.style.display === "none") {
            div.style.display = "block";
            div1.style.display = "block";
            div2.style.display = "block";
            div3.style.display = "block";
        } else {
            div.style.display = "none";
            div1.style.display = "none";
            div2.style.display = "none";
            div3.style.display = "none";
        }
    });
}

if (button1) { // Check if the button element exists
  button1.addEventListener("click", function() {
      if (div4.style.display === "none") {
          div4.style.display = "block";
      } else {
          div4.style.display = "none";
      }
  });
}