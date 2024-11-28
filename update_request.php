<?php
include 'conn.php';

// Ambil data dari request
$id = $_POST['id'];
$executor = $_POST['executor'];
$execution_date = $_POST['execution_date'];

// Update data di tabel request_list
$sql = "UPDATE request_list SET eksekutor = ?, waktu_pengerjaan = ?, `status` = 'accepted', status_pekerjaan = 'pending' WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssi", $executor, $execution_date, $id);

if ($stmt->execute()) {
    echo "Data berhasil diperbarui";
    header("Location: ./");
} else {
    echo "Gagal memperbarui data: " . $conn->error;
}

$stmt->close();
$conn->close();
?>
