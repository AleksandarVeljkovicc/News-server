<?php
                            if(isset($_POST['logout']))
                            {
                                Log::write("logs/".date("Y-m-d")."_login.log", "Successful log out for '{$_SESSION['info']}'");
                                session_unset();
                                session_destroy();
                                setcookie("id", "", time()-1, "/");
                                setcookie("info", "", time()-1, "/");
                                setcookie("status", "", time()-1, "/");
                                setcookie("username", "", time()-1, "/");

                                header("Location: index.php");   //Header funkcija mora stajati pre bilo kog output-a u browser-u ili ce prijaviti gresku.
                            }
                        ?>

                        <?php
                        
                        if(login())
                        {
                            echo '<h1 class="headline">User info</h1>';
                            $id=$_SESSION['id'];
                            $query="SELECT * FROM userview WHERE user_id='{$id}'";
                            $result=$db->query($query);

                            if($db->num_rows($result)==1)
                            {
                                echo "<div id='user_information_div'>";

                                $row=$db->fetch_object($result);
                                if($row->image != NULL)
                                {    //pretvaranje blob-a u image.
                                    $image = imagecreatefromstring($row->image); 
                                    ob_start(); //function creates an output buffer. A callback function can be passed in to do processing on the contents of the buffer before it gets flushed from the buffer. Flags can be used to permit or restrict what the buffer is able to do.
                                    imagejpeg($image, null, 80);  // Output image to browser or file. 3d paramether is quality from 0-100, default is -1.
                                    $data = ob_get_contents(); //Store the contents of an output buffer in a variable:
                                    ob_end_clean(); //Delete an output buffer without sending its contents to the browser:


                                     /*Output slike, prijavljuje gresku ako se nadje pre header().*/ 
                                    echo '<img style="width: 250px;" alt="error" src="data:image/jpg;base64,' .  base64_encode($data)  . '" />'."<hr>";  //base64_encode(string $string)-Encodes the given string with base64.  This encoding is designed to make binary data survive transport through transport layers that are not 8-bit clean, such as mail bodies.  Base64-encoded data takes about 33% more space than the original data.
                                }
                                    else
                                {
                                    echo '<img style="width: 250px;" src="./images/no-image-avatar.png" alt="error">'. "<hr>";
                                }
                                echo "Name: {$row->name}" . " " . "{$row->last_name}". "<br>";
                                echo "Email: {$row->email}". "<br>";
                                echo "Status: {$row->status}". "<br>";
                                if($row->comment != NULL)
                                {
                                    echo "Comment: {$row->comment}". "<br>";
                                }
                                if($row->country != NULL)
                                {
                                    echo "Country: {$row->country}". "<br>";
                                }
                                if($row->city != NULL)
                                {
                                    echo "Country: {$row->city}". "<br>";
                                }
                                if($row->date_of_birth != NULL)
                                {
                                    $date=date_format(new DateTime($row->date_of_birth),'d F Y'); 
                                    echo "Birthday: {$date}". "<br>";                                  
                                }
                                $date=date_format(new DateTime($row->create_date),'d F Y-G:i'); 
                                echo "Account created: {$date}". "<br>";
           
                                echo "<br><form action='' method='POST'>";
                                echo "<button name='logout' >Log out</button>";
                                echo "</form>";

                                echo "</div>";

                            }                                
                        }
                        else
                            {
                                    echo "<center>";
                                    echo "<h1 style='font-size:45px;'>You must be logged in to access this page.</h1>";
                                    echo "<button><a href='loginpage.php' id='login'>Log in</a></button>";
                                    echo "</center>";                             
                            }
?>