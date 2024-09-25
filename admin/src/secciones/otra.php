<?php
//Seleccionar la tabla de denuncias
include("C:\wamp64\www\Woman_Safe\db\conection.php");

// Seleccionar campos de las tablas
$query_mapa = $conn->prepare("SELECT d.id, d.historia, d.fecha, c.nombre AS nombre_colonia
FROM denuncias d
JOIN colonias c ON d.id_col = c.id
WHERE d.categoria = 'Otra'
");

$query_mapa->execute();
$result = $query_mapa->get_result();

// Obtener los registros
$lista_de_denuncias = [];
while ($row = $result->fetch_assoc()) {
    $lista_de_denuncias[] = $row;
}

include("../cabeceras/header.php");

?>

<br>
<div class="container_tabla">
    <div class="tabla-container">
        <div class="tabla-son">
            <table class="tabla">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Historia</th>
                        <th scope="col">Direccion</th>
                        <th scope="col">Fecha</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($lista_de_denuncias as $registros) { ?>
                        <tr class="">
                            <td>
                                <?php echo $registros['id']; ?>
                            </td>
                            <td>
                                <?php echo $registros['historia']; ?>
                            </td>
                            <td>
                                <?php echo $registros['nombre_colonia']; ?>
                            </td>
                            <td>
                                <?php echo $registros['fecha']; ?>
                            </td>

                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


<?php
include("../cabeceras/footer.php");
?>