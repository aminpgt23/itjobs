<?php
 session_start();
if($_SESSION["username"] == null){
    header('Location:./login');
}
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>main jobs</title>
    <link rel="icon" type="image/png" href="barcode.png">
    <script src="jquery-3.6.0.min.js"></script>
    <!-- <link href="https://cdn.datatables.net/v/ju/jszip-3.10.1/dt-2.1.8/af-2.7.0/b-3.2.0/b-colvis-3.2.0/b-html5-3.2.0/b-print-3.2.0/cr-2.0.4/date-1.5.4/fc-5.0.4/fh-4.0.1/kt-2.12.1/r-3.0.3/rg-1.5.1/rr-1.5.0/sc-2.4.3/sb-1.8.1/sp-2.3.3/sl-2.1.0/sr-1.4.1/datatables.min.css" rel="stylesheet">
 
 <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
 <script src="https://cdn.datatables.net/v/ju/jszip-3.10.1/dt-2.1.8/af-2.7.0/b-3.2.0/b-colvis-3.2.0/b-html5-3.2.0/b-print-3.2.0/cr-2.0.4/date-1.5.4/fc-5.0.4/fh-4.0.1/kt-2.12.1/r-3.0.3/rg-1.5.1/rr-1.5.0/sc-2.4.3/sb-1.8.1/sp-2.3.3/sl-2.1.0/sr-1.4.1/datatables.min.js"></script> -->
 
    <link rel="stylesheet" href="jquery.dataTables.min.css">
    <link rel="stylesheet" href="responsive.dataTables.min.css">
    <script src="jquery.dataTables.min.js"></script>
    <script src="dataTables.responsive.min.js"></script>
    <link rel="stylesheet" href="sweetalert2.min.css">
    <script src="sweetalert2.min.js"></script>
    <style>
        *{
            font-family: monospace;
            color: #000000;
        }
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f5f5f5;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
            margin: 0;
        }

        .card {
            /* background-color: #ffffff; */
            /* border-radius: 20px; */
            /* box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); */
            /* padding: 3px; */
            margin: 3px;
            width: 100%;
            max-width: 195vh;
            margin: 0 auto;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            font-size: 24px;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table thead {
            background-color: #007bff;
            color: #ffffff;
        }

        table th, table td {
            padding: 12px;
            text-align: left;
            border: 1px solid #ddd;
        }

        table th {
            font-weight: bold;
        }

        table tbody tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        table tbody tr:hover {
            background-color: #f1f1f1;
        }


/* Modal container */
#editModal {
    display: none;
    position: fixed;
    z-index: 1000;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5); /* Background hitam dengan transparansi */
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden; /* Mencegah scroll */
}

/* Modal form */
#editForm {
    display: grid;
    grid-template-columns: repeat(2, 1fr); /* Membuat dua kolom */
    gap: 20px; /* Jarak antar elemen */
    background-color: #fff;
    padding: 20px;
    border-radius: 10px;
    width: 90%;
    max-width: 800px; /* Lebar maksimum */
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
    animation: modalFadeIn 0.3s ease-in-out;
}

/* Form labels and inputs */
#editForm label {
    margin-bottom: 5px;
    font-weight: bold;
    color: #333;
}

#editForm input[type="text"] {
    width: 90%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 16px;
}

/* Full-width styling for buttons */
#editForm > div:last-child {
    grid-column: span 2; /* Membuat tombol di baris terakhir melebar penuh */
    display: flex;
    justify-content: flex-end;
    gap: 10px;
}

/* Buttons */
#editForm button {
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
    transition: background-color 0.2s;
}

#editForm button[type="submit"] {
    background-color: #28a745;
    color: white;
}

#editForm button[type="submit"]:hover {
    background-color: #218838;
}

#editForm button[type="button"] {
    background-color: #dc3545;
    color: white;
}

#editForm button[type="button"]:hover {
    background-color: #c82333;
}

