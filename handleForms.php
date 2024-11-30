<?php 
session_start();

require_once 'dbConfig.php'; 
require_once 'models.php';
require_once 'helpers.php';
ob_start();

$username = $_SESSION['username'];

if (isset($_POST['insertSurgeonBtn'])) {
    $query = insertSurgeon($pdo, $_POST['Surgeon_name'], $_POST['experience_level'], $_POST['Specialization']);

    if ($query) {
        logActivity($pdo, $_SESSION['user_id'], 'Insert Surgeon', "Surgeon added: " . $_POST['Surgeon_name']);
        $_SESSION['response'] = handleResponse("success", "Surgeon added.");
        header("Location: ../index.php");
    } else {
        $_SESSION['response'] = handleResponse("failure", "Could not insert surgeon.");
        header("Location: ../index.php");
    }
    exit;
}

if (isset($_POST['editSurgeonBtn'])) {
    unset($_SESSION['response']);

    $query = updateSurgeon($pdo, $_POST['Surgeon_name'], $_POST['experience_level'], $_POST['Specialization'], $_GET['Surgeon_id']);

    if ($query) {
        logActivity($pdo, $_SESSION['user_id'], 'Update Surgeon', "Surgeon updated: " . $_POST['Surgeon_name']);
        $_SESSION['response'] = handleResponse("success", "Surgeon updated successfully.");
        header("Location: ../index.php");
    } else {
        $_SESSION['response'] = handleResponse("failure", "Could not update surgeon.");
        header("Location: ../index.php");
    }
    exit;
}


if (isset($_POST['deleteSurgeonBtn'])) {
    unset($_SESSION['response']);

    $query = deleteSurgeon($pdo, $_GET['Surgeon_id']);

    if ($query) {
        logActivity($pdo, $_SESSION['user_id'], 'Delete Surgeon', "Surgeon deleted with ID: " . $_GET['Surgeon_id']);
        $_SESSION['response'] = handleResponse("success", "Surgeon deleted successfully.");
        header("Location: ../index.php");
    } else {
        $_SESSION['response'] = handleResponse("failure", "Could not delete surgeon.");
        header("Location: ../index.php");
    }
    exit;
}

if (!empty($searchTerm)) {
    logActivity($pdo, $_SESSION['user_id'], 'Search Surgeon', "User searched for: " . $searchTerm);
    $surgeons = searchSurgeon($pdo, $searchTerm);
} else {
    $surgeons = getAllSurgeon($pdo);
}


?>