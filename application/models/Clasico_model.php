<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Clasico_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function get_clasico($id) {

        $this->db->select('tbhipodromo.idpais_ as pais,tbclasico.descripcion,grado, pond,  tbclasico.estatus, tbhipodromo.idhipodromo as hipodromo, patrocinador,idclasico');
        $this->db->from('tbclasico');
        $this->db->join('tbhipodromo', 'tbclasico.idhipodromo=tbhipodromo.idhipodromo');
        $this->db->where('idclasico', $id);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function insert_clasico() {
        $arr = $this->getInputFromAngular();
        $res = array();
        $arr['idhipodromo'] = $arr['hipodromo'];
        unset($arr['hipodromo']);

        unset($arr['pais']);

        $this->db->select('idclasico');
        $this->db->where('idhipodromo', $arr['idhipodromo']);
        $this->db->where('descripcion', $arr['descripcion']);
        $query1 = $this->db->get('tbclasico');
        if ($query1->num_rows() > 0) {
            $res['status'] = 0;
            $res['mensaje'] = 'El Tipo  de Clasico ya se encuentra registrado';
            return $res;
        }

        if ($this->db->insert('tbclasico', $arr)) {
            $res['status'] = 1;
            $res['mensaje'] = 'Se inserto con exito';
        } else {
            $res['status'] = 0;
            $res['mensaje'] = 'Ups! , Ha ocurrido un error';
        }

        return $res;
    }

    public function search_clasico($clasico = '') {
        $this->db->select('descripcion AS clasico ,idclasico AS id');        
        $this->db->like('descripcion', $clasico);
        $this->db->from('tbclasico');        
        $query = $this->db->get();
        return $query->result_array();
    }

    public function edit_clasico() {
        $res = array();
        $arr = $this->getInputFromAngular();
        $arr['idhipodromo'] = $arr['hipodromo'];
        unset($arr['hipodromo']);
        unset($arr['pais']);


        $this->db->where('idclasico!=', $arr['idclasico']);
        $this->db->where('descripcion', $arr['descripcion']);
        $query1 = $this->db->get('tbclasico');
        if ($query1->num_rows() > 0) {
            $res['status'] = 0;
            $res['mensaje'] = 'El Clasico ya se encuentra Registrado';
            return $res;
        }
        $this->db->flush_cache();



        $this->db->where('idclasico', $arr['idclasico']);
        unset($arr['idclasico']);


        if ($this->db->update('tbclasico', $arr)) {
            $res['status'] = 1;
            $res['mensaje'] = 'Actualizado con Exito';
        } else {
            $res['status'] = 0;
            $res['mensaje'] = 'Ocurrio un Problema al Actualizar';
        }

        return $res;
    }

    public function generar_json_tabla_clasico($offset, $cantidad, $order, $type) {
        $arr = $this->getInputFromAngular();
        $w = false;
        if ($arr['estatus'])
            $this->db->where('tbclasico.estatus', $arr['estatus']);
        if ($arr['query'])
            $this->db->where("tbclasico.descripcion LIKE '%" . $arr['query'] . "%'");


        $this->db->select('COUNT(1) AS cantidad');
        $query1 = $this->db->get('tbclasico');
        $respuesta['cantidad'] = $query1->result_array();


        $this->db->select('tbclasico.descripcion AS Nombre,pond AS Ponderacion,abreviatura AS Hipodromo, grado as Grado, patrocinador AS Patrocinador,tbclasico.estatus AS Estatus,idclasico AS Opciones');
        $this->db->from('tbclasico');
        $this->db->join('tbhipodromo', 'tbhipodromo.idhipodromo=tbclasico.idhipodromo');



        if ($arr['estatus'])
            $this->db->where('tbclasico.estatus', $arr['estatus']);

        if ($arr['query'])
            $this->db->where("tbclasico.descripcion LIKE '%" . $arr['query'] . "%'");

        $this->db->limit($cantidad, $offset);
        $this->db->order_by($order, $type);
        $query = $this->db->get();
        $respuesta['resultado'] = $query->result_array();

        $respuesta['meta'] = $query->list_fields();

        return $respuesta;
    }

}
