<?php  

function insertSurgeon($pdo, $Surgeon_name, $experience_level, $Specialization, $username) {
    $sql = "INSERT INTO Surgeon (Surgeon_name, experience_level, Specialization) VALUES(?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute([$Surgeon_name, $experience_level, $Specialization]);

    if ($executeQuery) {
        logActivity($pdo, $username, 'INSERTION', "Inserted Surgeon: $Surgeon_name");
        return true;
    } else {
        return false;
    }
}

function deleteSurgeon($pdo, $Surgeon_id, $username) {
    try {
        $sql = "DELETE FROM Surgeon WHERE Surgeon_id = ?";
        $stmt = $pdo->prepare($sql);
        $result = $stmt->execute([$Surgeon_id]);
        
        if ($result) {
            logActivity($pdo, $username, 'DELETION', "Deleted Surgeon ID: $Surgeon_id");
            return true;
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        return false;
    }
}

function updateSurgeon($pdo, $Surgeon_name, $experience_level, $Specialization, $Surgeon_id, $username) {
    $sql = "UPDATE Surgeon SET Surgeon_name = ?, experience_level = ?, Specialization = ? WHERE Surgeon_id = ?";
    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute([$Surgeon_name, $experience_level, $Specialization, $Surgeon_id]);

    if ($executeQuery) {
        logActivity($pdo, $username, 'UPDATING', "Updated Surgeon ID: $Surgeon_id");
        return true;
    }
}

function getAllSurgeon($pdo) {
    $sql = "SELECT * FROM Surgeon";
    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute();

    if ($executeQuery) {
        return $stmt->fetchAll();
    }
}

function getSurgeonByID($pdo, $Surgeon_id) {
    $sql = "SELECT * FROM Surgeon WHERE Surgeon_id = ?";
    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute([$Surgeon_id]);

    if ($executeQuery) {
        return $stmt->fetch();
    }
}

function searchSurgeon($pdo, $searchTerm) {
    $sql = "SELECT * FROM Surgeon WHERE Surgeon_name LIKE :search OR Specialization LIKE :search";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':search' => "%$searchTerm%"]);
    return $stmt->fetchAll();
}


function registerUser($pdo, $username, $password, $email) {

$sql = "SELECT * FROM users WHERE username = ? OR email = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$username, $email]);

if ($stmt->rowCount() > 0) {
    return false;
}

$sql = "INSERT INTO users (username, password, email) VALUES (?, ?, ?)";
$stmt = $pdo->prepare($sql);
return $stmt->execute([$username, $password, $email]);
}


function loginUser($pdo, $username, $password) {
$sql = "SELECT * FROM users WHERE username = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$username]);

$user = $stmt->fetch();

if ($user) {
    return $user;
}

return false;
}


function getAllUsers($pdo) {
$sql = "SELECT * FROM users";
$stmt = $pdo->prepare($sql);
$stmt->execute();
return $stmt->fetchAll();
}

function logActivity($pdo, $user_id, $action, $details) {
    $checkUser = $pdo->prepare("SELECT id FROM users WHERE id = :user_id");
    $checkUser->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $checkUser->execute();
    
    if ($checkUser->rowCount() == 0) {
        throw new Exception("User ID does not exist in the 'users' table.");
    }

    $sql = "INSERT INTO activity_logs (user_id, action, details, timestamp) VALUES (:user_id, :action, :details, NOW())";
    $stmt = $pdo->prepare($sql);
    
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->bindParam(':action', $action, PDO::PARAM_STR);
    $stmt->bindParam(':details', $details, PDO::PARAM_STR);
    
    // Execute the statement
    if ($stmt->execute()) {
        return true;
    } else {
        throw new Exception("Failed to log activity.");
    }
}

function getActivityLogs($pdo) {
    $sql = "SELECT * FROM activity_logs ORDER BY timestamp DESC";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll();
}

function logActivity($pdo, $username, $action_type, $action_details) {
    $sql = "INSERT INTO ActivityLogs (username, action_type, action_details) VALUES(?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute([$username, $action_type, $action_details]);
}

function logoutUser() {
session_start();
session_unset();
session_destroy();
}
?>
