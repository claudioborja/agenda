
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

$row = null;

// Verificar si es una solicitud POST para actualizar el contacto
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $telefono = $_POST['telefono'];
    $email = $_POST['email'];
    $direccion = $_POST['direccion'];

    // Actualizar los datos en la base de datos
    $sql = "UPDATE contactos SET nombre = ?, telefono = ?, email = ?, direccion = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssi", $nombre, $telefono, $email, $direccion, $id);

    if ($stmt->execute()) {
        // Redirigir a la página de administración después de actualizar
        header("Location: admin.php");
        exit();
    } else {
        echo "<script>alert('Error al actualizar el contacto: " . $stmt->error . "');</script>";
    }

    $stmt->close();
} else {
    // Verificar si se proporciona el parámetro ID en la URL para cargar los datos
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "SELECT * FROM contactos WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $row = $result->fetch_assoc();
        } else {
            echo "<script>alert('Contacto no encontrado.'); window.location.href = 'admin.php';</script>";
            exit();
        }

        $stmt->close();
    } else {
        echo "<script>alert('ID de contacto no proporcionado.'); window.location.href = 'admin.php';</script>";
        exit();
    }
}

$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Contacto</title>
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
        <div class="header">Editar Contacto</div>

        <div class="form">
            <form action="editar.php" method="POST">
                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                <input type="text" name="nombre" placeholder="Nombre" value="<?php echo $row['nombre']; ?>" required>
                <input type="text" name="telefono" placeholder="Teléfono" value="<?php echo $row['telefono']; ?>" required>
                <input type="email" name="email" placeholder="Email" value="<?php echo $row['email']; ?>" required>
                <input type="text" name="direccion" placeholder="Dirección" value="<?php echo $row['direccion']; ?>" required>
                <button type="submit">Actualizar</button>
            </form>
        </div>

        <div class="footer">
            &copy; 2025 Agenda de Contactos. Todos los derechos reservados.
        </div>
    </div>
</body>
</html>
