<?php
include_once "../core/ModeloBasePDO.php";
class UsuarioModel extends ModeloBasePDO
{
    public function __construct()
    {
        parent::__construct();
    }
    public function findall()
    {
        $sql = "SELECT  correo_electronico ,  nombre ,  contrasena   FROM usuarios; ";
        $param = array();
        return parent::gselect($sql, $param);
    }
    public function findid($p_correo_electronico)
    {
        $sql = "SELECT   correo_electronico ,  nombre ,  contrasena   FROM usuarios
         WHERE correo_electronico = :p_correo_electronico;  ";
        $param = array();
        array_push($param, [':p_correo_electronico', $p_correo_electronico, PDO::PARAM_STR]);
        return parent::gselect($sql, $param);
    }
    public function findpaginateall($p_filtro, $p_limit, $p_offset)
    {
        $sql = "SELECT  correo_electronico ,  nombre ,  contrasena   
        FROM usuarios
        WHERE upper(concat(IFNULL(correo_electronico,''),IFNULL(nombre,''),IFNULL(contrasena,''))) like concat('%',upper(IFNULL(:p_filtro,'')),'%') 
        limit :p_limit
        OFFSET :p_offset  ";
        $param = array();
        array_push($param, [':p_filtro', $p_filtro, PDO::PARAM_STR]);
        array_push($param, [':p_limit', $p_limit, PDO::PARAM_INT]);
        array_push($param, [':p_offset', $p_offset, PDO::PARAM_INT]);
        $var = parent::gselect($sql, $param);

        $sqlCount = "SELECT concat(1) as cant
        FROM usuarios
        WHERE upper(concat(IFNULL(correo_electronico,''),IFNULL(nombre,''),IFNULL(contrasena,''))) like concat('%',upper(IFNULL(:p_filtro,'')),'%')";
        $param = array();
        array_push($param, [':p_filtro', $p_filtro, PDO::PARAM_STR]);
        $var1 = parent::gselect($sqlCount, $param);
        $var['LENGTH'] = $var1['DATA'][0]['cant'];
        return $var;
    }
    public function verificarlogin($p_correo_electronico, $p_contrasena)
    {
        $sql = "SELECT correo_electronico, nombre
     FROM usuarios
     WHERE
     correo_electronico = :p_correo_electronico AND 
     contrasena = :p_contrasena";
        $param = array();
        array_push($param, [':p_correo_electronico', $p_correo_electronico, PDO::PARAM_STR]);
        array_push($param, [':p_contrasena', $p_contrasena, PDO::PARAM_STR]);
        return parent::gselect($sql, $param);
    }
    public function register($p_correo_electronico, $p_nombre, $p_contrasena)
    {
        $sql = "INSERT INTO  usuarios ( correo_electronico ,  nombre ,  contrasena ) 
        VALUES ( :p_correo_electronico ,  :p_nombre ,  :p_contrasena );";
        $param = array();
        array_push($param, [':p_correo_electronico', $p_correo_electronico, PDO::PARAM_STR]);
        array_push($param, [':p_nombre', $p_nombre, PDO::PARAM_STR]);
        array_push($param, [':p_contrasena', $p_contrasena, PDO::PARAM_STR]);

        return parent::ginsert($sql, $param);
    }
    public function update($p_correo_electronico, $p_nombre, $p_contrasena)
    {
        $sql = " UPDATE  usuarios  SET 
         nombre =  :p_nombre, 
         contrasena = :p_contrasena        
        WHERE  correo_electronico = :p_correo_electronico ";
        $param = array();
        array_push($param, [':p_correo_electronico', $p_correo_electronico, PDO::PARAM_STR]);
        array_push($param, [':p_nombre', $p_nombre, PDO::PARAM_STR]);
        array_push($param, [':p_contrasena', $p_contrasena, PDO::PARAM_STR]);
        return parent::gupdate($sql, $param);
    }
    public function delete($p_correo_electronico)
    {
        $sql = "DELETE FROM  usuarios  WHERE  correo_electronico = :p_correo_electronico";
        $param = array();
        array_push($param, [':p_correo_electronico', $p_correo_electronico, PDO::PARAM_STR]);
        return parent::gdelete($sql, $param);
    }
}
