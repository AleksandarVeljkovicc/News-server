
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
   


                            echo '<div id="aside_div_chiled" style="background-image: url(data:image/jpg;base64,' .  base64_encode($data) . '); background-size: cover; background-repeat: no-repeat;">';
                            echo '<p>Most popular</p>';
                            echo '</div>';


                            echo "<h2 style='word-wrap: break-word;'><a href='./news?news_id={$row->news_id}'>{$row->headline}</a></h2>";
                            echo '</aside>';
                            echo '</div>';
                        }
                    }
                    else if($db->num_rows($result)==0)
                    {
                        $query="SELECT published, text, image, news_id, headline, deleted, name, last_name, type, MAX(views) AS views FROM `newsview` WHERE deleted=0 GROUP BY views DESC LIMIT 1";  //vest sa najvecim brojem pregleda u slucaju da ne postoji vest mladja od mesec dana.
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
    


                                echo '<div id="aside_div_chiled" style="background-image: url(data:image/jpg;base64,' .  base64_encode($data) . '); background-size: cover; background-repeat: no-repeat;">';
                                echo '<p>Most popular</p>';
                                echo '</div>';


                                echo "<h2 style='word-wrap: break-word;'><a href='./news?news_id={$row->news_id}'>{$row->headline}</a></h2>";
                                echo '</aside>';
                                echo '</div>';
                            }
                        }
                        else
                        {
                            echo Message::info("There are no articles.");
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
   


                            echo '<div id="aside_div_chiled" style="background-image: url(data:image/jpg;base64,' .  base64_encode($data) . '); background-size: cover; background-repeat: no-repeat;">';
                            echo '<p>Most popular</p>';
                            echo '</div>';


                            echo "<h2 style='word-wrap: break-word;'><a href='./news?news_id={$row->news_id}'>{$row->headline}</a></h2>";
                            echo '</aside>';
                            echo '</div>';
                        }
                    }
                    else if($db->num_rows($result)==0)
                    {
                        $query="SELECT published, text, image, news_id, headline, deleted, name, last_name, type, MAX(views) AS views FROM `newsview` GROUP BY views DESC LIMIT 1";  //vest sa najvecim brojem pregleda u slucaju da ne postoji vest mladja od mesec dana.
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
    


                                echo '<div id="aside_div_chiled" style="background-image: url(data:image/jpg;base64,' .  base64_encode($data) . '); background-size: cover; background-repeat: no-repeat;">';
                                echo '<p>Most popular</p>';
                                echo '</div>';


                                echo "<h2 style='word-wrap: break-word;'><a href='./news?news_id={$row->news_id}'>{$row->headline}</a></h2>";
                                echo '</aside>';
                                echo '</div>';
                            }
                        }
                        else
                        {
                            echo Message::info("There are no articles.");
                        }
                    }
                }
?>