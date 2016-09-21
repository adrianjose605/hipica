<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Stud_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function get_stud($all = false) {
        $this->db->select('idstud,nombre,colores,fecha_registro,idpais AS pais, estatus');
        
            $this->db->where('idstud', $all);
        $query = $this->db->get('tbstud');
        return $query->result_array();
    }

    public function get_stud_sel($activos = false) {
        $this->db->select('idstud  AS id,nombre AS val');

        if ($activos)
            $this->db->where('estatus', $activos);

        $query = $this->db->get('tbstud');
        return $query->result_array();
    }

    public function generar_json_tabla_stud($offset, $cantidad, $order, $type) {
        $arr = $this->getInputFromAngular();
        $params = preg_split('#\s+#', trim($arr['query']));
        $w = false;
        if ($arr['estatus'])
            $this->db->where('estatus', $arr['estatus']);
        $likes = '';


        for ($i = 0; $i != count($params); $i++) {
            if ($i == 0)
                $likes.="(tbstud.nombre LIKE '%" . $params[$i] . "%' OR tbstud.colores LIKE '%" . $params[$i] . "%'";
            else
                $likes.="OR (tbstud.nombre LIKE '%" . $params[$i] . "%' OR tbstud.colores LIKE '%" . $params[$i] . "%'";
            if ($i + 1 == count($params))
                $likes.=")";
        }

        if (!empty($likes))
            $this->db->where($likes);


        $this->db->select('COUNT(1) AS cantidad');
        $query1 = $this->db->get('tbstud');
        $respuesta['cantidad'] = $query1->result_array();




        $this->db->select('tbstud.nombre AS Nombre, tbstud.colores AS Colores,tbpais.abreviatura AS Pais, tbstud.fecha_registro AS Registrado, tbstud.estatus AS Estatus,tbstud.idstud AS Opciones');
        $this->db->from('tbstud');
        $this->db->join('tbpais','tbpais.idpais=tbstud.idpais');
        if ($arr['estatus'])
            $this->db->where('tbstud.estatus', $arr['estatus']);
        if (!empty($likes))
            $this->db->where($likes);

        $this->db->limit($cantidad, $offset);
        $this->db->order_by($order, $type);
        $query = $this->db->get();
        $respuesta['resultado'] = $query->result_array();

        $respuesta['meta'] = $query->list_fields();

        return $respuesta;
    }

    public function edit_stud() {
        $res = array();
        $arr = $this->getInputFromAngular();
        $arr['idpais']=$arr['pais'];
        unset($arr['pais']);
        
        $this->db->where('idstud!=', $arr['idstud']);
        $this->db->where('nombre', $arr['nombre']);
        $this->db->where('idpais', $arr['idpais']);
        $query1 = $this->db->get('tbstud');
        if ($query1->num_rows() > 0) {
            $res['status'] = 0;
            $res['mensaje'] = 'El stud ya se encuentra Registrado';
            return $res;
        }        
        $this->db->flush_cache();  
        
        
        
        
        $this->db->where('idstud', $arr['idstud']);
        unset($arr['idstud']);

        unset($arr['fecha_registro']);
        if ($this->db->update('tbstud', $arr)) {
            $res['status'] = 1;
            $res['mensaje'] = 'Actualizado con Exito';
        } else {
            $res['status'] = 0;
            $res['mensaje'] = 'Ocurrio un Problema al Actualizar';
        }

        return $res;
    }

    public function insert_stud() {
        $arr = $this->getInputFromAngular();
        $res = array();
        $arr['idpais']=$arr['pais'];
        unset($arr['pais']);
        
        
        
        $this->db->select('nombre');
        $this->db->where('nombre', $arr['nombre']);
        $this->db->where('idpais', $arr['idpais']);
        $query1 = $this->db->get('tbstud');
        if ($query1->num_rows() > 0) {
            $res['status'] = 0;
            $res['mensaje'] = 'El Stud ya se encuentra registrado';
            return $res;
        }
        $this->db->set('fecha_registro', 'NOW()', FALSE);


        if ($this->db->insert('tbstud', $arr)) {
            $res['status'] = 1;
            $res['mensaje'] = 'Se inserto con exito';
        } else {
            $res['status'] = 0;
            $res['mensaje'] = 'Ups! , Ha ocurrido un error';
        }

        return $res;
    }

}
