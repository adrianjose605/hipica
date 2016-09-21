<?php

/**
 * Description of Pais
 *
 * @author zyos
 */
class Pais_model extends CI_Model {

//put your code here
    public function __construct() {
        $this->load->database();
    }
//
//    public function get_prueba() {
//        $query = $this->db->get('par_subproductos');
//        return $query->result_array();
//    }

    public function get_pais($id) {
        $this->db->select('nombre ,abreviatura,fecha_registro ,estatus,idpais');
        $this->db->where('idpais', $id);
        $query = $this->db->get('tbpais');
        return $query->result_array();
    }
    
    public function get_pais_sel($activos=false){
        $this->db->select('idpais  AS id,abreviatura AS val');
         
        if ($activos)
            $this->db->where('estatus', $activos);
        
        $query = $this->db->get('tbpais');
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
                $likes.="(nombre LIKE '%" . $params[$i] . "%' OR abreviatura LIKE '%" . $params[$i] . "%'";
            else
                $likes.="OR nombre LIKE '%" . $params[$i] . "%' OR abreviatura LIKE '%" . $params[$i] . "%'";
            if ($i + 1 == count($params))
                $likes.=")";
        }

        if (!empty($likes))
            $this->db->where($likes);


        $this->db->select('COUNT(1) AS cantidad');


        $query1 = $this->db->get('tbpais');
        $respuesta['cantidad'] = $query1->result_array();

        $this->db->select('nombre AS Nombre,abreviatura AS Abreviatura,fecha_registro AS Registrado,estatus AS Estatus,idpais AS Opciones');
        if ($arr['estatus'])
            $this->db->where('estatus', $arr['estatus']);
        if (!empty($likes))
            $this->db->where($likes);


        $this->db->limit($cantidad, $offset);
        $this->db->order_by($order, $type);

        $query = $this->db->get('tbpais');
        $respuesta['resultado'] = $query->result_array();
        $respuesta['meta'] = $query->list_fields();
        return $respuesta;
    }

    public function edit_pais() {
        $res = array();
        $arr = $this->getInputFromAngular();
         
        $this->db->where('idpais!=', $arr['idpais']);
        $this->db->where('nombre', $arr['nombre']);
        $query1 = $this->db->get('tbpais');
        if ($query1->num_rows() > 0) {
            $res['status'] = 0;
            $res['mensaje'] = 'El Pais ya se encuentra registrado';
            return $res;
        }        
        $this->db->flush_cache();
        
        
        $this->db->where('idpais!=', $arr['idpais']);
        $this->db->where('abreviatura', $arr['abreviatura']);
        $query1 = $this->db->get('tbpais');
        if ($query1->num_rows() > 0) {
            $res['status'] = 0;
            $res['mensaje'] = 'La abreviatura ya se encuentra Registrada';
            return $res;
        }        
        $this->db->flush_cache();
        
        
        
        
        
        
        $this->db->where('idpais', $arr['idpais']);        
        unset($arr['idpais']);
        unset($arr['fecha_registro']);
        if ($this->db->update('tbpais', $arr)) {
            $res['status'] = 1;
            $res['mensaje'] = 'Actualizado con Exito';
        } else {
            $res['status'] = 0;
            $res['mensaje'] = 'Ocurrio un Problema al Actualizar';
        }
        return $res;
    }

    public function insert_pais() {
        $arr = $this->getInputFromAngular();
        $res = array();
        $this->db->select('nombre');
        $this->db->where('nombre', $arr['nombre']);
        $query1 = $this->db->get('tbpais');
        if ($query1->num_rows() > 0) {
            $res['status'] = 0;
            $res['mensaje'] = 'El pais ya se encuentra registrado';
            return $res;
        }

        $this->db->select('abreviatura');
        $this->db->where('abreviatura', $arr['abreviatura']);
        $query1 = $this->db->get('tbpais');
        if ($query1->num_rows() > 0) {
            $res['status'] = 0;
            $res['mensaje'] = 'La abreviatura ya se encuentra registrada con otro pais';
            return $res;
        }

        $this->db->set('fecha_registro', 'NOW()', FALSE);

        if ($this->db->insert('tbpais', $arr)) {
            $res['status'] = 1;
            $res['mensaje'] = 'Registrado con Exito';
        } else {
            $res['status'] = 0;
            $res['mensaje'] = 'Error Desconocido';
        }

        return $res;
    }

}
