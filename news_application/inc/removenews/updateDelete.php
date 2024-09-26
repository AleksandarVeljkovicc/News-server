<?php
$message="";

$query="SELECT * FROM news";
$result=$db->query($query);
if($db->num_rows($result)!=0)
{
    while($row=$db->fetch_object($result))
    {
        $news_id="delete".$row->news_id; 

        if(isset($_POST[$news_id]))
        {
            $id=str_replace("delete","",$news_id);
            $query ="UPDATE news SET deleted=1 WHERE news_id=$id";    
            $db->query($query);

            if($db->error()) $message=Message::error("Error". "<br>".$db->error())."<br>";
            else 
            {                                                                
                $message=Message::success("Article deleted.")."<br><br>";                 
            }
        }   
    }
}
?>