<?php
require_once __DIR__ . '/sistema.class.php';

class Usuario extends Sistema
{
    public function getAll()
    {
        $this->connect();
        $stmt = $this->conn->prepare("SELECT * FROM usuario;");
        $stmt->execute();
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $datos = $stmt->fetchAll();
        $this->setCount(count($datos));
        return $datos;
    }

    public function getById($id_usuario)
    {
        $this->connect();
        $stmt = $this->conn->prepare("SELECT * FROM usuario WHERE id_usuario = :id_usuario;");
        $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
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

    public function insert($datos)
    {
        $this->connect();
        if ($this->validateUser($datos)) {
            $stmt = $this->conn->prepare("INSERT INTO usuario (correo, password) VALUES (:usuario, :contrasena);");
            $stmt->bindParam(':usuario', $datos['correo'], PDO::PARAM_STR);
            $stmt->bindParam(':contrasena', $datos['password'], PDO::PARAM_STR);
            $stmt->execute();
            return true;
        }
        return false;
    }

    public function update($datos, $id_usuario) {
        $this->connect();
        if ($this->validateUser($datos)) {
            $stmt = $this->conn->prepare("UPDATE usuario SET correo = :correo, password = :password WHERE id_usuario = :id_usuario;");
            $stmt->bindParam(':correo', $datos['correo'], PDO::PARAM_STR);
            $stmt->bindParam(':password', $datos['password'], PDO::PARAM_STR);
            $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
            $stmt->execute();
            return true;
        }
        return false;
    }

    public function delete($id_usuario) {
        $this->connect();
        $stmt = $this->conn->prepare("DELETE FROM usuario WHERE id_usuario = :id_usuario;");
        $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->rowCount();
        return $result;
    }

    private function validateUser($datos)
    {
        if (isset($datos['correo'])) {
            return true;
        }
        return false;
    }
}