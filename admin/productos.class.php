<?php
if (basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"])) {
    header('Location: productos.php');
    die;
}
require __DIR__ . "/sistema.class.php";

class Productos extends Sistema
{
    function getAll()
    {
        $this->connect();
        $stmt = $this->conn->prepare("SELECT p.id_producto AS id_producto, p.producto AS producto, p.precio AS precio, m.id_marca AS id_marca, m.marca AS marca, p.fotografia AS fotografia FROM producto p LEFT JOIN marca m ON p.id_marca = m.id_marca ORDER BY id_producto;");
        $stmt->execute();
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $datos = $stmt->fetchAll();
        $this->setCount(count($datos));
        return $datos;
    }

    function getOne($id_producto)
    {
        $this->connect();
        $stmt = $this->conn->prepare("SELECT id_producto, producto, precio, id_marca , fotografia AS fotografia FROM producto WHERE id_producto = :id_producto;");
        $stmt->bindParam(':id_producto', $id_producto, PDO::PARAM_INT);
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
        $nombre_archivo = $this->upload('productos');
        if ($this->validateProducto($datos)) {
            $stmt = $this->conn->prepare("SELECT COUNT(*) AS count FROM marca WHERE id_marca = :id_marca");
            $stmt->bindParam(':id_marca', $datos['id_marca'], PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            $marca_exists = $result['count'] > 0;
            if ($marca_exists) {
                if ($nombre_archivo) {
                    $stmt = $this->conn->prepare("INSERT INTO producto(producto, precio, id_marca, fotografia) VALUES (:producto, :precio, :id_marca, :fotografia);");
                    $stmt->bindParam(':fotografia', $nombre_archivo, PDO::PARAM_STR);
                } else {
                    $stmt = $this->conn->prepare("INSERT INTO producto(producto, precio, id_marca) VALUES (:producto, :precio, :id_marca);");
                }
                $stmt->bindParam(':producto', $datos['producto'], PDO::PARAM_STR);
                $stmt->bindParam(':precio', $datos['precio'], PDO::PARAM_STR);
                $stmt->bindParam(':id_marca', $datos['id_marca'], PDO::PARAM_INT);
                $stmt->execute();
            } else {
                return 0;
            }
            return $stmt->rowCount();
        }
        return 0;
    }

    function delete($id_producto)
    {
        $this->connect();
        $stmt = $this->conn->prepare("DELETE FROM producto WHERE id_producto = :id_producto;");
        $stmt->bindParam(':id_producto', $id_producto, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->rowCount();
        return $result;
    }

    function update($id_producto, $datos)
    {
        $this->connect();
        $nombre_archivo = $this->upload('productos');
        $stmt = $this->conn->prepare("SELECT COUNT(*) AS count FROM marca WHERE id_marca = :id_marca");
        $stmt->bindParam(':id_marca', $datos['id_marca'], PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $marca_exists = $result['count'] > 0;

        if ($marca_exists) {
            if ($nombre_archivo) {
                $stmt = $this->conn->prepare("UPDATE producto SET producto = :producto, precio = :precio, id_marca = :id_marca, fotografia = :fotografia WHERE id_producto = :id_producto;");
                $stmt->bindParam(':fotografia', $nombre_archivo, PDO::PARAM_STR);
            } else {
                $stmt = $this->conn->prepare("UPDATE producto SET producto = :producto, precio = :precio, id_marca = :id_marca WHERE id_producto = :id_producto;");
            }
            // $stmt = $this->conn->prepare("UPDATE producto SET producto = :producto, precio = :precio, id_marca = :id_marca, fotografia = :fotografia WHERE id_producto = :id_producto;");
            $stmt->bindParam(":producto", $datos["producto"], PDO::PARAM_STR);
            $stmt->bindParam(":precio", $datos["precio"], PDO::PARAM_STR);
            $stmt->bindParam(":id_marca", $datos["id_marca"], PDO::PARAM_INT);
            $stmt->bindParam(':id_producto', $id_producto, PDO::PARAM_INT);
            $stmt->execute();
        } else {
            return 0;
        }
        return $stmt->rowCount();
    }

    public function marketplaceBosch()
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://ferreteriagustavo.000webhostapp.com/productos.api.php',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
        )
        );
        $response = curl_exec($curl);
        curl_close($curl);
        $datos = json_decode($response);
        return $datos;
    }

    function validateProducto($datos)
    {
        if (empty($datos["producto"])) {
            return false;
        }
        return true;
    }
}
