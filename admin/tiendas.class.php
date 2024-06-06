<?php
require_once __DIR__ . '/sistema.class.php';
class Tienda extends Sistema
{
    function getAll()
    {
        $this->connect();
        $stmt = $this->conn->prepare("SELECT * FROM tienda;");
        $stmt->execute();
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $datos = $stmt->fetchAll();
        $this->setCount(count($datos));
        return $datos;
    }

    function getOne($id_tienda)
    {
        $this->connect();
        $stmt = $this->conn->prepare("SELECT * FROM tienda WHERE id_tienda = :id_tienda;");
        $stmt->bindParam(':id_tienda', $id_tienda, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $datos = array();
        $datos = $stmt->fetchAll();
        if (isset($datos[0])) {
            $this->setCount(count($datos));
            return $datos[0];
        }
        return $datos;
    }

    function insert($datos)
    {
        $this->connect();
        $nombre_archivo = $this->upload('tiendas');
        if ($this->validateTienda($datos)) {
            if ($datos['latitud'] && $datos['longitud']) {
                if ($nombre_archivo) {
                    $stmt = $this->conn->prepare("INSERT INTO tienda(tienda, fotografia, latitud, longitud) VALUES (:tienda, :fotografia, :latitud, :longitud);");
                    $stmt->bindParam(':latitud', $datos['latitud'], PDO::PARAM_STR);
                    $stmt->bindParam(':longitud', $datos['longitud'], PDO::PARAM_STR);
                    $stmt->bindParam(':fotografia', $nombre_archivo, PDO::PARAM_STR);
                } else {
                    $stmt = $this->conn->prepare("INSERT INTO tienda(tienda, latitud, longitud) VALUES (:tienda, :latitud, :longitud);");
                    $stmt->bindParam(':latitud', $datos['latitud'], PDO::PARAM_STR);
                    $stmt->bindParam(':longitud', $datos['longitud'], PDO::PARAM_STR);
                }
            } else {
                if ($nombre_archivo) {
                    $stmt = $this->conn->prepare("INSERT INTO tienda(tienda, fotografia) VALUES (:tienda, :fotografia);");
                    $stmt->bindParam(':fotografia', $nombre_archivo, PDO::PARAM_STR);
                } else {
                    $stmt = $this->conn->prepare("INSERT INTO tienda(tienda) VALUES (:tienda);");
                }
            }
            $stmt->bindParam(':tienda', $datos['tienda'], PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->rowCount();
        }
    }

    function delete($id_tienda)
    {
        $this->connect();
        $stmt = $this->conn->prepare("DELETE FROM tienda WHERE id_tienda = :id_tienda;");
        $stmt->bindParam(':id_tienda', $id_tienda, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->rowCount();
        return $result;
    }

    function update($id_tienda, $datos)
    {
        $this->connect();
        $nombre_archivo = $this->upload('tiendas');
        if ($this->validateTienda($datos)) {
            if ($datos['latitud'] && $datos['longitud']) {
                if ($nombre_archivo) {
                    $stmt = $this->conn->prepare("UPDATE tienda SET tienda = :tienda, fotografia = :fotografia, latitud = :latitud, longitud = :longitud WHERE id_tienda = :id_tienda;");
                    $stmt->bindParam(':latitud', $datos['latitud'], PDO::PARAM_STR);
                    $stmt->bindParam(':longitud', $datos['longitud'], PDO::PARAM_STR);
                    $stmt->bindParam(':fotografia', $nombre_archivo, PDO::PARAM_STR);
                } else {
                    $stmt = $this->conn->prepare("UPDATE tienda SET tienda = :tienda, latitud = :latitud, longitud = :longitud WHERE id_tienda = :id_tienda;");
                    $stmt->bindParam(':latitud', $datos['latitud'], PDO::PARAM_STR);
                    $stmt->bindParam(':longitud', $datos['longitud'], PDO::PARAM_STR);
                }
            } else {
                if ($nombre_archivo) {
                    $stmt = $this->conn->prepare("UPDATE tienda SET tienda = :tienda, fotografia = :fotografia WHERE id_tienda = :id_tienda;");
                    $stmt->bindParam(':fotografia', $nombre_archivo, PDO::PARAM_STR);
                } else {
                    $stmt = $this->conn->prepare("UPDATE tienda SET tienda = :tienda WHERE id_tienda = :id_tienda;");
                }
            }
            $stmt->bindParam(':tienda', $datos['tienda'], PDO::PARAM_STR);
            $stmt->bindParam(':id_tienda', $id_tienda, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->rowCount();
        }
    }

    function validateTienda($datos)
    {
        if (empty($datos["tienda"]))
            return false;

        return true;
    }
}
