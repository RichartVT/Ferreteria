<?php
require_once __DIR__ . '/sistema.class.php';
require_once '../vendor/autoload.php';
use Spipu\Html2Pdf\Html2Pdf;
use Spipu\Html2Pdf\Exception\Html2PdfException;
use Spipu\Html2Pdf\Exception\ExceptionFormatter;

class Reportes extends Sistema
{
    public function productos() {
        try {
            $this->connect();
            $sql = "SELECT p.id_producto as id_producto, m.marca as marca, p.producto as producto, p.precio as precio FROM producto p JOIN marca m ON p.id_marca = m.id_marca ORDER BY 2,3";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $datos = $stmt->fetchAll();
            ob_start();
            $content = ob_get_clean();
            include __DIR__ . '/views/reportes/productos.php';
            $html2pdf = new Html2PDF('P', 'USLETTER', 'es');
            $html2pdf->writeHTML($content);
            $html2pdf->Output('reporte_productos.pdf');
        } catch (Exception $e) {
            $formatter = new ExceptionFormatter($e);
            echo $formatter->getHtmlMessage();
        }
    }

    public function marcas() {
        try {
            $this->connect();
            $sql = "SELECT m.id_marca as id_marca, m.marca as marca, COUNT(p.producto) as productos FROM marca m JOIN producto p ON m.id_marca = p.id_marca GROUP BY 1 ORDER BY 1;";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $datos = $stmt->fetchAll();
            ob_start();
            $content = ob_get_clean();
            include __DIR__ . '/views/reportes/marcas.php';
            $html2pdf = new Html2PDF('P', 'A4', 'es');
            $html2pdf->writeHTML($content);
            $html2pdf->Output('marcas.pdf');
        } catch (Exception $e) {
            $formatter = new ExceptionFormatter($e);
            echo $formatter->getHtmlMessage();
        }
    }
}