/* Animation */
@keyframes modalFadeIn {
    from {
        opacity: 0;
        transform: translateY(-20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Responsive design */
@media (max-width: 600px) {
    #editForm {
        grid-template-columns: 1fr; /* Menampilkan satu kolom untuk layar kecil */
        padding: 15px;
        width: 100%;
    }

    #editForm input[type="text"],
    #editForm button {
        font-size: 14px;
    }
}


/* Badge styles */
.badge {
    display: inline-block;
    padding: 5px 10px;
    border-radius: 12px;
    font-size: 14px;
    font-weight: bold;
    color: #fff;
    text-align: center;
}

/* Status-specific styles */
.badge-success {
    background-color: #28a745; /* Hijau untuk status sukses */
}

.badge-warning {
    background-color: #ffc107; /* Kuning untuk status peringatan */
    color: #333;
}

.badge-danger {
    background-color: #dc3545; /* Merah untuk status error */
}

.badge-info {
    background-color: #17a2b8; /* Biru untuk status informasi */
}


/* Gaya untuk modal */
#approvalModal {
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 90%; /* Agar modal responsif di perangkat mobile */
    max-width: 600px; /* Batasan lebar maksimum */
    background-color: #fff;
    border-radius: 8px; /* Sudut melengkung */
    padding: 20px;
    border: none;
    box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.3);
    z-index: 1000;
}

/* Gaya untuk konten modal */
.modal-content {
    display: flex;
    flex-direction: column;
    gap: 15px;
}


/* Gaya untuk label dan input */
label {
    font-size: 14px;
    font-weight: bold;
    margin-bottom: 5px;
}

input, select {
    width: 90%;
    padding: 8px 10px;
    margin-bottom: 10px;
    border-radius: 5px;
    border: 1px solid #ccc;
    font-size: 14px;
    transition: border-color 0.3s;
}

input:focus, select:focus {
    border-color: #007bff;
    outline: none;
}




    </style>
</head>
<body>
    <div class="card">
    <?php
    include 'conn.php'; // Pastikan koneksi database sudah di-include
    $sql = "SELECT COUNT(*) AS total_requests FROM request_list";
    $result = $conn->query($sql);

    $totalRequests = 0;
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $totalRequests = $row['total_requests'];
    }

    $sql1 = "SELECT COUNT(*) AS total_requests FROM request_list where `status` = 'waiting' ";
    $result1 = $conn->query($sql1);

    $totalRequests1 = 0;
    if ($result1 && $result1->num_rows > 0) {
        $row1 = $result1->fetch_assoc();
        $totalpending = $row1['total_requests'];
    }
    ?>

<div style="display:flex;  justify-content:end; margin-bottom:20px;">Login As <?php echo isset($_SESSION['username']) ? $_SESSION['username'] : "" ; ?></div>
    <div class="total-request" style="display:flex;">
        <p style="font-weight:bold; margin-right:10px; padding:10px; background-color:#7FFF00; border-radius:20px; ">TOTAL REQUEST: <?php echo $totalRequests; ?> Permintaan</p>
        <p style="font-weight:bold; margin-right:10px; padding:10px; background-color:#F08080; border-radius:20px; ">REQUEST STATUS: <?php echo $totalpending; ?> Permintaan</p>
    </div>

        <table id="dataTable" class="display responsive nowrap card">
        <thead style="background-color:#6495ED;">
            <tr>
                <th>Nip</th>
                <th>Fullname</th>
                <th>Dept</th>
                <th>Permintaan</th>
                <th>Status permintaan</th>
                <th>status kerja</th>
                <th>Device Name</th>
                <th>Eksekutor</th>
                <th>Waktu permintaan</th>
                <th>waktu pengerjaan</th>
                <th>No whatsApp</th>
                <th>Date</th>
                <th>Location</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody id="dataBody">
            <!-- Data akan diisi di sini oleh JavaScript -->
        </tbody>
    </table>
    </div>


    <div id="editModal" style="display: none; ">
    <form id="editForm" method="POST" action="update.php" >
        <input type="hidden" name="id" id="edit_id">
        <div>
            <label for="edit_nip">NIP:</label>
            <input type="text" name="nip" id="edit_nip" required>
        </div>
        <div>
            <label for="edit_fullname">Fullname:</label>
            <input type="text" name="fullname" id="edit_fullname" required>
        </div>
        <div>
            <label for="edit_no_wa">No WA:</label>
            <input type="text" name="no_wa" id="edit_no_wa" required>
        </div>
        <div>
            <label for="edit_dept">Dept:</label>
            <input type="text" name="dept" id="edit_dept" required>
        </div>
        <div>
            <label for="edit_permintaan">Permintaan:</label>
            <input type="text" name="permintaan" id="edit_permintaan" required>
        </div>
        <div>
            <label for="edit_problem_location">Problem Location:</label>
            <input type="text" name="problem_location" id="edit_problem_location" required>
        </div>
        <div>
            <label for="edit_problem_device">Problem Device:</label>
            <input type="text" name="problem_device" id="edit_problem_device" required>
        </div>
        <div>
            <label for="edit_waktu_permintaan">Waktu Permintaan:</label>
            <input type="text" name="waktu_permintaan" id="edit_waktu_permintaan" required>
        </div>
        <div>
            <label for="edit_date">Date:</label>
            <input type="text" name="date" id="edit_date" required>
        </div>
        <div>
            <label for="edit_status">Status:</label>
            <input type="text" name="status" id="edit_status" required readonly>
        </div>
        <div style="display: flex; justify-content: flex-end; gap: 10px;">
            <button type="submit" style="padding: 10px 20px; background-color: #4CAF50; color: #fff; border: none; border-radius: 4px; cursor: pointer;">Update</button>
            <button type="button" onclick="closeModal()" style="padding: 10px 20px; background-color: #f44336; color: #fff; border: none; border-radius: 4px; cursor: pointer;">Cancel</button>
        </div>
    </form>
