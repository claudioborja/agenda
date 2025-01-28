<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

// Credenciales de la base de datos
$servername = "localhost";
$username = "unemi";
$password = "unemi";
$dbname = "agenda";

// Conexión a la base de datos
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}


// Consultar contactos
$sql = "SELECT * FROM contactos";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Agenda de Contactos</title>
    <style>
          body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            width: 90%;
            max-width: 1200px;
            background: #ffffff;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            border-radius: 12px;
            overflow: hidden;
        }

        .header {
            background-color: #4caf50;
            color: white;
            padding: 20px;
            text-align: center;
            font-size: 1.8rem;
        }

        .login-form {
            padding: 20px;
            border-bottom: 1px solid #ddd;
            text-align: center;
        }

        .login-form input[type="text"],
        .login-form input[type="password"] {
            width: calc(100% - 40px);
            max-width: 400px;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 1rem;
        }

        .login-form button {
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

        .login-form button:hover {
            background-color: #45a049;
        }

        .contacts {
            padding: 20px;
        }

        .contacts table {
            width: 100%;
            border-collapse: collapse;
        }

        .contacts th, .contacts td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .contacts th {
            background-color: #4caf50;
            color: white;
        }

        .contacts tr:hover {
            background-color: #f1f1f1;
        }

        .contacts tr:nth-child(even) {
            background-color: #f9f9f9;
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
<div class="header">
    Admin - Agenda de Contactos
    <div style="float: right;">
        <a href="logout.php" style="color: white; text-decoration: none; margin-left: 15px;">Cerrar Sesión</a>
        <a href="agregar.php" style="color: white; text-decoration: none; margin-left: 15px;">Añadir Contacto</a>
    </div>
</div>

    <div class="container">
        <div class="header">Admin - Agenda de Contactos</div>

        <div class="contacts">
            <h2>Lista de Contactos</h2>
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Teléfono</th>
                        <th>Email</th>
                        <th>Dirección</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row['id'] . "</td>";
                            echo "<td>" . $row['nombre'] . "</td>";
                            echo "<td>" . $row['telefono'] . "</td>";
                            echo "<td>" . $row['email'] . "</td>";
                            echo "<td>" . $row['direccion'] . "</td>";
                            echo "<td>";
                            echo "<a href='editar.php?id=" . $row['id'] . "'>Editar</a> | ";
                            echo "<a href='eliminar.php?id=" . $row['id'] . "' onclick='return confirm(\"¿Estás seguro?\");'>Eliminar</a>";
                            echo "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6'>No hay contactos disponibles</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <div class="footer">
            &copy; 2025 Agenda de Contactos. Todos los derechos reservados.
        </div>
    </div>
</body>
</html>

<?php $conn->close(); ?>
