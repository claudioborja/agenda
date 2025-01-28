<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

if (isset($_GET['id'])) {
    $servername = "localhost";
    $username = "unemi";
    $password = "unemi";
    $dbname = "agenda";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    $id = $_GET['id'];
    $sql = "DELETE FROM contactos WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header("Location: admin.php");
        exit();
    } else {
        echo "Error al eliminar el contacto.";
    }

    $stmt->close();
    $conn->close();
} else {
    header("Location: admin.php");
    exit();
}
?>