</div>



<?php
include 'conn.php';

// Query untuk mengambil data dari tabel loggin di mana field admin bernilai 1
$sql = "SELECT nip, `name`, fullname, no_wa FROM loggin WHERE `admin` = 1";
$result = $conn->query($sql);

// Menyimpan data ke dalam array untuk opsi
$options = [];
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $options[] = $row;
    }
} else {
    echo "<!-- Data tidak ditemukan atau query bermasalah -->";
}
?>

<!-- Modal -->
<div id="approvalModal" style="display:none;">
    <div class="modal-content">
        <h2>Approval Form</h2>
        <form id="approvalForm">

            <label for="executorName">Pilih Nama Eksekutor:</label>
            <select id="executorName" name="executorName" required>
                <option value="">-- Pilih Eksekutor --</option>
                <?php if (!empty($options)): ?>
                    <?php foreach ($options as $option): ?>
                        <option value="<?= htmlspecialchars($option['fullname']) ?>">
                            <?= htmlspecialchars($option['name']) ?> (<?= htmlspecialchars($option['fullname']) ?>)
                        </option>
                    <?php endforeach; ?>
                <?php else: ?>
                    <option value="">Tidak ada eksekutor tersedia</option>
                <?php endif; ?>
            </select>
            <br><br>

            <label for="executionDate">Tanggal Pengerjaan:</label>
            <input type="datetime-local" id="executionDate" name="executionDate" required><br><br>

            <button type="submit">Submit</button>
            <button type="button" onclick="closeModal1()">Cancel</button>
        </form>
    </div>
</div>



    <script>

var currentRowId; // Variabel global untuk menyimpan ID baris yang diklik

// Fungsi untuk menampilkan modal
function Aproval(rowId) {
    currentRowId = rowId;
    $('#approvalModal').show();
}

// Fungsi untuk menutup modal
function closeModal1() {
    $('#approvalModal').hide();
}

