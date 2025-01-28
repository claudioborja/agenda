<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

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

// Procesar el formulario si se envió
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $telefono = $_POST['telefono'];
    $email = $_POST['email'];
    $direccion = $_POST['direccion'];

    // Insertar datos en la base de datos
    $sql = "INSERT INTO contactos (nombre, telefono, email, direccion) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $nombre, $telefono, $email, $direccion);

    if ($stmt->execute()) {
        // Redirigir a la página de administración después de agregar
        header("Location: admin.php");
        exit();
    } else {
        echo "<script>alert('Error al agregar el contacto: " . $stmt->error . "');</script>";
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Añadir Contacto</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .container {
            width: 90%;
            max-width: 600px;
            background: #ffffff;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            border-radius: 12px;
            overflow: hidden;
            margin-top: 50px;
        }

        .header {
            background-color: #4caf50;
            color: white;
            padding: 20px;
            text-align: center;
            font-size: 1.8rem;
        }

        .form {
            padding: 20px;
        }

        .form input[type="text"],
        .form input[type="email"] {
            width: calc(100% - 20px);
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 1rem;
        }

        .form button {
            width: 100%;
            background-color: #4caf50;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 1rem;
            cursor: pointer;
            border-radius: 8px;
            margin-top: 10px;
            transition: background-color 0.3s;
        }

        .form button:hover {
            background-color: #45a049;
        }

        .footer {
            text-align: center;
            padding: 10px;
            font-size: 0.9rem;
            background-color: #f4f4f9;
            color: #888;
            width: 100%;
            position: fixed;
            bottom: 0;
            left: 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">Añadir Contacto</div>

        <div class="form">
            <form action="agregar.php" method="POST">
                <input type="text" name="nombre" placeholder="Nombre" required>
                <input type="text" name="telefono" placeholder="Teléfono" required>
                <input type="email" name="email" placeholder="Email" required>
                <input type="text" name="direccion" placeholder="Dirección" required>
                <button type="submit">Añadir</button>
                <button onclick="history.back()" style="margin-top: 15px; background-color: #f44336; color: white; border: none; padding: 10px 20px; border-radius: 8px; cursor: pointer;">Volver</button>
              
            </form>
        </div>

        <div class="footer">
            &copy; 2025 Agenda de Contactos. Todos los derechos reservados.
        </div>
    </div>
</body>
</html>
