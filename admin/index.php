<?php
include 'views/header.php';
include __DIR__ . '/sistema.class.php';
$app = new Sistema();
$sql = "SELECT m.marca AS marca, SUM(vd.cantidad * p.precio) AS monto FROM marca m JOIN producto p ON m.id_marca = p.id_marca JOIN venta_detalle vd ON vd.id_producto = p.id_producto GROUP BY m.marca ORDER BY m.marca ASC";
$datos = $app->query($sql);
$app->checkRol("Administrador", true);
?>
<script src="https://www.gstatic.com/charts/loader.js"></script>

<script>
    google.charts.load("current", {
        packages: ["corechart"]
    });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ["Marca", "Monto", {
                role: "style"
            }],
            <?php foreach ($datos as $dato): ?>["<?php echo $dato['marca']; ?>", <?php echo $dato['monto']; ?>, "#5522FF"],
            <?php endforeach; ?>
        ]);

        var view = new google.visualization.DataView(data);
        view.setColumns([0, 1,
            {
                calc: "stringify",
                sourceColumn: 1,
                type: "string",
                role: "annotation"
            },
            2
        ]);

        var options = {
            title: "Monto total por marca",
            width: 850,
            height: 640,
            bar: {
                groupWidth: "75%"
            },
            legend: {
                position: "none"
            },
        };
        var chart = new google.visualization.BarChart(document.getElementById("barchart_values"));
        chart.draw(view, options);
    }
</script>
<div id="barchart_values" style="width: 900px; height: 300px;"></div>
<div id="barchart_material" style="width: 900px; height: 500px;"></div>

<?php include 'views/footer.php'; ?>