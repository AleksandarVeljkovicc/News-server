
<?php

if(login())
{
    if($_SESSION['status']=="Administrator")
    {
        echo '<div id="aside_div_admin">';
        echo '<aside>';

        echo '<p><a href="./addnews.php">Add news</a></p>'.'<hr>';
        echo '<p><a href="./removenews.php">Remove news</a></p>';

        echo '</aside>';
        echo '</div>';
    }
    else
                {
                    $query="SELECT * FROM newsview WHERE deleted=0 AND DATEDIFF(NOW(),published)<30 GROUP BY news_id HAVING MAX(views) ORDER by views DESC LIMIT 1";  //pretrazuje red sa najvecim brojem pregleda zadnjih mesec dana.
                    $result=$db->query($query);
                    if($db->num_rows($result)>0)
                    {
                        while($row=$db->fetch_object($result))
                        {
                            echo '<div id="aside_div">';
                            echo '<aside>';

                            $image = imagecreatefromstring($row->image);  
                            ob_start(); //function creates an output buffer. A callback function can be passed in to do processing on the contents of the buffer before it gets flushed from the buffer. Flags can be used to permit or restrict what the buffer is able to do.
                            imagejpeg($image, null, 80);  // Output image to browser or file. 3d paramether is quality from 0-100, default is -1.
                            $data = ob_get_contents(); //Store the contents of an output buffer in a variable:
                            ob_end_clean(); //Delete an output buffer without sending its contents to the browser:

                            echo '<div id="aside_div_chiled">';
                            echo '<img src="data:image/jpeg;base64,'.base64_encode($data).'" alt="Error">';
                            echo '<p>Most popular this month</p>';
                            echo '</div>';
                          
                            echo "<h2 style='word-wrap: break-word;'><a href='./news?news_id={$row->news_id}'>{$row->headline}</a></h2>";
  
                            echo '</aside>';
                            echo '</div>';
                        }
                    }                  
                }
}               
else
    {
        $query="SELECT * FROM newsview WHERE deleted=0 AND DATEDIFF(NOW(),published)<30 GROUP BY news_id HAVING MAX(views) ORDER by views DESC LIMIT 1";  //pretrazuje red sa najvecim brojem pregleda zadnjih mesec dana.
        $result=$db->query($query);
        if($db->num_rows($result)>0)
        {
            while($row=$db->fetch_object($result))
            {
                echo '<div id="aside_div">';
                echo '<aside>';

                $image = imagecreatefromstring($row->image);  
                ob_start(); //function creates an output buffer. A callback function can be passed in to do processing on the contents of the buffer before it gets flushed from the buffer. Flags can be used to permit or restrict what the buffer is able to do.
                imagejpeg($image, null, 80);  // Output image to browser or file. 3d paramether is quality from 0-100, default is -1.
                $data = ob_get_contents(); //Store the contents of an output buffer in a variable:
                ob_end_clean(); //Delete an output buffer without sending its contents to the browser:
                
                echo '<div id="aside_div_chiled">';
                echo '<img src="data:image/jpeg;base64,'.base64_encode($data).'" alt="Error">';
                echo '<p>Most popular this month</p>';
                echo '</div>';

                echo "<h2 style='word-wrap: break-word;'><a href='./news?news_id={$row->news_id}'>{$row->headline}</a></h2>";

                echo '</aside>';
                echo '</div>';
            }
        }                  
    }
?>