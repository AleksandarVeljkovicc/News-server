<?php
if(isset($_POST['submit']))
{
    $headline=filter_var($_POST['headline'],FILTER_SANITIZE_STRING);
    $article=filter_var($_POST['article'],FILTER_SANITIZE_STRING);
 
    $errors=array();

    if(empty($headline))            //headline
    {
        $errors['headline']="Headline is empty.";
    }
    else if(strlen($headline)<10)
    {
        $errors['headline']="Headline cannot be less than 10 characters.";
    }

  
    if(empty($article))     //article
    {
        $errors['article']="Article is empty.";
    }
    else if(strlen($article)<10)
    {
        $errors['article']="Article cannot be less than 10 characters.";
    }

      
    $query = "SELECT news_type_id FROM `news_type`";
    $result = $db->query($query);


    $newsType = array();
    if($db->num_rows($result)>0)
    {
        while($row=$db->fetch_object($result))                              
        {
            array_push($newsType, $row->news_type_id);
        }
       
    }

  
    if(isset($_POST['type']))                //type
    {
        $category=filter_var($_POST['type'],FILTER_SANITIZE_STRING);  
        if(!in_array($category, $newsType))
        {
            $errors['type']="Category doesn't exist.";
        }
    
    }
    else
    {
        $errors['type']="You did not choose a category.";
    }


        $image="";
    if($_FILES['upload']['error'] === UPLOAD_ERR_OK)      //upload
        {
            
        
            if($_FILES['upload']['type']!="image/jpeg" AND $_FILES['upload']['type']!="image/png")		//image
            {
                $errors['upload']="Invalid image extension.";
            }
            
        }
        else 
        {
            $errors['upload']="Please choose a image.";
        }

    if(empty($errors))
    {

        $image=$db->escape_string(file_get_contents($_FILES['upload']['tmp_name'])); //file_get_contents-hvata sliku u stringu. mysqli_real_escape_string() function is used to escape characters in a string, making it legal to use in an SQL statement.
            
        $picName=microtime(true)."_".$_FILES['upload']['name'];
        $uploads_dir = __DIR__."/../../images/news/";
        move_uploaded_file($_FILES['upload']['tmp_name'],$uploads_dir.$picName);	//parm1-fajl[tmp_name],param2-destinacija+naziv fajla.

        $query="INSERT INTO news (headline, text, news_type_id, image, author) VALUES ('{$headline}','{$article}','{$category}','{$image}','{$_SESSION['id']}')";
        $db->query($query);

        if(!$db->error())
        {
            Log::write("logs/".date("Y-m-d")."_article.log", "Successfully added new article. id={$db->insert_id()} author={$_SESSION['info']}");
            $message=Message::success("Successfully added new article."). "<br>";
        }
        else
        {
            echo Message::error("Error". "<br>".$db->error())."<br>";
        }
    }
    
}
?>