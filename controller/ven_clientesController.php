<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header("Content-Type: application/json; charset=UTF-8");


session_start();

require_once($_SERVER['DOCUMENT_ROOT'] . "/gimnasio_proy/config/global.php");

require_once(ROOT_DIR . "/model/ven_clientesModel.php");



$method = $_SERVER['REQUEST_METHOD'];
$input = json_decode(file_get_contents('php://input'), true);

try {
    $Path_Info = isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : (isset($_SERVER['ORIG_PATH_INFO']) ? $_SERVER['ORIG_PATH_INFO'] : '');
    $request = explode('/', trim($Path_Info, '/'));
} catch (Exception $e) {
    echo $e->getMessage();
}
switch ($method) {
    case 'GET': //consulta

        $p_ope = !empty($input['ope']) ? $input['ope'] : $_GET['ope'];
        if (!empty($p_ope)) {

            if ($p_ope == 'filterId') {
                filterId($input);
            } elseif ($p_ope == 'filterSearch') {
                filterPaginateAll($input);
            } elseif ($p_ope ==  'filterall') {
                filterAll($input);
            }
        }

        break;
    case 'POST': //inserta
        insert($input);
        break;
    case 'PUT': //actualiza
        update($input);
        break;
    case 'DELETE': //elimina
    
        delete($input);
        break;
    default: //metodo NO soportado
        echo 'METODO NO SOPORTADO';
        break;
}
function filterAll($input){
    $tobj=new Ven_clientesModel();
    $var=$tobj->findall();
    echo json_encode($var);
}
function filterid($input)
{
    $p_cliente_id = !empty( $input['cliente_id']) ? $input['cliente_id'] : $_GET['cliente_id'];
    $tobj = new Ven_clientesModel();
    $var = $tobj->findID($p_cliente_id);
    echo json_encode($var);
}
function filterPaginateAll($input)
{
    $nro_record_page = 10;
    $page = !empty($input['page']) ? $input['page'] : $_GET['page'];
    $p_busqueda = !empty($input['busqueda']) ? $input['busqueda'] : $_GET['busqueda'];
    $p_limit = 10;
    $p_offset = 0; 
    $p_offset = abs(($page - 1) * $nro_record_page);
    $tobj = new Ven_clientesModel();
    $var = $tobj->findpaginateall($p_limit,$p_offset,$p_busqueda);
    echo json_encode($var);
}
function insert($input){
    $p_nombre = !empty($input['nombre']) ? $input['nombre'] : $_GET['nombre'];
    $p_apellido = !empty($input['apellido']) ? $input['apellido'] : $_GET['apellido'];
    $p_email = !empty($input['email']) ? $input['email'] : $_GET['email'];
    $p_telefono = !empty($input['telefono']) ? $input['telefono'] : $_GET['telefono'];
    $p_direccion = !empty($input['direccion']) ? $input['direccion'] : $_GET['direccion'];
    $tobj = new Ven_clientesModel();
    $var =$tobj->insert(
        $p_nombre,
        $p_apellido,
        $p_email,
        $p_telefono,
        $p_direccion,
    );
    echo json_encode($var);
}
function update($input)
{
    $p_cliente_id = !empty($input['cliente_id']) ? $input['cliente_id'] : $_GET['cliente_id'];
    $tobj = new Ven_clientesModel();
    $var =$tobj->delete($p_cliente_id);
    echo json_encode($var);
}