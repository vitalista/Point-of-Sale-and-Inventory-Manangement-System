
function sendOTP(email) {
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "otp/sendOTP.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                window.location.href = "index2.php";
            } else {
                // document.getElementById("otpStatus").innerHTML = xhr.responseText;
               console.log(xhr.responseText);
               window.location.href = "index.php";
            }
        }
    };
    xhr.send("email=" + email);
}

