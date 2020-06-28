<?php

/*
 * Please see license.txt for information about the origional creator of this
 * php document.
 */

// Open session to grab vars
session_start();

//Session vars setup
if ($_GET['id']) {
  $_SESSION['id'] = $_GET['id'];
} else {
  echo "Direct Access is not allowed";
  exit();
}

if ($_GET['url']) {
  $_SESSION['url'] = $_GET['url'];
} else {
  $_SESSION['url'] = 'https://google.com';
}

?>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
    <title>Guest Wifi</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <script src="./js/jquery-3.4.0.min.js"></script>
    <script src="./js/popper.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>
    <link rel="icon" type="image/x-icon" href="images/favicon.ico" />
</head>

<body class="bg-dark">

    <div id="container" class="container">
        <!-- Begin Hero -->
        <div class="row py-4 justify-content-md-center bg-warning">
            <div class="col-lg-auto text-center">
                <img class="rounded-circle" src="images/200x200.png">
                <h1>Welcome to example guest wifi</h1>
                <div class="row justify-content-md-center">
                    <p class="col-lg-6 text-center">
                        Say somthing about your company here.
                    </p>
                </div>
            </div>
        </div>
        <!-- End Hero -->

        <div class="row py-3 justify-content-md-center bg-white">
            <!-- begin form -->
            <div class="col-sm-3 bg-dark rounded py-3 px-3 mx-3">
                <form id="my-form" method="POST" action="authorize.php" onsubmit="submit.value = 'Connecting...'; submit.disabled = true; return true;">
                    <div id="data-collector">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="First name" name="first-name" required>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Last name" name="last-name" required>
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control" id="email" placeholder="Email" name="email"
                                required>
                        </div>
                    </div>
                    <div class="form-group form-check">
                        <label class="form-check-label text-light">
                            <input class="form-check-input" type="checkbox" name="agree" required>Accept TOS and Privacy
                            policy
                        </label>
                    </div>
                    <div class="form-group form-check">
                        <label class="form-check-label text-light">
                            <input id="opt-in" checked onclick="IsInputRequired()" class="form-check-input" type="checkbox" name="newsletter">
                            Receive our newsletter and product offerings via email
                        </label>
                    </div>
                    <input name="submit" type="submit" value="Connect" class="btn btn-primary float-right" />
                </form>
            </div>
            <!-- begin tos and privacy policy -->
            <div class="col-md-6 bg-light">
                <h3>
                    Terms of Service
                </h3>
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                </p>            
            </div>
        </div>
        <footer>
        <div class="row justify-content-md-center">
            <div class="col-md-6 text-center text-light bg-dark">
                <p>Copyright © www.example.com 2020</p>
            </div>
        </div>
    </footer>
    </div>


    <script>
        // Function tests if opt-in checkbox is checked, and disables required fields if it is not.
        function IsInputRequired() {
            const container = document.getElementById('container')
            const inputs = container.getElementsByTagName("input");
            let optIn = document.getElementById('opt-in')

            if (!optIn.checked) {
                for (i = 0; i < inputs.length; ++i) {
                    if (inputs[i].type == 'email' || inputs[i].type == 'text') {
                        inputs[i].disabled = true;
                    }
                }
            }
            else {
                for (i = 0; i < inputs.length; ++i) {
                    if (inputs[i].type == 'email' || inputs[i].type == 'text') {
                        inputs[i].disabled = false;
                    }
                }
            }
        }
    </script>
</body>

</html>