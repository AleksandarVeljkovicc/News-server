<?php
require_once("inc/sessionStart.php")
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation page</title>
    <link type="text/css" rel="stylesheet" href="css/mainpage_css.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css"/>   <!--eliminise podrazumevanu marginu u browser-u-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">  <!--da bi mogle da se koriste ikonice za drustvene mreze-->
</head>
<body>
        <div>
            <?php
            require_once("inc/header.php");
            ?>
               <main>
                <div id="main_div_container">
                    <div id="section_div">
                        <center><h1 style="font-size: 45px;">Account created successfully <i style="color: #009933;" class="fa-regular fa-circle-check"></i></h1></center>
                    </div>
                    <?php
                    require_once("inc/aside.php");
                    ?>
                </div>
            </main>
                    
            <?php
            require_once("inc/footer.php");
            ?>
        </div>
</body>
</html>
