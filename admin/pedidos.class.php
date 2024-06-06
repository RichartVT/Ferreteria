<?php
include __DIR__ . '/sistema.class.php';

class Pedidos extends Sistema
{
    public function getAll()
    {
        $this->connect();
        $stmt = $this->conn->prepare("SELECT * FROM orders ORDER BY id_venta;");
        $stmt->execute();
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $datos = $stmt->fetchAll();
        return $datos;
    }

    public function getOne($id_venta)
    {
        $datos = array();
        $this->connect();
        $stmt = $this->conn->prepare("SELECT * FROM orders WHERE id_venta = :id_venta;");
        $stmt->bindParam(':id_venta', $id_venta, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $datos = $stmt->fetchAll();
        $sql = "SELECT id_producto, producto, cantidad, monto FROM order_detail WHERE id_venta = :id_venta";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id_venta', $id_venta, PDO::PARAM_INT);
        $stmt->execute();
        $detalle = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $detalle = $stmt->fetchAll();
        if (isset($datos[0])) {
            $datos[0]['detalle'] = $detalle;
            return $datos[0];
        }
        return $datos;
    }

    public function delete($id_venta)
    {
        $this->connect();
        $this->conn->beginTransaction();
        $sql = "DELETE FROM venta_detalle WHERE id_venta = :id_venta";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id_venta', $id_venta, PDO::PARAM_INT);
        $stmt->execute();
        $sql = "DELETE FROM venta WHERE id_venta = :id_venta";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id_venta', $id_venta, PDO::PARAM_INT);
        $stmt->execute();
        $this->conn->commit();
        return $stmt->rowCount();
    }

    public function insertAPI($datos)
    {
        $this->connect();
        $this->conn->beginTransaction();
        $sql = "INSERT INTO venta (id_cliente, id_empleado, id_tienda, fecha) VALUES (:id_cliente,:id_empleado,:id_tienda,:fecha);";
        $stmt = $this->conn->prepare($sql);
        $id_empleado = 4;
        $stmt->bindParam(':id_cliente', $datos['id_cliente'], PDO::PARAM_INT);
        $stmt->bindParam(':id_empleado', $id_empleado, PDO::PARAM_INT);
        $stmt->bindParam(':id_tienda', $datos['id_tienda'], PDO::PARAM_INT);
        $stmt->bindParam(':fecha', $datos['fecha'], PDO::PARAM_STR);
        $stmt->execute();
        $filasAfetadas = $stmt->rowCount();
        if ($filasAfetadas) {
            $sql = "SELECT v.id_venta FROM venta v WHERE id_cliente = ? ORDER BY 1 DESC LIMIT 1;";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(1, $datos['id_cliente'], PDO::PARAM_INT);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $venta = $stmt->fetchAll();
            if (isset($venta[0])) {
                foreach ($datos['detalle'] as $detalle) {
                    $sql = "INSERT INTO venta_detalle (id_venta, id_producto, cantidad) VALUES (:id_venta, :id_producto, :cantidad);";
                    $stmt = $this->conn->prepare($sql);
                    $stmt->bindParam(':id_venta', $venta[0]['id_venta'], PDO::PARAM_INT);
                    $stmt->bindParam(':id_producto', $detalle['id_producto'], PDO::PARAM_INT);
                    $stmt->bindParam(':cantidad', $detalle['cantidad'], PDO::PARAM_INT);
                    $stmt->execute();
                }
                $this->conn->commit();
                return 1;
            } else {
                $this->conn->rollBack();
                return 0;
            }
        }
    }
}