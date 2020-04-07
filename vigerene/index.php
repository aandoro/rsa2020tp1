<?php
include 'vigerene.php';

$mensaje = $_POST['mensaje'];
$clave = $_POST['clave'];
$tarea = $_POST['tarea'];
$salida = '';

$cipher = new Vigerene($mensaje, $clave);

if ($_POST['tarea'] == "Cifrar") {
    $salida = $cipher->encode();
} else {
    $salida = $cipher->decode();
}

?>

<html>

<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>ARS2020</title>
</head>

<body>
    <h1>criptografica semantica</h1>

    <form method="post" action="index.php">
        <strong>Mensaje a cifrar/descifrar:</strong> <br>
        <textarea name="mensaje" required></textarea><br><br>

        <strong>Clave:</strong> <br>
        <input type="text" name="clave" required><br><br>

        <input type="submit" name="tarea" value="Cifrar">
        <input type="submit" name="tarea" value="Descifrar">
    </form>

    <strong>La respuesta es:</strong> <br>
    <p><?php echo$salida ?></p>
</body>

</html>