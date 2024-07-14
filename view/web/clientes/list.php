<?php require ROOT_VIEW . '/template/header.php'; ?>
<?php
$page = 1;
$ope = 'filterSearch';
$filter = '';
$items_per_page = 10;
$total_pages = 1;
$response = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $page = isset($_POST['page']) ? $_POST['page'] : 1;
    $filter = urlencode(trim(isset($_POST['filter']) ? $_POST['filter'] : ''));
}
$client = new HttpClient(HTTP_BASE);
$page = isset($_POST['page']) ? $_POST['page'] : 1;
$filter = isset($_POST['filter']) ? $_POST['filter'] : '';

$responseData = $client->get('/controller/ven_clientesController.php', [
    'ope' => 'filterSearch',
    'page' => $page,
    'busqueda' => $filter,
]);
//var_dump($responseData);
$records = $responseData['DATA'];
$totalItems = $responseData['LENGHT'];
try {
    $total_pages =  ceil($totalItems / $items_per_page);
} catch (Exception $e) {
    $total_pages = 1;
}
//paginacion
$max_links = 5;
$half_max_link = floor($max_links / 2);
$start_page = $page - $half_max_link;
$end_page = $page + $half_max_link;
if ($start_page < 1) {
    $end_page += abs($start_page) + 1;
    $start_page = 1;
}
if ($end_page > $total_pages) {
    $start_page -= ($end_page - $total_pages);
    $end_page = $total_pages;
    if ($start_page < 1) {
        $start_page = 1;
    }
}
?>
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h5>Lista de Clientes</h5>
            </div>
            <div class="card-header">
                <form action="" method="POST">
                    <div class="input-group">
                        <input type="search" class="form-control form-control-lg" 
                        placeholder="Type your keywords here" name="filter" 
                        value="<?php echo ((isset($filter) ? $filter : '')) ?>">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-lg btn-default">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="card-header">
            <a href="<?php echo HTTP_BASE; ?>/web/cli/new/0" 
            class="btn btn-primary">Nuevo</a>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th style="width: 10px">Opciones</th>
                            <th>Cliente ID</th>
                            <th>Nombre</th>
                            <th>Apellido</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($records as $fila) : ?>
                            <tr>
                                <td>
                                <a href="<?php echo HTTP_BASE . "/web/cli/view/" . $fila['cliente_id']; ?>"
                                 class="btn btn-primary btn-sm">Ver</a>
                                 <a href="<?php echo HTTP_BASE . "/web/cli/edit/" . $fila['cliente_id']; ?>"
                                 class="btn btn-primary btn-sm">Editar</a>
                                 <a href="<?php echo HTTP_BASE . "/web/cli/delete/" . $fila['cliente_id']; ?>"
                                 class="btn btn-primary btn-sm">Eliminar</a>
                                
                                </td>
                                <td><?php echo $fila['cliente_id']; ?></td>
                                <td><?php echo $fila['nombre']; ?></td>
                                <td><?php echo $fila['apellido']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div class="card-footer ">

            </div><div class="card-footer clearfix">
                                <ul class="pagination">
                                    <?php if ($page > 1) : ?>
                                        <li class="page-item">
                                            <form action="" method="POST">
                                                <input type="hidden" name="page" value="1">
                                                <button type="submit" class="page-link">Primera</button>
                                            </form>
                                        </li>
                                        <li class="page-item">
                                            <form action="" method="POST">
                                                <input type="hidden" name="page" value="<?php echo ($page - 1); ?>">
                                                <button type="submit" class="page-link">&laquo;</button>
                                            </form>

                                        </li>
                                    <?php endif; ?>
                                    <?php for ($i = $start_page; $i <= $end_page; $i++) : ?>
                                        <li class="page-item <?php echo ($page == $i ? 'active' : '') ?>">
                                            <form action="" method="POST">
                                                <input type="hidden" name="page" value="<?php echo ($i); ?>">
                                                <button type="submit" class="page-link"><?php echo ($i); ?></button>
                                            </form>
                                        </li>
                                    <?php endfor; ?>
                                    <?php if ($page < $total_pages) : ?>
                                        <li class="page-item">
                                            <form action="" method="POST">
                                                <input type="hidden" name="page" value="<?php echo ($page+1);?>">
                                                <button type="submit" class="page-link">&raquo;</button>
                                            </form>
                                        </li>
                                        <li class="page-item">
                                            <form action="" method="POST">
                                                <input type="hidden" name="page" value="<?php echo $total_pages; ?>">
                                                <button type="submit" class="page-link">Ultima </button>
                                            </form>

                                        </li>
                                    <?php endif; ?>


                                </ul>
                            </div>
        </div>
        <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
<?php require ROOT_VIEW . '/template/footer.php'; ?>