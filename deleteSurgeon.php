<?php require_once 'core/dbConfig.php'; ?>
<?php require_once 'core/models.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Document</title>
	<link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
</head>
<body>
	<center>
<div class="header">
	<a href="index.php">
		<h1>Kayndie's Healthcare</h1>
	</a>
	</div>
	</center>
	<center>
<h2>Are you sure you want to delete?</h2>
</center>
<center>
	<?php $getSurgeonByID = getSurgeonByID($pdo, $_GET['Surgeon_id']); ?>
	<div class="container delete">
		<h3>Surgeon name: <?php echo $getSurgeonByID['Surgeon_name']; ?></h3>
		<h3>Experience level: <?php echo $getSurgeonByID['experience_level']; ?></h3>
		<h3>Specialization: <?php echo $getSurgeonByID['Specialization']; ?></h3>

		<div class="dltbtn">
			<form action="core/handleForms.php?Surgeon_id=<?php echo $_GET['Surgeon_id']; ?>" method="POST">
				<input type="submit" name="deleteSurgeonBtn" value="Confirm">
			</form>			
		</div>	
	</div>
	</center>
</body>
</html>