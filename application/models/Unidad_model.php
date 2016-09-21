<?php

class Unidad_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function insert_tipo_unidad() {
        $arr = $this->getInputFromAngular();
        $res = array();
        $arr['nombretipounidad'] = $arr['descripcion'];
        unset($arr['descripcion']);

        $this->db->select('nombretipounidad');
        $this->db->where('nombretipounidad', $arr['nombretipounidad']);        
        $query1 = $this->db->get('tbtipounidades');
        if ($query1->num_rows() > 0) {
            $res['status'] = 0;
            $res['mensaje'] = 'El Tipo  de Unidad ya se encuentra registrada';
            return $res;
        }   

        if ($this->db->insert('tbtipounidades', $arr)) {
            $res['status'] = 1;
            $res['mensaje'] = 'Se inserto con exito';
        } else {
            $res['status'] = 0;
            $res['mensaje'] = 'Ups! , Ha ocurrido un error';
        }

        return $res;
    }

    public function get_tipo_unidad($all = false) {
        $this->db->select('nombretipounidad AS descripcion,estatus AS estatus,idtipounidad AS id');
        $this->db->from('tbtipounidades');
        
            $this->db->where('idtipounidad', $all);
        $query = $this->db->get('');
        return $query->result_array();
    }

    public function generar_json_tabla_tipo_unidad($offset, $cantidad, $order, $type) {
        $arr = $this->getInputFromAngular();
        $params = preg_split('#\s+#', trim($arr['query']));
        $w = false;
        if ($arr['estatus'])
            $this->db->where('estatus', $arr['estatus']);
        if ($arr['query'])
            $this->db->where("nombretipounidad LIKE '%". $arr['query']."%'");        


        $this->db->select('COUNT(1) AS cantidad');
        $query1 = $this->db->get('tbtipounidades');
        $respuesta['cantidad'] = $query1->result_array();


        $this->db->select('nombretipounidad AS Descripcion,estatus AS Estatus,idtipounidad AS Opciones');
        $this->db->from('tbtipounidades');        

        if ($arr['query'])
            $this->db->where("nombretipounidad LIKE '%". $arr['query']."%'");        

        $this->db->limit($cantidad, $offset);
        $this->db->order_by($order, $type);
        $query = $this->db->get();
        $respuesta['resultado'] = $query->result_array();

        $respuesta['meta'] = $query->list_fields();

        return $respuesta;
    }

    public function edit_tipo_unidad() {

        $arr = $this->getInputFromAngular();        
        $res = array();
        $arr['nombretipounidad'] = $arr['descripcion'];
        unset($arr['descripcion']);

        $this->db->select('nombretipounidad');
        $this->db->where('idtipounidad!=', $arr['id']);       
        $this->db->where('nombretipounidad', $arr['nombretipounidad']);        
        
        $query1 = $this->db->get('tbtipounidades');
        if ($query1->num_rows() > 0) {
            $res['status'] = 0;
            $res['mensaje'] = 'El Tipo  de Unidad ya se encuentra registrado';
            return $res;
        }         
      
        $this->db->flush_cache();
        $this->db->where('idtipounidad', $arr['id']);       
        unset($arr['id']);

        if ($this->db->update('tbtipounidades', $arr)) {
            $res['status'] = 1;
            $res['mensaje'] = 'Actualizado con Exito';
        } else {
            $res['status'] = 0;
            $res['mensaje'] = 'Ocurrio un Problema al Actualizar';
        }

        return $res;
    }

}
