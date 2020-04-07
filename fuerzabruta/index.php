<?php

include '../caesar/caesar.php';

$mensaje = $_POST['mensaje'];
$salida = $salida_final = '';
$cantidad_total = $clave_exitosa = 0;

if (isset($_POST['tarea'])) {
    for ($i = 1; $i < 4; $i++) {
        $cantidad_apariciones = 0;
        $cipher = new Caesar($mensaje, $i);
        $salida = $cipher->decode();
        $palabras = explode(' ', $salida);
        //recorrer las palabras de salida
        for ($j = 0; $j < count($palabras); $j++) {
            $pal_comp = preg_replace('/\s+/', '', strtolower($palabras[$j]));
            $palabras[$j] = str_replace(' ', '', $palabras[$j]);
            $dic = fopen('listado-general.txt', 'r');
            while (!feof($dic)) {
                $dic_comparar = fgets($dic);
                $dic_comparar = preg_replace('/\s+/', '', $dic_comparar);
                //fijarse si esta en el diccionario
                if (strcmp($pal_comp, $dic_comparar) === 0) {
                    //sumar un hit
                    $cantidad_apariciones++;
                }
            }
            if ($cantidad_apariciones > $cantidad_total) {
                $cantidad_total = $cantidad_apariciones;
                $salida_final = $salida;
                $clave_exitosa = $i;
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
    <p><?php echo 'Mensaje: ' . $salida_final . ' Cantidad de ocurrencias: ' . $cantidad_total . ' con clave: ' . $clave_exitosa ?></p>
</body>

</html>