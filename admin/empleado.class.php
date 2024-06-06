<?php
require_once __DIR__ . '/sistema.class.php';
class Empleado extends Sistema
{
    function getAll()
    {
        $this->connect();
        $stmt = $this->conn->prepare("SELECT * FROM empleado;");
        $stmt->execute();
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $datos = $stmt->fetchAll();
        $this->setCount(count($datos));
        return $datos;
    }

    function getOne($id_empleado)
    {
        $this->connect();
        $stmt = $this->conn->prepare("SELECT * FROM empleado WHERE id_empleado = :id_empleado;");
        $stmt->bindParam(':id_empleado', $id_empleado, PDO::PARAM_INT);
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
        if ($this->validateEmpleado($datos)) {
            if (isset($datos['foto'])) {
                $foto = $datos['foto'];
                $stmt = $this->conn->prepare("INSERT INTO empleado(nombre, primer_apellido, segundo_apellido, rfc, curp, fotografia) VALUES (:nombre, :primer_apellido, :segundo_apellido, :rfc, :curp, :fotografia);");
                $stmt->bindParam(':fotografia', $foto, PDO::PARAM_LOB);
            } else {
                $stmt = $this->conn->prepare("INSERT INTO empleado(nombre, primer_apellido, segundo_apellido, rfc, curp) VALUES (:nombre, :primer_apellido, :segundo_apellido, :rfc, :curp);");
            }
            $stmt->bindParam(':nombre', $datos['nombre'], PDO::PARAM_STR);
            $stmt->bindParam(':primer_apellido', $datos['primer_apellido'], PDO::PARAM_STR);
            $stmt->bindParam(':segundo_apellido', $datos['segundo_apellido'], PDO::PARAM_STR);
            $stmt->bindParam(':rfc', $datos['rfc'], PDO::PARAM_STR);
            $stmt->bindParam(':curp', $datos['curp'], PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->rowCount();
        }
        return 0;
    }


    function delete($id_empleado)
    {
        $this->connect();
        $stmt = $this->conn->prepare("DELETE FROM empleado WHERE id_empleado = :id_empleado;");
        $stmt->bindParam(':id_empleado', $id_empleado, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->rowCount();
        return $result;
    }

    function update($id_empleado, $datos)
    {
        if ($this->validateEmpleado($datos)) {
            $this->connect();
            if (!empty($datos['foto'])) {
                $foto = $datos['foto'];
                $stmt = $this->conn->prepare("UPDATE empleado SET nombre = :nombre, primer_apellido = :primer_apellido, segundo_apellido = :segundo_apellido, rfc = :rfc, curp = :curp, fotografia = :foto WHERE id_empleado = :id_empleado;");
                $stmt->bindParam(':foto', $foto, PDO::PARAM_LOB);
            } else {
                $stmt = $this->conn->prepare("UPDATE empleado SET nombre = :nombre, primer_apellido = :primer_apellido, segundo_apellido = :segundo_apellido, rfc = :rfc, curp = :curp WHERE id_empleado = :id_empleado;");
            }
            $stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
            $stmt->bindParam(":primer_apellido", $datos["primer_apellido"], PDO::PARAM_STR);
            $stmt->bindParam(":segundo_apellido", $datos["segundo_apellido"], PDO::PARAM_STR);
            $stmt->bindParam(":rfc", $datos["rfc"], PDO::PARAM_STR);
            $stmt->bindParam(":curp", $datos["curp"], PDO::PARAM_STR);
            $stmt->bindParam(':id_empleado', $id_empleado, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->rowCount();
        }
    }

    function validateRFC($rfc)
    {
        $regex = '/^[A-Z]{4}[0-9]{6}[A-Z0-9]{3}$/';
        return preg_match($regex, $rfc);
    }

    function validateCURP($curp)
    {
        $regex = '/^[A-Z]{4}[0-9]{6}[H|M]{1}[A-Z]{5}[A-Z0-9]{2}$/';
        return preg_match($regex, $curp);
    }

    function validateEmpleado($datos)
    {
        if (empty($datos["nombre"])) {
            return false;
        }
        if (empty($datos["rfc"])) {
            return false;
        }
        if (empty($datos["curp"])) {
            return false;
        }
        if (!$this->validateRFC($datos['rfc'])) {
            return false;
        }
        if (!$this->validateCURP($datos['curp'])) {
            return false;
        }
        return true;
    }
}
