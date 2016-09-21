<?php

class Hipodromo_model extends CI_Model {

//put your code here
    public function __construct() {
        $this->load->database();
    }

    public function get_prueba() {
        $query = $this->db->get('tbhipodromo');
        return $query->result_array();
    }

    public function get_hipodromo($id) {
        $this->db->select('abreviatura, descripcion, idpais AS pais, fecha_registro, estatus, idhipodromo');
        $this->db->where('idhipodromo', $id);
        $query = $this->db->get('tbhipodromo');
        return $query->result_array();
    }
  public function search_hipodromo($descripcion = '') {
        $this->db->select('abreviatura ,idhipodromo AS id');
        $this->db->like('abreviatura', $descripcion);
        $query = $this->db->get('tbhipodromo');
        return $query->result_array();
    }
    public function generar_json_tabla_principal($offset, $cantidad, $order, $type) {
        $arr = $this->getInputFromAngular();
        $params = preg_split('#\s+#', trim($arr['query']));
        $w = false;
        if ($arr['estatus'])
            $this->db->where('estatus', $arr['estatus']);
        $likes = '';


        for ($i = 0; $i != count($params); $i++) {
            if ($i == 0)
                $likes.="(tbhipodromo.descripcion LIKE '%" . $params[$i] . "%' OR tbhipodromo.abreviatura LIKE '%" . $params[$i] . "%'";
            else
                $likes.="OR tbhipodromo.descripcion LIKE '%" . $params[$i] . "%' OR tbhipodromo.abreviatura LIKE '%" . $params[$i] . "%'";
            if ($i + 1 == count($params))
                $likes.=")";
        }

        if (!empty($likes))
            $this->db->where($likes);


        $this->db->select('COUNT(1) AS cantidad');


        $query1 = $this->db->get('tbhipodromo');
        $respuesta['cantidad'] = $query1->result_array();

        $this->db->select('tbhipodromo.descripcion AS Descripcion,tbhipodromo.abreviatura AS Abreviatura,tbpais.abreviatura AS Pais,tbhipodromo.fecha_registro AS Registrado,tbhipodromo.estatus AS Estatus,idhipodromo AS Opciones');
        $this->db->from('tbhipodromo');
        $this->db->join('tbpais', 'tbpais.idpais = tbhipodromo.idpais');
        if ($arr['estatus'])
            $this->db->where('tbhipodromo.estatus', $arr['estatus']);
        if (!empty($likes))
            $this->db->where($likes);


        $this->db->limit($cantidad, $offset);
        $this->db->order_by($order, $type);

        $query = $this->db->get();
        $respuesta['resultado'] = $query->result_array();
        $respuesta['meta'] = $query->list_fields();
        return $respuesta;
    }

    public function edit_hipodromo() {
        $res = array();
        $arr = $this->getInputFromAngular();
        $arr['idpais'] = $arr['pais'];
        unset($arr['pais']);
        $this->db->select('descripcion');
        $this->db->where('descripcion', $arr['descripcion']);
        $this->db->where('idhipodromo!=', $arr['idhipodromo']);
        $query1 = $this->db->get('tbhipodromo');
        if ($query1->num_rows() > 0) {
            $res['status'] = 0;
            $res['mensaje'] = 'El Hipodromo ya se encuentra registrado';
            return $res;
        }

        $this->db->select('abreviatura');
        $this->db->where('abreviatura', $arr['abreviatura']);
        $this->db->where('idhipodromo!=', $arr['idhipodromo']);

        $query1 = $this->db->get('tbhipodromo');
        if ($query1->num_rows() > 0) {
            $res['status'] = 0;
            $res['mensaje'] = 'La abreviatura ya se encuentra registrada con otro Hipodromo';
            return $res;
        }



        $this->db->where('idhipodromo', $arr['idhipodromo']);
        unset($arr['idhipodromo']);
        unset($arr['fecha_registro']);
        if ($this->db->update('tbhipodromo', $arr)) {
            $res['status'] = 1;
            $res['mensaje'] = 'Actualizado con Exito';
        } else {
            $res['status'] = 0;
            $res['mensaje'] = 'Ocurrio un Problema al Actualizar';
        }
        return $res;
    }

    public function insert_hipodromo() {
        $arr = $this->getInputFromAngular();
        $res = array();
        $arr['idpais'] = $arr['pais'];
        unset($arr['pais']);
        $this->db->select('descripcion');
        $this->db->where('descripcion', $arr['descripcion']);
        $query1 = $this->db->get('tbhipodromo');
        if ($query1->num_rows() > 0) {
            $res['status'] = 0;
            $res['mensaje'] = 'El Hipodromo ya se encuentra registrado';
            return $res;
        }

        $this->db->select('abreviatura');
        $this->db->where('abreviatura', $arr['abreviatura']);
        $query1 = $this->db->get('tbhipodromo');
        if ($query1->num_rows() > 0) {
            $res['status'] = 0;
            $res['mensaje'] = 'La abreviatura ya se encuentra registrada con otro Hipodromo';
            return $res;
        }


        if ($this->db->insert('tbhipodromo', $arr)) {
            $res['status'] = 1;
            $res['mensaje'] = 'Registrado con Exito';
        } else {
            $res['status'] = 0;
            $res['mensaje'] = 'Error Desconocido';
        }

        return $res;
    }
    
    public function get_hipodromo_sel($activos = false) {
        $this->db->select('idhipodromo  AS id,abreviatura AS val');
        if ($activos)
            $this->db->where('estatus', $activos);
        $query = $this->db->get('tbhipodromo');
        return $query->result_array();
    }
    
    public function get_hipodromo_pais_sel($pais,$activos = false) {
        $this->db->select('idhipodromo  AS id,abreviatura AS val');
        if ($activos)
            $this->db->where('estatus', $activos);
        
        $this->db->where('idpais',$pais);
        $query = $this->db->get('tbhipodromo');
        return $query->result_array();
    }
    
    
    

}
