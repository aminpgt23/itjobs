<?php
include 'conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $nip = $_POST['nip'];
    $fullname = $_POST['fullname'];
    $no_wa = $_POST['no_wa'];
    $dept = $_POST['dept'];
    $permintaan = $_POST['permintaan'];
    $problem_location = $_POST['problem_location'];
    $problem_device = $_POST['problem_device'];
    $waktu_permintaan = $_POST['waktu_permintaan'];
    $date = $_POST['date'];
    $status = $_POST['status'];

    if (empty($id) || empty($nip) || empty($fullname)) {
        die('Some fields are missing');
    }

    $sql = "UPDATE request_list SET nip = ?, fullname = ?, no_wa = ?, dept = ?, permintaan = ?, problem_location = ?, problem_device = ?, waktu_permintaan = ?, `date` = ?, `status` = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssssssi", $nip, $fullname, $no_wa, $dept, $permintaan, $problem_location, $problem_device, $waktu_permintaan, $date, $status, $id);

    if ($stmt->execute()) {
        echo "Update successful";
    } else {
        echo "Update failed: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
    header("Location: ./");
}
?>
