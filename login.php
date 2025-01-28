<?php
session_start();

// Conexión a la base de datos
$servername = "localhost";
$username = "unemi";
$password = "unemi";
$dbname = "agenda";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = $_POST['username'];
    $pass = $_POST['password'];

    // Consulta para verificar usuario
    $sql = "SELECT * FROM usuarios WHERE username = ? AND password = MD5(?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $user, $pass);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $_SESSION['username'] = $row['username'];
        $_SESSION['rol'] = $row['rol'];
        header("Location: admin.php");
        exit();
    } else {
        echo "<script>alert('Usuario o contraseña incorrectos'); window.location.href = 'index.php';</script>";
    }

    $stmt->close();
}

$conn->close();
?>