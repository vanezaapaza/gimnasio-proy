<?php require ROOT_VIEW . '/template/header.php'; ?>
<?php
$pId = $_GET['id'] ?? null;
$client = new HttpClient(HTTP_BASE);
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $result = $client->put('/controller/ven_clientesController.php', [
        'cliente_id' => $_POST['cliente_id'],
        'nombre' => $_POST['nombre'],
        'apellido' => $_POST['apellido'],
        'email' => $_POST['email'],
        'telefono' => $_POST['telefono'],
        'direccion' => $_POST['direccion']
    ]);
    
    if ($result["ESTADO"]) {
        echo "<script>alert('Operacion realizada con Exito.');</script>";
    } else {
        echo "<script>alert('Hubo un problema, se debe contactar con el adminsitrador.');</script>";
    }
}
$recordData = $client->get('/controller/ven_clientesController.php', [
    'ope' => 'filterId',
    'cliente_id' => $pId,
]);
$record = $recordData['DATA'][0];
var_dump($record);
?>
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h5> Clientes</h5>
            </div>
            <div class="card-body">
            <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Editar Clientes</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="" method="post">
                <div class="card-body">
                <div class="form-group">
                    <label for="fortxt01">Codigo Cliente</label>
                    <input id="fortxt01"
                    type="text" class="form-control" 
                    placeholder="Codigo Cliente "
                    name="cliente_id" 
                    value="<?php echo $record['cliente_id'];?>"
                    >
                </div>
                <div class="form-group">
                    <label for="fortxt02">Nombre</label>
                    <input id="fortxt02"
                    type="text" class="form-control" 
                    placeholder="Nombre "
                    name="nombre" 
                    value="<?php echo $record[''];?>"
                    >
                </div>
                <div class="form-group">
                    <label for="fortxt03">Apellidos</label>
                    <input id="fortxt03"
                    type="text" class="form-control" 
                    placeholder="Apellidos "
                    name="apellido" 
                    value="<?php echo $record['apellido'];?>"
                    >
                </div>
                <div class="form-group">
                    <label for="fortxt04">Correo Electronico</label>
                    <input id="fortxt04"
                    type="email" class="form-control" 
                    placeholder="Correo "
                    name="email" e
                    value="<?php echo $record['email'];?>"
                    >
                </div>
                <div class="form-group">
                    <label for="fortxt05">Telefono</label>
                    <input id="fortxt05"
                    type="text" class="form-control" 
                    placeholder="Telefono"
                    name="telefono" 
                    value="<?php echo $record['telefono'];?>"
                    >
                </div>
                <div class="form-group">
                    <label for="fortxt06">Direccion</label>
                    <input id="fortxt06"
                    type="text" class="form-control" 
                    placeholder="Direccion "
                    name="direccion" 
                    value="<?php echo $record['direccion'];?>"
                    
                    >
                </div>
                <div class="form-group">
                    <label for="fortxt01">Fecha de Registro: <?php echo $record['fecharegistro'];?></label>
                    
                </div>
                
                
                
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                <button type="submit" 
                class="btn btn-primary">Guardar</button>
                </div>
            </form>
            </div>
            </div>
            
        </div>

    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
<?php require ROOT_VIEW . '/template/footer.php'; ?>