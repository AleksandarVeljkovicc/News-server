<?php
session_start();
require_once('requiredFiles.php');
$db=new Db();
if(!$db->connect()){
    echo "Connection failed!";
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php if(isset($_GET['category'])) {$category = $_GET['category']; echo $category;} else echo "Home";?></title>
    <link type="text/css" rel="stylesheet" href="css/mainpage_css.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css"/>   <!--eliminise podrazumevanu marginu u browser-u-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">  <!--da bi mogle da se koriste ikonice za drustvene mreze-->
</head>
<body>
        <div>
            <?php
            require_once("_header.php");
            ?>

            <main>
                <div id="main_div_container">
                    <div id="section_div">
                   
                        <section>
                        <?php
                        $query="SELECT * FROM newsview WHERE news_id IN (SELECT max(news_id) FROM newsview WHERE deleted=0 GROUP BY type) ORDER BY news_id DESC";
                      
                       if(isset($_GET['category']))
                       {
                             $category = $_GET['category'];
                             $query="SELECT * FROM newsview WHERE type='{$category}' AND deleted=0 ORDER BY news_id DESC";
                             echo "<h1 class='headline'>{$category}</h1>";
                       }
                       else echo '<h1 class="headline">Leatest news</h1>';

                       
                       $result = $db->query($query);
                      
                       
                       if($db->num_rows($result)>0)
                    {
                        while($row=$db->fetch_object($result))
                                               
                        {
                         echo "<article>";
                         echo  '<div class="main_article_container">';

                         $image = imagecreatefromstring($row->image);  
                         ob_start(); //function creates an output buffer. A callback function can be passed in to do processing on the contents of the buffer before it gets flushed from the buffer. Flags can be used to permit or restrict what the buffer is able to do.
                         imagejpeg($image, null, 80);  // Output image to browser or file. 3d paramether is quality from 0-100, default is -1.
                         $data = ob_get_contents(); //Store the contents of an output buffer in a variable:
                         ob_end_clean(); //Delete an output buffer without sending its contents to the browser:


                         echo  '<div class="article_div_chiled_left" style="background-image: url(data:image/jpg;base64,' .  base64_encode($data) . '); background-size: cover; background-repeat: no-repeat;">';
                          

                         echo "<p>{$row->type}</p>";
                         
                         echo '</div>';

                        
                         echo "<div class='article_div_chiled_right'>";
                         echo "<h2><a href='./news?news_id={$row->news_id}'>{$row->headline}</a></h2>";
                         echo "</div>";


                         echo "</div>";
                         echo "</article>";
                        }
                        
                    }

                        
                        ?>
                        </section>
                    </div>

                    <?php
                    require_once("_aside.php");
                    ?>
                </div>
            </main>
                    
            <?php
            require_once("_footer.php");
            ?>
        </div>
</body>
</html>