<!DOCTYPE html>
<html lang="en">
<?php
$attempts = isset($_SESSION['otp_attempts']);

?>
<head>
    <meta charset="utf-8">
    <title>OTP Form</title>
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        inter: ['Inter', 'sans-serif'],
                    },
                },
            },
        };
    </script>
    <link rel="stylesheet" href="system/local-cdn/alertify.min.css">
</head>

<body class="relative font-inter antialiased">

    <main class="relative min-h-screen flex flex-col justify-center bg-slate-50 overflow-hidden" style="
    background-repeat: no-repeat;
    background-size: cover;
    background-image: url('system/images/loginbackground.jpg');
    ">
        <div class="w-full max-w-6xl mx-auto px-4 md:px-6 py-24">
            <div class="flex justify-center">

                <div class="max-w-md mx-auto text-center bg-white px-4 sm:px-8 py-10 rounded-xl shadow">
                    <header class="mb-8">
                        <h1 class="text-2xl font-bold mb-1">OTP Verification</h1>
                        <p class="text-[15px] text-slate-500">Enter the 6-digit verification code that was sent to your email account. 3 attempts for 1 minute</p>
                    
                    </header>
                    <form id="otp-form" method="POST" action="otp/show.php">
                        <div class="flex items-center justify-center gap-3">
                            <input
                                name="1"
                                type="text"
                                class="w-14 h-14 text-center text-2xl font-extrabold text-slate-900 bg-slate-100 border border-transparent hover:border-slate-200 appearance-none rounded p-4 outline-none focus:bg-white focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100"
                                pattern="\d*" maxlength="1" />
                            <input
                                name="2"
                                type="text"
                                class="w-14 h-14 text-center text-2xl font-extrabold text-slate-900 bg-slate-100 border border-transparent hover:border-slate-200 appearance-none rounded p-4 outline-none focus:bg-white focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100"
                                maxlength="1" />
                            <input
                                name="3"
                                type="text"
                                class="w-14 h-14 text-center text-2xl font-extrabold text-slate-900 bg-slate-100 border border-transparent hover:border-slate-200 appearance-none rounded p-4 outline-none focus:bg-white focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100"
                                maxlength="1" />
                            <input
                                name="4"
                                type="text"
                                class="w-14 h-14 text-center text-2xl font-extrabold text-slate-900 bg-slate-100 border border-transparent hover:border-slate-200 appearance-none rounded p-4 outline-none focus:bg-white focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100"
                                maxlength="1" />
                            <input
                                name="5"
                                type="text"
                                class="w-14 h-14 text-center text-2xl font-extrabold text-slate-900 bg-slate-100 border border-transparent hover:border-slate-200 appearance-none rounded p-4 outline-none focus:bg-white focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100"
                                maxlength="1" />
                            <input
                                name="6"
                                type="text"
                                class="w-14 h-14 text-center text-2xl font-extrabold text-slate-900 bg-slate-100 border border-transparent hover:border-slate-200 appearance-none rounded p-4 outline-none focus:bg-white focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100"
                                maxlength="1" />
                        </div>
                        <div class="max-w-[260px] mx-auto mt-4">
                            <button type="submit"
                                name="submit"
                                style="
                                 background-image: url('system/images/bklogin.jpg');
                                " 
                                class="w-full inline-flex justify-center whitespace-nowrap rounded-lg bg-indigo-500 px-3.5 py-2.5 text-sm font-medium text-white shadow-sm shadow-indigo-950/10 hover:bg-indigo-600 focus:outline-none focus:ring focus:ring-indigo-300 focus-visible:outline-none focus-visible:ring focus-visible:ring-indigo-300 transition-colors duration-150">Verify
                                Account</button>

                                <?php
                                echo $_SESSION['otp'];
                                ?>

                        </div>
                    </form>
                    <!-- <div class="text-sm text-slate-500 mt-4">Didn't receive code? <a class="font-medium text-indigo-500 hover:text-indigo-600" href="#0">Resend</a></div> -->
                </div>
                <script>
                document.addEventListener("DOMContentLoaded", function() {
                        alertify.set('notifier', 'position', 'top-right');
                                <?php
                        if($attempts > 0){
                            echo "alertify.warning('Wrong OTP');";
                        }
                        ?>
                });

                
                
                        function countdown(seconds) {
                        let timer = setInterval(function() {
                            if (seconds > 0) {
                            console.log(seconds);
                            seconds--;
                            } else {
                            clearInterval(timer);
                            // console.log("Run out of times");
                            alertify.error("Time's up!");
                            window.location.href = "logout.php";
                            }
                        }, 1000);
                        }

                        countdown(60);

                    document.addEventListener('DOMContentLoaded', () => {
                        const form = document.getElementById('otp-form')
                        const inputs = [...form.querySelectorAll('input[type=text]')]
                        const submit = form.querySelector('button[type=submit]')

                        const handleKeyDown = (e) => {
                            if (
                                !/^[0-9]{1}$/.test(e.key)
                                && e.key !== 'Backspace'
                                && e.key !== 'Delete'
                                && e.key !== 'Tab'
                                && !e.metaKey
                            ) {
                                e.preventDefault()
                            }

                            if (e.key === 'Delete' || e.key === 'Backspace') {
                                const index = inputs.indexOf(e.target);
                                if (index > 0) {
                                    inputs[index - 1].value = '';
                                    inputs[index - 1].focus();
                                }
                            }
                        }

                        const handleInput = (e) => {
                            const { target } = e
                            const index = inputs.indexOf(target)
                            if (target.value) {
                                if (index < inputs.length - 1) {
                                    inputs[index + 1].focus()
                                } else {
                                    submit.focus()
                                }
                            }
                        }

                        const handleFocus = (e) => {
                            e.target.select()
                        }

                        const handlePaste = (e) => {
                            e.preventDefault()
                            const text = e.clipboardData.getData('text')
                            if (!new RegExp(`^[0-9]{${inputs.length}}$`).test(text)) {
                                return
                            }
                            const digits = text.split('')
                            inputs.forEach((input, index) => input.value = digits[index])
                            submit.focus()
                        }

                        inputs.forEach((input) => {
                            input.addEventListener('input', handleInput)
                            input.addEventListener('keydown', handleKeyDown)
                            input.addEventListener('focus', handleFocus)
                            input.addEventListener('paste', handlePaste)
                        })
                    })                        
                </script>

            </div>
        </div>
    </main>
<script src="system/local-cdn/alertify.min.js"></script>
</body>

</html>