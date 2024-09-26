<?php
require_once("inc/sessionStart.php")
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>User info</title>
	<link type="text/css" rel="stylesheet" href="css/mainpage_css.css">
    <link type="text/css" rel="stylesheet" href="css/logout_css.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css"/>  
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">

</head>
<body>

    <?php
	require_once("inc/header.php");
	?>
            <main>
                <div id="main_div_container">
                    <div id="section_div">                      

                         <?php
                         require_once("inc/logout.php");
                        ?>
                    </div>
                    <?php
                    require_once("inc/aside.php");
                    ?>
                </div>
            </main>

    <?php
	require_once("inc/footer.php");
	?>
</body>
</html>
