<div>
            <header>
                <div id="header_div_container">
                    <h2>WW<span style="color: #ce1125;">N</span></h2>
                    <div id="header_div_right_container">
                            <h3>Social media</h3>                       
                        <div id="header_div_right_lower">
                            <a class="social_icon" href="#"><i class="fa-brands fa-facebook-f"></i></a>
                            <a class="social_icon" href="#"><i class="fa-brands fa-twitter"></i></a>
                            <a class="social_icon" href="#"><i class="fa-brands fa-instagram"></i></i></a>
                        </div>
                    </div>
                </div>
            </header>

            <nav>
                <div id="nav_div">                   
                    <ul>
                        <li><a href="index.php">Home</a></li>
                        <li><a href="">Contact us</a></li>

                        <?php
                        $query="SELECT type FROM `news_type` ORDER BY news_type_id ASC";
                        
                        $rez=$db->query($query);
                        while($row=$db->fetch_object($rez))
                            echo "<li><a href='index.php?category={$row->type}'>{$row->type}</a></li>";
                        //Provera da li je neko ulogovan
                        if(login())
                            echo "<li><a class='navigation-active' href='logoutpage.php'>{$_SESSION['info']} ({$_SESSION['status']})</a></li>";
                        else
                            echo "<li><a class='navigation-active' href='loginpage.php'>Log in</a></li>";
                       ?>
                            
                        
                    </ul>                   
                </div>
            </nav>