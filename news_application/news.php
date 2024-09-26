<?php
require_once("inc/sessionStart.php")
?>

<?php
$message="";

    $query="SELECT * FROM comments";
    $result=$db->query($query);
    if($db->num_rows($result)!=0)
    {
        while($row=$db->fetch_object($result))
        {
            $comments_id="delete".$row->comments_id;

            if(isset($_POST[$comments_id]))
            {
                $id=str_replace("delete","",$comments_id);
                $query ="UPDATE comments SET allowed=0 WHERE comments_id=$id";    
                $db->query($query);

                if($db->error()) $message=Message::error("Error". "<br>".$db->error())."<br>";
                else 
                {                                                                
                    $message=Message::success("Comment removed.")."<br><hr>";                 
                }
            }   
        }
    }

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>News</title>
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
                   
                        <section>
                        <article>
                        <div style='margin:5%;'>

                        <?php
                            require_once("inc/articleRead.php");
                        ?>
                        
                        </div>
                        </article>
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