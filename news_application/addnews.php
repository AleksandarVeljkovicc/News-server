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
$message="";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add news</title>
    <link type="text/css" rel="stylesheet" href="css/mainpage_css.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css"/>   <!--eliminise podrazumevanu marginu u browser-u-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">  <!--da bi mogle da se koriste ikonice za drustvene mreze-->
</head>
<body>
        <div>
            <?php
            require_once("inc/header.php");
            ?>

            <?php
                require_once("inc/addnews/submitCheck.php");       
            ?>

            <main>
                <div id="main_div_container">
                    <div id="section_div">   
                        <h1 class="headline" style="color:black;">Add news</h1>              
                        <section>
                            <div class="textarea_div">
                        <form action="" method="POST" enctype="multipart/form-data">

                        <input style="width:100%; height:25px;" name="headline" <?php if(isset($errors['headline'])) {echo "class='errors'";}?> type="text" placeholder="Headline" value="<?php if(isset($headline)){echo $headline;}?>"><br><br>
                        <select name="type" <?php if(isset($errors['type'])) {echo "class='errors'";}?>>
                        <option value="0" selected disabled hidden>---Select category---</option>
                            <?php
                                require_once("inc/addnews/categoryRead.php");                          
                            ?>
                        </select><br><br>
                        <textarea style="width:100%; resize: none;" name="article" rows=23 placeholder="Add text" <?php if(isset($errors['article'])) {echo "class='errors'";}?>></textarea><br><br>
                        <input type="file" name="upload" accept="image/*"><br><br>
                        <button style="font-size:25px" name="submit">Add article</button> <br><br> 

                        </form>
                        <?php
                            require_once("inc/addnews/message.php");
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

