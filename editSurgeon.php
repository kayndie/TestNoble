<?php require_once 'core/handleForms.php'; ?>
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
<?php $getChefByID = getSurgeonByID($pdo, $_GET['Surgeon_id']); ?>
	<h2>Surgeon Profile</h2>
	<form action="core/handleForms.php?Surgeon_id=<?php echo $_GET['Surgeon_id']; ?>" method="POST">
		<p>
			<label for="Surgeon_name">Surgeon Name</label> 
			<input type="text" name="Surgeon_name" value="<?php echo $getSurgeonByID['Sugeon_name']; ?>">
		</p>
		<p>
			<label for="experience_level">Experience Level</label> 
			<input type="text" name="experience_level" value="<?php echo $getSurgeonByID['experience_level']; ?>">
		</p>
		<p>
			<label for="Specialization">Specialization</label> 
			<input type="text" name="Specialization" value="<?php echo $getSurgeonByID['Specialization']; ?>">
		</p>
		<div class="ebtn">
		<input type="submit" name="editSurgeonBtn">
		</div>
	</form>
	</center>
</body>
</html>