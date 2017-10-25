<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Login</title>
	<link rel="stylesheet" href="css/index.css">
	<script></script>
</head>
<body>
	<?php 
		require_once('connect.php');
		$name = $pass = '';
		if (isset($_POST['submit'])) {
			if (empty($_POST["name"])) {
				$errors['name'] = "Name is required";
			}else{
				$name = test_input($_POST["name"]);
			}
			if (empty($_POST["pass"])) {
				$errors["pass"] = "Password is required";
			}else{
				$pass = test_input($_POST["pass"]);
			}
			$name = mysqli_real_escape_string($connect,$_POST['name']);
			$password = mysqli_real_escape_string($connect,$_POST['pass']);

			$sql = "SELECT id FROM login WHERE username = '$name' and password = '$password'";
			$result = mysqli_query($connect,$sql);
			$row = mysqli_fetch_array($result,MYSQLI_ASSOC);

			$count = mysqli_num_rows($result);

			if ($count == 1) {
				header("Location: wellcome.php");
				
			}else{
				$error = "Your Login name name or password invalid";
			}
		}
		function test_input($data)
		{
			$data = trim($data);
			$data = stripcslashes($data);
			$data = htmlspecialchars($data);
			return $data;
		}
		
	?>
	<div class="container">
		<form action="" method="POST">
			<h1>Login</h1>
			Username : <input type="text" name="name" placeholder="Username" <?php echo ($name); ?>>
			<span class="error">
				*<?= isset($errors['name']) ? $errors['name'] : '' ?>
			</span> <br>
			Password : <input type="password" name="pass" placeholder="Password" <?php echo ($pass); ?>> 
			<span class="error">
				*<?= isset($errors['pass']) ? $errors['pass'] : '' ?>
			</span> <br>
			<button type="submit" name="submit" class="btn btn-primary btn-block btn-large">Login</button>
		</form>
	</div>
</body>
</html>