<?php
require_once("inc/sessionStart.php")
?>

<?php

if(!login()){
    header("Location: index.php");
}
if(login()){
    if($_SESSION['status']!="Administrator")
    {
        header("Location: index.php");
    }
}

require_once("inc/removenews/updateDelete.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Remove news</title>
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
    
                    <h1 class="headline" style="color:black;">Remove news</h1>

                        <section>                                                          
                             <div id="remove_news">

                                <?php
                                    echo $message;
                                ?>

                             <form action="" method="post">
                                <input id="search" type="text" name="search" placeholder="Search"/> 
                                <button>Search</button>
                            </form><br><br>
                            <?php
                                require_once("inc/removenews/articleRead.php");
                            ?>


                             </div>
                        </section>
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

        <script src="inc/submitFlush.js"></script>
</body>
</html>