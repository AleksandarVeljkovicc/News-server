<?php
                        $query="SELECT * FROM newsview WHERE news_id IN (SELECT max(news_id) FROM newsview WHERE deleted=0 GROUP BY type) ORDER BY news_id DESC";
                      
                       if(isset($_GET['category']))
                       {
                             $category = htmlspecialchars($_GET['category']);
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

                        
                        echo "<div class='article_div_chiled_left'>";
                        echo '<img src="data:image/jpeg;base64,'.base64_encode($data).'" alt="Error">';
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