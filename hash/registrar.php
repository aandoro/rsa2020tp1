<?php
include './constantes.php';

$msj = '';
$clave_env = $_POST['contra'];
$clave_c_env = $_POST['c_contra'];
$usuario_env = $_POST['nombre'];

try {
    $conn = new PDO("mysql:host=" . HOST . ";dbname=" . DATABASE, USER_DB, PASS_DB);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    $msj = '<p style="color: red">Fallo la conexion a la base de datos</p>';
    //echo "Connection failed: " . $e->getMessage();
}

if (isset($_POST['reg'])) {
    if (strcmp($clave_env, $clave_c_env) !== 0) {
        $msj = '<p style="color: red">Las contraseñas son distintas</p>';
    } else {
        try {
            $salt = generateRandomString();
            $clave = md5($clave_env);
            $clave .= $salt;
            $sql = "INSERT INTO usuarios (usuario, clave) VALUES ('$usuario_env','$clave')";
            // use exec() because no results are returned
            $conn->exec($sql);
            $msj = '<p style="color: green">' . $usuario_env . ' registrado correctamente</p>';
        } catch (PDOException $e) {
            $msj = '<p style="color: red">Ocurrio un error al querer registrarlo</p>';
            //echo $sql . "<br>" . $e->getMessage();
        }
    }
}

function generateRandomString($length = 10)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
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
    <h2>Registrarse:</h2>
    <form action="registrar.php" method="post">
        <p>Nombre:</p>
        <input type="text" name="nombre" id="nombre" required>
        <p>Contraseña:</p>
        <input type="password" name="contra" id="contra" required>
        <p>Confirmar contraseña:</p>
        <input type="password" name="c_contra" id="c_contra" required>
        <br><br>
        <button type="submit" name="reg">Registrarse</button>
    </form>
    <br>
    <form action="index.php" method="get">
        <button type="submit">Volver</button>
    </form>
    <?php echo $msj ?>
</body>

</html>