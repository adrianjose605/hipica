<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Retiros_model
 *
 * @author zyos
 */
class Retiros_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function get_causa_retiros($all = false) {
        $this->db->select('idcausaretiro ,descripcion,fecha_registro,estatus');
        if (!$all)
            $this->db->where('idcausaretiro', $all);
        $query = $this->db->get('tbcausaretiro');
        return $query->result_array();
    }

    public function generar_json_tabla_causa_retiro($offset, $cantidad, $order, $type) {
        $arr = $this->getInputFromAngular();


        $this->db->select('COUNT(1) AS cantidad');
        if ($arr['estatus'])
            $this->db->where('estatus', $arr['estatus']);
        if (!empty($arr['query']))
            $this->db->like('descripcion', $arr['query']);



        $query1 = $this->db->get('tbcausaretiro');
        $respuesta['cantidad'] = $query1->result_array();




        $this->db->select('descripcion AS Descripcion, estatus AS Estatus,idcausaretiro AS Opciones');
        if ($arr['estatus'])
            $this->db->where('estatus', $arr['estatus']);
        if (isset($arr['query']))
            $this->db->like('descripcion', $arr['query']);

        $this->db->limit($cantidad, $offset);
        $this->db->order_by($order, $type);
        $query = $this->db->get('tbcausaretiro');
        $respuesta['resultado'] = $query->result_array();

        $respuesta['meta'] = $query->list_fields();

        return $respuesta;
    }

    public function edit_causa_retiros() {
        $res = array();
        $arr = $this->getInputFromAngular();
        $this->db->where('idcausaretiro!=', $arr['idcausaretiro']);
        $this->db->where('descripcion', $arr['descripcion']);
        $query1 = $this->db->get('tbcausaretiro');
        if ($query1->num_rows() > 0) {
            $res['status'] = 0;
            $res['mensaje'] = 'La Causa de Retiro ya se encuentra registrado';
            return $res;
        }
        
        
        $this->db->flush_cache();
        $this->db->where('idcausaretiro', $arr['idcausaretiro']);
        unset($arr['idcausaretiro']);
        unset($arr['fecha_registro']);
        
        if ($this->db->update('tbcausaretiro', $arr)) {
            $res['status'] = 1;
            $res['mensaje'] = 'Actualizado con Exito';
        } else {
            $res['status'] = 0;
            $res['mensaje'] = 'Ocurrio un Problema al Actualizar';
        }

        return $res;
    }

    public function insert_causa_retiros() {
        $arr = $this->getInputFromAngular();
        $res = array();
        $this->db->select('descripcion');
        $this->db->where('descripcion', $arr['descripcion']);
        $query1 = $this->db->get('tbcausaretiro');
        if ($query1->num_rows() > 0) {
            $res['status'] = 0;
            $res['mensaje'] = 'La causa  de Retiro ya se encuentra registrada';
            return $res;
        }
        $this->db->set('fecha_registro', 'NOW()', FALSE);


        if ($this->db->insert('tbcausaretiro', $arr)) {
            $res['status'] = 1;
            $res['mensaje'] = 'Se inserto con exito';
        } else {
            $res['status'] = 0;
            $res['mensaje'] = 'Ups! , Ha ocurrido un error';
        }

        return $res;
    }

    //put your code here
}
