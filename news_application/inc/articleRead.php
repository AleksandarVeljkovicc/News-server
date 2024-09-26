<?php 

                    if(isset($_GET['news_id']))
                    {
                        $news_id=$_GET['news_id'];

                        $query="UPDATE news SET views=views+1 WHERE news_id={$news_id}";
                        $db->query($query);

                        $query = "SELECT * FROM newsview WHERE deleted=0 AND news_id={$news_id}";
                        $result = $db->query($query);
                        while($row=$db->fetch_assoc($result))
                        {
                            $date=date_format(new DateTime($row['published']),'d F Y-G:i');        //formatiranje datuma
                            echo "<h1 style='font-size:45px; word-wrap: break-word;'>{$row['headline']}</h1>". "<hr>";

                            echo "<p style='font-style:italic;'>Published by {$row['name']} {$row['last_name']}</p>";
                            echo "<p>{$date}</p>";
                            echo "<p>{$row['views']} views</p><hr>";
                            $image = imagecreatefromstring($row['image']); 
                            ob_start(); //function creates an output buffer. A callback function can be passed in to do processing on the contents of the buffer before it gets flushed from the buffer. Flags can be used to permit or restrict what the buffer is able to do.
                            imagejpeg($image, null, 80);  // Output image to browser or file. 3d paramether is quality from 0-100, default is -1.
                            $data = ob_get_contents(); //Store the contents of an output buffer in a variable:
                            ob_end_clean(); //Delete an output buffer without sending its contents to the browser:
   
   
                            echo '<img style="width: 100%;" alt="error" src="data:image/jpg;base64,' .  base64_encode($data)  . '" />';
                            
                            
                            $text = nl2br($row['text']);  //funkcija omogucava vidljivost novog reda u browser-u.
                            echo "<p style='word-wrap: break-word;'>$text</p>"."<hr>"."<br>";
                            
                            
                            
                        }
                    }
                        if(login())
                        {
                            echo '<form action="" method="POST">';
                            echo '<textarea style="resize: none;" name="comment" id="comment" cols="30" rows="10" placeholder="Comment"></textarea><br><br>
                                    <button>Comment</button>';
                            echo '</form><br><hr>';
                            
                            if($message!="")
                            {
                                echo $message;
                            }

                            if(isset($_POST['comment']) AND isset($_GET['news_id']))
                            {
                                
                                $news_id=$_GET['news_id'];
                                $comment=$_POST['comment'];
                                
                                $comment=filter_var($comment, FILTER_SANITIZE_STRING);
                                
                                if($comment=="" OR strlen($comment)<2)
                                {
                                    echo Message::error("Comment cannot be less than 2 characters.")."<br><hr>";
                                }
                                else
                                {
                                    $query="INSERT INTO comments (user_id, news_id, comment) VALUES ({$_SESSION['id']}, {$_GET['news_id']}, '{$comment}')";
                                    $db->query($query);
                                    if($db->error()) echo Message::error("Error". "<br>".$db->error())."<br>";
                                    else 
                                    {                                                                
                                        echo Message::success("Comment added.")."<br><hr>";       
                                                     
                                    }
                                }
                                
                            }
                        }

                        $query="SELECT * FROM commentview WHERE news_id={$_GET['news_id']} AND allowed=1 ORDER BY date DESC";
                        $result=$db->query($query);
                        if($db->num_rows($result)==0) echo Message::info("No comments yet.")."<br>";
                        else
                        {
                            
                           
                            while($row=$db->fetch_object($result))
                            {
                                
                               

                                echo "<div style='display:flex;'>";
                                echo "<div>";
                                if($row->image != NULL)
                                {
                                    $image = imagecreatefromstring($row->image); 
                                    ob_start(); //function creates an output buffer. A callback function can be passed in to do processing on the contents of the buffer before it gets flushed from the buffer. Flags can be used to permit or restrict what the buffer is able to do.
                                    imagejpeg($image, null, 80);  // Output image to browser or file. 3d paramether is quality from 0-100, default is -1.
                                    $data = ob_get_contents(); //Store the contents of an output buffer in a variable:
                                    ob_end_clean(); //Delete an output buffer without sending its contents to the browser:
        
        
                                    echo '<img style="width: 40px; border-radius: 50%;" alt="error" src="data:image/jpg;base64,' .  base64_encode($data)  . '" />';
                                }
                                else
                                {
                                    echo '<img style="width: 40px; border-radius: 50%;" src="./images/no-image-avatar.png" alt="error">';
                                }
                                echo "</div>";
                                
                                echo "<div style='word-wrap: break-word; width: 94%; margin-left: 10px;'>";
                                echo "<b>{$row->name} {$row->last_name}:</b> <i>$row->date</i><br>";
                                echo  "<p>".nl2br($row->comment)."</p>"; //funkcija omogucava vidljivost novog reda u browser-u.
                                echo "</div>";

                                echo "</div>";
                                    if(login())
                                    {
                                        $comments_id="delete".$row->comments_id;
                                        if($_SESSION['status']=="Administrator")
                                        {
                                            echo '<form action="" method="POST">';

                                            echo "<button name='$comments_id'>Remove comment</button>"; 
                                            
                                            echo "</form><hr>";
                                        }
                                        else if($_SESSION['info']==($row->name . " " . $row->last_name))
                                        {
                                        
                                            echo '<form action="" method="POST">';

                                            echo "<button name='$comments_id'>Remove comment</button>"; 
                                            
                                            echo "</form><hr>";
                                        }
                                    }
                                           echo "<br><br>";
                                
                            }
                           
                            
                        }

?>