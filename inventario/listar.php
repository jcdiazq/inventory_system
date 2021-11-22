<?php include("../principal/arriba.php");

$campos = $conexion->query("SHOW COLUMNS FROM inventarios.inventario")->fetchAll(PDO::FETCH_OBJ);
$mensaje;

if (isset($_GET["ID"])) {
    $Id = $_GET["ID"];
    $conexion->query("DELETE FROM inventario WHERE ID='$Id'");
    $mensaje = "Elminado OK";
} elseif (isset($_POST["ID"])) {
    $arrayField = array();
    foreach ($campos as $campo) :
        if (!empty($_POST["$campo->Field"]) && $campo->Field != "ID") {
            $arrayField[] = $campo->Field . "=" . $_POST["$campo->Field"];
        }
    endforeach;

    $dataSet = implode(",", ($arrayField));
    $sql = "UPDATE inventario SET $dataSet WHERE ID={$_POST["ID"]}";
    $resultado = $conexion->prepare($sql);
    $resultado->execute();
    $mensaje = "Actualizado OK";
}

$registros = $conexion->query("select * FROM inventario")->fetchAll(PDO::FETCH_OBJ);
$compras = $conexion->query("select * FROM compras")->fetchAll(PDO::FETCH_OBJ);
$pedidos = $conexion->query("select * FROM pedidos")->fetchAll(PDO::FETCH_OBJ);
$devoluciones = $conexion->query("select * FROM devolucion")->fetchAll(PDO::FETCH_OBJ);
$materiales = $conexion->query("select * FROM materiales")->fetchAll(PDO::FETCH_OBJ);

?>
<div class="contenedor_listado">
    <div class=titulo_pagina>
        <h1>Lista de Inventario</h1>
    </div>
    <div>
        <div class="caja_filtro">
            <form action="" method="get">
                Filtrar Por: <select name="filtro" id="filtro">
                                <option value="filtro1">Filtro 1</option>
                                <option value="filtro2">Filtro 2</option>
                            </select>
                <input type="submit" name="filtrar" value="Aceptar">
            </form>
        </div>
        <div class="iconos_exportar">
            <div><img src="../img/icono_excel.png" onclick="exportTableToExcel('tblData')"></div>
            <div><img src="../img/icono_pdf.png" onclick="exportTableToPdf('tblData')"></div>
            <div><img src="../img/icono_imprimir.png" onclick="imprimir()"></div>
            <div><img src="../img/icono_correo.png"></div>
        </div>
    </div>
    <div class=registros>
        <table class="tabla_lista" id="tblData">
            <thead class="tabla_encabezado">
                <tr>
                    <?PHP foreach ($campos as $campo) : ?>
                        <th><?php echo $campo->Field; ?></th>
                    <?php endforeach; ?>
                    <th colspan="2">Actualizar/Borrar</th>
                </tr>
            </thead>
            <tbody class="tabla_cuerpo">
                <?PHP foreach ($registros as $registro) : ?>
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                        <tr class="tabla_fila">
                            <?PHP foreach ($registro as $llave => $dato) : ?>
                                <th>
                                    <?php if ($llave == "N_COMPRAS") { ?>
                                        <select name="<?php echo $llave; ?>" id="<?php echo $llave; ?>" style="width: 300px;">
                                            <option value="NULL">NULL</option>
                                            <?PHP foreach ($compras as $compra) : ?>
                                                <option value="<?php echo $compra->ID; ?>" <?php if ($dato == $compra->ID) {
                                                                                            echo "selected";
                                                                                        } ?>><?php echo $compra->DESCRIPCION; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    <?php } elseif ($llave == "N_PEDIDO") { ?>
                                        <select name="<?php echo $llave; ?>" id="<?php echo $llave; ?>" style="width: 300px;">
                                            <option value="NULL">NULL</option>
                                            <?PHP foreach ($pedidos as $pedido) : ?>
                                                <option value="<?php echo $pedido->ID; ?>" <?php if ($dato == $pedido->ID) {
                                                                                            echo "selected";
                                                                                        } ?>><?php echo $pedido->DESCRIPCION; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    <?php } elseif ($llave == "N_DEVOLUCION") { ?>
                                        <select name="<?php echo $llave; ?>" id="<?php echo $llave; ?>" style="width: 300px;">
                                            <option value="NULL">NULL</option>
                                            <?PHP foreach ($devoluciones as $devolucion) : ?>
                                                <option value="<?php echo $devolucion->ID; ?>" <?php if ($dato == $devolucion->ID) {
                                                                                            echo "selected";
                                                                                        } ?>><?php echo $devolucion->DESCRIPCION; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    <?php } elseif ($llave == "CODIGO") { ?>
                                        <select name="<?php echo $llave; ?>" id="<?php echo $llave; ?>" style="width: 300px;">
                                            <option value="NULL">NULL</option>
                                            <?PHP foreach ($materiales as $material) : ?>
                                                <option value="<?php echo $material->IDMATERIAL; ?>" <?php if ($dato == $material->IDMATERIAL) {
                                                                                            echo "selected";
                                                                                        } ?>><?php echo $material->DESCRIPCION; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    <?php } else { ?>
                                        <?php if ($llave == "ID") {$valor = $dato;} ?>
                                        <?php if ($llave == "CANT_DISPONIBLE") { 
                                            if($dato<3) {$color="red";} elseif ($dato<10){$color="orange";} else {$color="green";} ?>
                                            <span style="color:<?php echo $color; ?>;">
                                        <?php echo $dato; ?>
                                            </spam>
                                            <?php } else { ?>
                                        <?php echo $dato; ?>
                                        <?php } ?>
                                    <?php } ?>
                                </th>
                            <?php endforeach; ?>
                            <td>
                                <input type="hidden" name="ID" id="ID" value="<?php echo $valor; ?>">
                                <?php if (isset($_SESSION['usuario']) && $_SESSION['ID_ROL'] == 1 ) { ?>
                                <input type="submit" value="Actualizar">
                                <?php } ?>
                    </form>
                    </td>
                    <td>
                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="GET">
                            <input type="hidden" name="ID" id="ID" value="<?php echo $valor; ?>">
                            <?php if (isset($_SESSION['usuario']) && $_SESSION['ID_ROL'] == 1 ) { ?>
                            <input type="submit" value="Borrar">
                            <?php } ?>
                        </form>
                    </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<script>
    <?php if (isset($mensaje)) {
        echo "alert('" . $mensaje . "');";
    } ?>
