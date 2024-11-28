<?php
include 'conn.php';

$sql = "SELECT id, nip, fullname, no_wa, dept, permintaan, problem_location, problem_device, waktu_permintaan, eksekutor, waktu_pengerjaan, status_pekerjaan,  `date`, `status` FROM request_list"; 
$result = $conn->query($sql);

$dataArray = [];
if ($result->num_rows > 0) {
    $dataArray = $result->fetch_all(MYSQLI_ASSOC);
}

// Mengembalikan data dalam format JSON
echo json_encode($dataArray);
?>
