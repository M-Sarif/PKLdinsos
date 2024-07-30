<?php
session_start();

// Check if both biodata and account data are set
if (!isset($_SESSION['biodata']) || !isset($_SESSION['account'])) {
    header("Location: create1.php");
    exit();
}

// Database connection
include 'config/koneksi.php';
if ($conn->connect_error) {
    die("Koneksi database gagal: " . $conn->connect_error);
}

// Start transaction
$conn->begin_transaction();

try {
    // Insert into user table
    $stmt = $conn->prepare("INSERT INTO user (email, password) VALUES (?, ?)");
    $hashed_password = password_hash($_SESSION['account']['password'], PASSWORD_DEFAULT);
    $stmt->bind_param("ss", $_SESSION['account']['email'], $hashed_password);
    $stmt->execute();
    $id_user = $conn->insert_id;
    
    // Insert into pemohon table
    $stmt = $conn->prepare("INSERT INTO pemohon (nama, alamat, tgl_lahir, jenis_kelamin, telepon, id_user) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssi", 
        $_SESSION['biodata']['nama'], 
        $_SESSION['biodata']['alamat'], 
        $_SESSION['biodata']['tgl_lahir'], 
        $_SESSION['biodata']['jenis_kelamin'], 
        $_SESSION['biodata']['telepon'], 
        $id_user
    );
    $stmt->execute();
    
    // Commit transaction
    $conn->commit();
    
    // Clear session data
    unset($_SESSION['biodata']);
    unset($_SESSION['account']);
    
    // Redirect to success page
    header("Location: index.php");
    exit();
} catch (Exception $e) {
    // Rollback transaction on error
    $conn->rollback();
    echo "Pendaftaran gagal: " . $e->getMessage();
}

$conn->close();
?>