// Fungsi untuk submit form
$('#approvalForm').submit(function(event) {
    event.preventDefault();

    var executorName = $('#executorName').val();
    var executionDate = $('#executionDate').val();

    // Kirim data ke server melalui AJAX
    $.ajax({
        url: 'update_request.php', // Ganti dengan URL PHP Anda untuk memproses update
        type: 'POST',
        data: {
            id: currentRowId,
            executor: executorName,
            execution_date: executionDate
        },
        success: function(response) {
            alert('Data berhasil diperbarui');
            $('#approvalModal').hide();
            loadData();
            location.reload();
        },
        error: function() {
            alert('Gagal memperbarui data');
        }
    });
});

 // Fungsi untuk memuat data secara berkala
 function loadData() {
            $.ajax({
                url: 'data.php',
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    var tableBody = '';
                    data.forEach(function(row) {
                        var badgeClass = '';
                        switch (row.status.toLowerCase()) {
                            case 'accepted':
                                badgeClass = 'badge-success';
                                break;
                            case 'waiting':
                                badgeClass = 'badge-warning';
                                break;
                            case 'close':
                                badgeClass = 'badge-danger';
                                break;
                            default:
                                badgeClass = 'badge-warning';
                        };
                        var badgeClass1 = '';
                        switch (row.status_pekerjaan) {
                            case 'on progress':
                                badgeClass1 = 'badge-warning';
                                break;
                            case 'completed':
                                badgeClass1 = 'badge-success';
                                break;
                            default:
                                badgeClass1 = 'badge-danger';
                        }

                        tableBody += `
                            <tr>
                                <td>${row.nip}</td>
                                <td>${row.fullname}</td>
                                <td>${row.dept}</td>
                                <td>${row.permintaan}</td>
                                <td><span class="badge ${badgeClass}">${row.status}</span></td>
                                <td><span class="badge ${badgeClass1}">${row.status_pekerjaan}</span></td>
                                <td>${row.problem_device}</td>
                                <td>${row.eksekutor}</td>
                                <td>${row.waktu_permintaan}</td>
                                <td>${row.waktu_pengerjaan}</td>
                                <td>${row.no_wa}</td>
                                <td>${row.date}</td>
                                <td>${row.problem_location}</td>
                                <td>
                                    <button class='edit-button' onclick="editData(${row.id})">Edit</button>
                                    <button class='delete-button' onclick="confirmDelete(${row.id})">Tolak & Hapus</button>
                                    <button class='aprove-button' onclick="Aproval(${row.id})">Aprove</button>
                                </td>
                            </tr>`;
                    });

                    $('#dataBody').html(tableBody);

                    // Setelah data dimuat, inisialisasi DataTable
                    $('#dataTable').DataTable({
                        responsive: true,
                        paging: true,
                        searching: true,
                        ordering: true,
                        info: true,
                        destroy: true, // Hapus instance DataTable yang sebelumnya agar tidak duplikat
                        columnDefs: [
                            { orderable: true, targets: '_all' }
                        ]
                    });
                },
                error: function() {
                    console.log('Gagal memuat data');
                }
            });
        }

        // Panggil fungsi loadData setiap 5 detik
        // setInterval(loadData, 1000);

        // Panggil pertama kali saat halaman dimuat
        $(document).ready(function() {
            loadData();
        });



        // $(document).ready(function() {
        //     $('#dataTable').DataTable({
        //         responsive: true,
        //         paging: true,
        //         searching: true,
        //         ordering: true,
        //         info: true,
        //         columnDefs: [
        //             { orderable: true, targets: '_all' }
        //         ]
        //     });
        // });

        function confirmDelete(id) {
            if (confirm("Apakah Anda yakin ingin menghapus data ini?")) {
                window.location.href = 'delete.php?id=' + id;
            }
        }

        // function Aproval(id) {
        //     console.log("hai");
        // }

        function editData(id) {
    console.log('ID yang diterima di fungsi:', id); // Debug ID

    fetch('get_data.php?id=' + id)
        .then(response => response.json())
        .then(data => {
            console.log('Data yang diterima dari server:', data); // Debug data JSON

            if (data.error) {
                alert(data.error);
                return;
            }

            // Isi form modal dengan data yang diambil
            document.getElementById('edit_id').value = data.id;
            document.getElementById('edit_nip').value = data.nip;
            document.getElementById('edit_fullname').value = data.fullname;
            document.getElementById('edit_no_wa').value = data.no_wa;
            document.getElementById('edit_dept').value = data.dept;
            document.getElementById('edit_permintaan').value = data.permintaan;
            document.getElementById('edit_problem_location').value = data.problem_location;
            document.getElementById('edit_problem_device').value = data.problem_device;
            document.getElementById('edit_waktu_permintaan').value = data.waktu_permintaan;
            document.getElementById('edit_date').value = data.date;
            document.getElementById('edit_status').value = data.status;

            // Tampilkan modal
            document.getElementById('editModal').style.display = 'flex';
        })
        .catch(error => {
            console.error('Error:', error);
        });
}



    function closeModal() {
        document.getElementById('editModal').style.display = 'none';
    }



    </script>
</body>
</html>
