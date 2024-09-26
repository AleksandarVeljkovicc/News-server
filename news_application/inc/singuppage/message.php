<?php
	if(isset($errors)){
		echo "<div id='singup_error'>";
		foreach($errors as $error) {
			echo Message::error($error). "<br>";
		}
		echo "</div>";
	}
	?>