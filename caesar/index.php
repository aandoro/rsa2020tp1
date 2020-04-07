<?php
include 'caesar.php';

$mensaje = $_POST['mensaje'];
$semilla = $_POST['semilla'];
$tarea = $_POST['tarea'];
$salida = '';


$cipher = new Caesar($mensaje, $semilla);

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
        <input type="text" name="semilla" required><br><br>

        <input type="submit" name="tarea" value="Cifrar">
        <input type="submit" name="tarea" value="Descifrar">
    </form>

    <strong>La respuesta es:</strong> <br>
    <p><?php echo$salida ?></p>
</body>

</html>