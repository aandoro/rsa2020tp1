<?php

include '../caesar/caesar.php';

$mensaje = $_POST['mensaje'];
$salida = '';


if (isset($_POST['tarea'])) {
    for ($i = 1; $i < 4; $i++) {
        $cantidad_apariciones = 0;
        $cipher = new Caesar($mensaje, $i);
        $salida = $cipher->decode();
        $palabras = explode(' ', $salida);
        //recorrer las palabras de salida
        for ($j = 0; $j < count($palabras); $j++) {
            $palabras[$j] = str_replace(' ', '', $palabras[$j]);
            $dic = fopen('Spanish.txt', 'r');
            while (!feof($dic)) {
                $dic_comparar = fgets($dic);
                $dic_comparar = str_replace('\n', '', $dic_comparar);
                $dic_comparar = str_replace(' ', '', $dic_comparar);
                //fijarse si esta en el diccionario
                echo strtolower($palabras[$j]) . ' , ' . $dic_comparar . ' = ' . strcmp(strtolower($palabras[$j]), $dic_comparar) . '<br>';
                //echo strtolower($palabras[$j]) . ' , ' . $dic_comparar . ' = ' . (strtolower($palabras[$j]) ===  $dic_comparar) . '<br>';
                if (strcmp(strtolower($palabras[$j]), $dic_comparar) === 0) {
                    //sumar un hit
                    echo 'hay coindidencia<br>';
                }
            }
            fclose($dic);
        }
    }
}




?>

<html>

<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>ARS2020</title>
</head>

<body>
    <h1>criptografica semantica - Fuerza bruta</h1>

    <form method="post" action="index.php">
        <strong>Mensaje a descifrar:</strong> <br>
        <textarea name="mensaje" required></textarea><br><br>

        <input type="submit" name="tarea" value="Descifrar">
    </form>

    <strong>La respuesta es:</strong> <br>
    <p><?php echo $salida ?></p>
</body>

</html>