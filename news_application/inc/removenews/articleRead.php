<?php
 $query="SELECT * FROM newsview WHERE deleted=0 ORDER BY news_id DESC";
 if(isset($_POST['search']))$query="SELECT * FROM newsview WHERE headline LIKE ('%{$_POST['search']}%')";
 
 $result=$db->query($query);
 if($db->num_rows($result)>0)
 {
     while($row=$db->fetch_object($result))
     {
         echo '<div id="remove_news_container">';

         echo '<div id="remove_news_container_info">';
         echo "<h2><a href='./news?news_id={$row->news_id}'>{$row->headline}</a></h2>";
     
         echo '<div id="remove_news_container_chiled_right">';
         echo "<p>Author: {$row->name} {$row->last_name}</p>";
         $date=date_format(new DateTime($row->published),'d F Y-G:i');
         echo "<p>Published: {$date}</p>";
         echo "<p>{$row->views} views</p>";
         echo '</div>';
         echo '</div>';

         
         echo '<div id="remove_news_container_delete">';

         $news_id="delete".$row->news_id; 
         echo '<form action="" method="post">';
                                        
         echo  "<button name='$news_id'>Delete</button>";

         echo  '</form>';   
                          
         echo '</div>';


         echo '</div>'.'<br>';
     }
 }
 else
 {
     echo Message::info("No articles.");
 }
?>