<?php
include './constantes.php';
include './database.php';

$usuario_ing = $_POST['nombre'];
$clave_ing = $_POST['contra'];
$msj = '';
$db = new Database();

try {
    $db->crearBasedatos();

    $conn = new PDO("mysql:host=" . HOST . ";dbname=" . DATABASE, USER_DB, PASS_DB);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


    $db->CrearTabla($conn);
} catch (PDOException $e) {
    $msj = '<p style="color: red">Fallo la conexion a la base de datos</p>';
    echo "Connection failed: " . $e->getMessage();
}

if (isset($_POST['ing'])) {
    try {
        $stmt = $conn->prepare("SELECT usuario, clave FROM usuarios WHERE usuario='$usuario_ing'");
        $stmt->execute();

        $obj = $stmt->fetch();
        $clave_hash = md5($clave_ing);

        $salt = explode($clave_hash, $obj[1]);

        $clave_hash .= $salt[1];
        if (strcmp($obj[1], $clave_hash) === 0) {
            $msj = '<p style="color: green">Bienvenido! ' . $usuario_ing . '</p>';
        } else {
            $msj = '<p style="color: red">Usuario y/o contraseña invalida</p>';
        }
    } catch (PDOException $e) {
        $msj = '<p style="color: red">Usuario y/o contraseña invalida</p>';
        echo "Error: " . $e->getMessage();
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ARS2020</title>
</head>

<body>
    <h3>Inicio de sesion: </h3>
    <form action="index.php" method="post">
        <p>Ingrese usuario: </p>
        <input type="text" name="nombre" id="nombre" required>
        <p>Ingrese contraseña: </p>
        <input type="password" name="contra" id="contra" required>
        <br><br>
        <button type="submit" name="ing">Ingresar</button>
    </form>
    <br>
    <form action="registrar.php" method="get">
        <button type="submit">registrarse</button>
    </form>
    <?php echo $msj ?>
</body>

</html>