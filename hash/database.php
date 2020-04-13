<?php

class Database
{
    public function crearBasedatos()
    {
        try {
            $conn = new PDO("mysql:host=" . HOST, USER_DB, PASS_DB);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "CREATE DATABASE ars2020";
            // use exec() because no results are returned
            $conn->exec($sql);
            //echo "Database created successfully<br>";
        } catch (PDOException $e) {
            //echo $sql . "<br>" . $e->getMessage();
        }
        $conn = null;
    }

    public function CrearTabla($conn)
    {
        try {
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // sql to create table
            $sql = "CREATE TABLE ars2020.usuarios (
                usuario varchar(100) NOT NULL,
                clave varchar(100) NOT NULL,
                CONSTRAINT usuarios_PK PRIMARY KEY (usuario)
            )
            ENGINE=InnoDB
            DEFAULT CHARSET=utf8mb4
            COLLATE=utf8mb4_general_ci;";

            // use exec() because no results are returned
            $conn->exec($sql);
            //echo "Table usuarios created successfully";
        } catch (PDOException $e) {
            //echo $sql . "<br>" . $e->getMessage();
        }
    }
}
