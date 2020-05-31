<!doctype html>
<html>
	<head>
	</head>
	<body>
		
		<form action="abc.php" method="POST">
			Title: <input type="text" name="title"><br>
			<textarea name="body" rows="10" cols="80"></textarea><br>
			<input type="submit" value="Save" name="submit">
		</form>
	</body>
</html>

<?php 
	
	if (isset($_POST['submit'])) {
		echo $_POST['body']."<br>";
		echo $_POST['title'];
	}
	

 ?>

 <!-- value="&amp;lt;script&amp;gt;alert('dgfdg');&amp;lt;/script&amp;gt;"
 &amp;lt;script&amp;gt;alert('dgfdg');&amp;lt;/script&amp;gt; -->