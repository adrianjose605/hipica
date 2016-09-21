<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Haras_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function get_haras($all = false) {
        $this->db->select('idharas,nombre,abrev,fecha_registro,estatus, idpais AS pais');
        
            $this->db->where('idharas', $all);
        $query = $this->db->get('tbharas');
        return $query->result_array();
    }

    public function get_haras_sel($activos = false) {
        $this->db->select('idharas  AS id,abrev AS val');

        if ($activos)
            $this->db->where('estatus', $activos);

        $query = $this->db->get('tbharas');
        return $query->result_array();
    }

    public function generar_json_tabla_haras($offset, $cantidad, $order, $type) {
        $arr = $this->getInputFromAngular();
        $params = preg_split('#\s+#', trim($arr['query']));
        $w = false;
        if ($arr['estatus'])
            $this->db->where('estatus', $arr['estatus']);
        $likes = '';


        for ($i = 0; $i != count($params); $i++) {
            if ($i == 0)
                $likes.="(tbharas.nombre LIKE '%" . $params[$i] . "%' OR tbharas.abrev LIKE '%" . $params[$i] . "%'";
            else
                $likes.="OR tbharas.nombre LIKE '%" . $params[$i] . "%' OR tbharas.abrev LIKE '%" . $params[$i] . "%'";
            if ($i + 1 == count($params))
                $likes.=")";
        }

        if (!empty($likes))
            $this->db->where($likes);


        $this->db->select('COUNT(1) AS cantidad');
        $query1 = $this->db->get('tbharas');
        $respuesta['cantidad'] = $query1->result_array();




        $this->db->select('tbharas.nombre AS Nombre, tbharas.abrev AS Abreviatura, tbpais.abreviatura AS Pais, tbharas.fecha_registro AS Registrado, tbharas.estatus AS Estatus,tbharas.idharas AS Opciones');
        $this->db->from('tbharas');
        $this->db->join('tbpais', 'tbpais.idpais=tbharas.idpais');
        if ($arr['estatus'])
            $this->db->where('tbharas.estatus', $arr['estatus']);
        if (!empty($likes))
            $this->db->where($likes);

        $this->db->limit($cantidad, $offset);
        $this->db->order_by($order, $type);
        $query = $this->db->get();
        $respuesta['resultado'] = $query->result_array();

        $respuesta['meta'] = $query->list_fields();

        return $respuesta;
    }

    public function edit_hara() {
        $res = array();
        $arr = $this->getInputFromAngular();
        $arr['idpais']=$arr['pais'];
        unset($arr['pais']);
         
        $this->db->where('idharas!=', $arr['idharas']);
        $this->db->where('nombre', $arr['nombre']);
        $this->db->where('idpais', $arr['idpais']);
        $query1 = $this->db->get('tbharas');
        if ($query1->num_rows() > 0) {
            $res['status'] = 0;
            $res['mensaje'] = 'El Hara ya se encuentra registrada';
            return $res;
        }    
        
        $this->db->flush_cache();
        $this->db->where('idharas!=', $arr['idharas']);
        $this->db->where('idpais', $arr['idpais']);
        $this->db->select('abrev');
        $this->db->where('abrev', $arr['abrev']);
        $query1 = $this->db->get('tbharas');
        if ($query1->num_rows() > 0) {
            $res['status'] = 0;
            $res['mensaje'] = 'La abreviatura ya se encuentra registrada con otro Hara';
            return $res;
        }
        $this->db->flush_cache();
        
        $this->db->where('idharas', $arr['idharas']);
        unset($arr['idharas']);

        unset($arr['fecha_registro']);
        if ($this->db->update('tbharas', $arr)) {
            $res['status'] = 1;
            $res['mensaje'] = 'Actualizado con Exito';
        } else {
            $res['status'] = 0;
            $res['mensaje'] = 'Ocurrio un Problema al Actualizar';
        }

        return $res;
    }

    public function insert_hara() {
        $arr = $this->getInputFromAngular();
        $res = array();
        $this->db->select('nombre');
        $this->db->where('nombre', $arr['nombre']);
        $this->db->where('idpais', $arr['pais']);
        $arr['idpais']=$arr['pais'];
        unset($arr['pais']);
        
        $query1 = $this->db->get('tbharas');
        if ($query1->num_rows() > 0) {
            $res['status'] = 0;
            $res['mensaje'] = 'El Hara ya se encuentra registrado en ese Pais';
            return $res;
        }
        
        
        $this->db->select('abrev');
        $this->db->where('abrev', $arr['abrev']);
        $query1 = $this->db->get('tbharas');
        if ($query1->num_rows() > 0) {
            $res['status'] = 0;
            $res['mensaje'] = 'La abreviatura ya se encuentra registrada con otro Hara';
            return $res;
        }
        
        
        
        
        $this->db->set('fecha_registro', 'NOW()', FALSE);


        if ($this->db->insert('tbharas', $arr)) {
            $res['status'] = 1;
            $res['mensaje'] = 'Se inserto con exito';
        } else {
            $res['status'] = 0;
            $res['mensaje'] = 'Ups! , Ha ocurrido un error';
        }

        return $res;
    }

}
