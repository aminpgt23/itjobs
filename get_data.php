<?php
include 'conn.php';

header('Content-Type: application/json');

$id = $_GET['id'] ?? null;

if ($id) {
    $stmt = $conn->prepare("SELECT * FROM request_list WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo json_encode($result->fetch_assoc());
    } else {
        echo json_encode(["error" => "Data not found"]);
    }

    $stmt->close();
    $conn->close();
} else {
    echo json_encode(["error" => "ID not provided"]);
}
?>
