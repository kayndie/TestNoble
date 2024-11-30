<?php
function handleResponse($status, $details = "") {
    $statusCode = $status === "success" ? 200 : 400;
    return [
        "statusCode" => $statusCode,
        "message" => $status === "success" 
            ? "Operation successful. $details" 
            : "Operation failed. $details"
    ];
}
?>
