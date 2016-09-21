<?php

class Comentario_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function insert_tipo_comentario() {
        $arr = $this->getInputFromAngular();
        $res = array();
        $arr['tipocomentario'] = $arr['descripcion'];
        unset($arr['descripcion']);

        $this->db->select('tipocomentario');
        $this->db->where('tipocomentario', $arr['tipocomentario']);        
        $query1 = $this->db->get('tbtipocomentarios');
        if ($query1->num_rows() > 0) {
            $res['status'] = 0;
            $res['mensaje'] = 'El Tipo  de comentario ya se encuentra registrado';
            return $res;
        }   

        if ($this->db->insert('tbtipocomentarios', $arr)) {
            $res['status'] = 1;
            $res['mensaje'] = 'Se inserto con exito';
        } else {
            $res['status'] = 0;
            $res['mensaje'] = 'Ups! , Ha ocurrido un error';
        }

        return $res;
    }

    public function get_tipo_comentario($all = false) {
        $this->db->select('tipocomentario AS descripcion,estatus AS estatus,idtipocomentario AS id');
        $this->db->from('tbtipocomentarios');
        
        
            $this->db->where('idtipocomentario', $all);
        $query = $this->db->get('');
        return $query->result_array();
    }

    public function generar_json_tabla_tipo_comentario($offset, $cantidad, $order, $type) {
        $arr = $this->getInputFromAngular();
        $params = preg_split('#\s+#', trim($arr['query']));
        $w = false;
        if ($arr['estatus'])
            $this->db->where('estatus', $arr['estatus']);
        if ($arr['query'])
            $this->db->where("tipocomentario LIKE '%". $arr['query']."%'");        


        $this->db->select('COUNT(1) AS cantidad');
        $query1 = $this->db->get('tbtipocomentarios');
        $respuesta['cantidad'] = $query1->result_array();


        $this->db->select('tipocomentario AS Descripcion,estatus AS Estatus,idtipocomentario AS Opciones');
        $this->db->from('tbtipocomentarios');    
        if ($arr['estatus'])
            $this->db->where('estatus', $arr['estatus']);

        if ($arr['query'])
            $this->db->where("tipocomentario LIKE '%". $arr['query']."%'");        

        $this->db->limit($cantidad, $offset);
        $this->db->order_by($order, $type);
        $query = $this->db->get();
        $respuesta['resultado'] = $query->result_array();

        $respuesta['meta'] = $query->list_fields();

        return $respuesta;
    }

    public function edit_tipo_comentario() {

        $arr = $this->getInputFromAngular();        
        $res = array();
        $arr['tipocomentario'] = $arr['descripcion'];
        unset($arr['descripcion']);
        $arr['idtipocomentario'] = $arr['id'];
        unset($arr['id']);

        $this->db->select('tipocomentario');
        $this->db->where('tipocomentario', $arr['tipocomentario']);        
        $this->db->where('idtipocomentario!=', $arr['idtipocomentario']);        
        $query1 = $this->db->get('tbtipocomentarios');
        if ($query1->num_rows() > 0) {
            $res['status'] = 0;
            $res['mensaje'] = 'El Tipo  de comentario ya se encuentra registrado';
            return $res;
        }         
      
        $this->db->where('tipocomentario', $arr['tipocomentario']);        
        unset($arr['idtipocomentario']);


        if ($this->db->update('tbtipocomentarios', $arr)) {
            $res['status'] = 1;
            $res['mensaje'] = 'Actualizado con Exito';
        } else {
            $res['status'] = 0;
            $res['mensaje'] = 'Ocurrio un Problema al Actualizar';
        }

        return $res;
    }

}
