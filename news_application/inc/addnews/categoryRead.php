<?php
 $query="SELECT * FROM `news_type` ORDER BY news_type_id ASC";
 $result=$db->query($query);
 if($db->num_rows($result)>0)
 {
     while($row=$db->fetch_object($result))
     {                                   
         echo "<option value='{$row->news_type_id}'>{$row->type}</option>";
     }
 }
 ?>