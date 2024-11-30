<?php require_once 'core/dbConfig.php'; ?>
<?php require_once 'core/models.php'; ?>
<a?php session_start(); 
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
    <title>Document</title>
</head>
<body>
<center>
<div class="header">
	<a href="index.php">
		<h1>Kayndie's Healthcare</h1>
        <button style="background-color: lightblue; border-color: lightblue; color:black"><a href="logout.php?Surgeon_id">Logout</a></button>
	</a>
	</div>

<?php
if (isset($_SESSION['response'])) {
    $response = $_SESSION['response'];
    echo "<div class='alert alert-info'>";
    echo "<strong>Status Code: {$response['statusCode']}</strong><br>";
    echo "{$response['message']}";
    echo "</div>";
    unset($_SESSION['response']);
}
?>

<?php
$searchTerm = isset($_GET['search']) ? trim($_GET['search']) : "";

if (!empty($searchTerm)) {
    $surgeons = searchSurgeon($pdo, $searchTerm);
} else {
    $surgeons = getAllSurgeon($pdo);
}
?>
	
	<div class="content">

	 <h2>Surgeon</h2>
    <h3>Apply</h3>
    <form action="core/handleForms.php" method="POST">
		<p>
			<label for="Surgeon_name">Surgeon Name</label> 
			<input type="text" name="Surgeon_name" required>
		</p>
		<p>
			<label for="experience_level">Experience level</label> 
			<input type="text" name="experience_level" required>
		</p>
		<p>
			<label for="Specialization">Specialization</label> 
			<input type="text" name="Specialization" required>
		</p>
			<input type="submit" name="insertSurgeonBtn" value="Apply">
	</form>
	</div>
	
	<h2 style="border-bottom: 1px solid black;">Surgeon</h2>
	<div class="Search">
	<form method="GET" action="">
        <input type="text" name="search" placeholder="Search surgeons" value="<?= htmlspecialchars($searchTerm) ?>">
        <button type="submit">Search</button>
    </form>

    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Experience Level</th>
                <th>Specialization</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($surgeons)) : ?>
                <?php foreach ($surgeons as $surgeon) : ?>
                    <tr>
                        <td><?= htmlspecialchars($surgeon['Surgeon_id']) ?></td>
                        <td><?= htmlspecialchars($surgeon['Surgeon_name']) ?></td>
                        <td><?= htmlspecialchars($surgeon['experience_level']) ?></td>
                        <td><?= htmlspecialchars($surgeon['Specialization']) ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr>
                    <td colspan="4">No surgeons found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
	</div>
	<div class="ListOfSurgeons">
		<?php $getAllSurgeons = getAllSurgeon($pdo); ?>
		<?php foreach ($getAllSurgeons as $row) { ?>
			<div class="container">
				<h3><?php echo $row['Surgeon_name']; ?></h3>
				<p>Experience Level: <?php echo $row['experience_level']; ?></p>
				<p>Specialization: <?php echo $row['Specialization']; ?></p>
				<button style="background-color: lightblue; border-color: lightblue; color:black"><a href="editSurgeon.php?Surgeon_id=<?php echo $row['Surgeon_id']; ?>">Edit</a></button>
				<button style="background-color: lightblue; border-color: lightblue; color:black"><a href="deleteSurgeon.php?Surgeon_id=<?php echo $row['Surgeon_id']; ?>">Delete</a></button>
			</div>
	<?php } ?>
	</div>
	</center>
</body>
</html>