</script>
<script>
    // funcion para descargar el excel
    function exportTableToExcel(tableID, filename = ''){
    var downloadLink;
    var dataType = 'application/vnd.ms-excel';
    var tableSelect = document.getElementById(tableID);
    var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');
    
    // Specify file name
    filename = filename?filename+'.xls':'exportado_excel.xls';
    
    // Create download link element
    downloadLink = document.createElement("a");
    
    document.body.appendChild(downloadLink);
    
    if(navigator.msSaveOrOpenBlob){
        var blob = new Blob(['ufeff', tableHTML], {
            type: dataType
        });
        navigator.msSaveOrOpenBlob( blob, filename);
    }else{
        // Create a link to the file
        downloadLink.href = 'data:' + dataType + ', ' + tableHTML;
    
        // Setting the file name
        downloadLink.download = filename;
        
        //triggering the function
        downloadLink.click();
    }
}

// Funcion para descargar el PDF
function exportTableToPdf(tableID, filename = ''){
const $elementoParaConvertir = document.body; // <-- Aquí puedes elegir cualquier elemento del DOM
html2pdf()
    .set({
        margin: 1,
        filename: filename?filename+'.pdf':'exportado_pdf.pdf',
        image: {
            type: 'jpeg',
            quality: 0.98
        },
        html2canvas: {
            scale: 3, // A mayor escala, mejores gráficos, pero más peso
            letterRendering: true,
        },
        jsPDF: {
            unit: "in",
            format: "a3",
            orientation: 'portrait' // landscape o portrait
        }
    })
    .from($elementoParaConvertir)
    .save()
    .catch(err => console.log(err));
}

// Funcion para enviar a imprimir
function imprimir() {
    window.print()
}
</script>
<?php include("../principal/abajo.php"); ?>