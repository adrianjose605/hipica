<?php


class Tropiezo_model extends CI_Model {

//put your code here
    public function __construct() {
        $this->load->database();
    }

    public function get_prueba() {
        $query = $this->db->get('tbtropiezo');
        return $query->result_array();
    }

    public function get_Tropiezo($id) {
        
        $this->db->select('abreviatura, descripcion, fecha_registro, idtropiezo,estatus');
        $this->db->where('idtropiezo', $id);
        $query = $this->db->get('tbtropiezo');
        return $query->result_array();
        
    }

    public function generar_json_tabla_principal($offset, $cantidad, $order, $type) {
        $arr = $this->getInputFromAngular();
        $params = preg_split('#\s+#', trim($arr['query']));
        $w = false;
        //if ($arr['estatus'])
          //  $this->db->where('estatus', $arr['estatus']);
        $likes = '';


        for ($i = 0; $i != count($params); $i++) {
            if ($i == 0)
                $likes.="(descripcion LIKE '%" . $params[$i] . "%' OR abreviatura LIKE '%" . $params[$i] . "%'";
            else
                $likes.="OR descripcion LIKE '%" . $params[$i] . "%' OR abreviatura LIKE '%" . $params[$i] . "%'";
            if ($i + 1 == count($params))
                $likes.=")";
        }

        if (!empty($likes))
            $this->db->where($likes);


        $this->db->select('COUNT(1) AS cantidad');


        $query1 = $this->db->get('tbtropiezo');
        $respuesta['cantidad'] = $query1->result_array();

        $this->db->select('descripcion AS Descripcion,abreviatura AS Abreviatura,fecha_registro AS Registrado,estatus AS Estatus,idtropiezo AS Opciones');
        
        if (!empty($likes))
            $this->db->where($likes);


        $this->db->limit($cantidad, $offset);
        $this->db->order_by($order, $type);

        $query = $this->db->get('tbtropiezo');
        $respuesta['resultado'] = $query->result_array();
        $respuesta['meta'] = $query->list_fields();
        return $respuesta;
    }

    public function edit_tropiezo() {
        $res = array();
        $arr = $this->getInputFromAngular();
        
        $this->db->select('descripcion');
        $this->db->where('descripcion', $arr['descripcion']);
        $this->db->where('idtropiezo!=', $arr['idtropiezo']);
        $query1 = $this->db->get('tbtropiezo');
        if ($query1->num_rows() > 0) {
            $res['status'] = 0;
            $res['mensaje'] = 'El Tropiezo ya se Encuentra Registrado';
            return $res;
        }
        $this->db->flush_cache();
        
        
        
        $this->db->select('descripcion');
        $this->db->where('abreviatura', $arr['abreviatura']);
        $this->db->where('idtropiezo!=', $arr['idtropiezo']);
        $query1 = $this->db->get('tbtropiezo');
        if ($query1->num_rows() > 0) {
            $res['status'] = 0;
            $res['mensaje'] = 'La abreviatura ya se encuentra registrada';
            return $res;
        }
        $this->db->flush_cache();
        
        
        
        
        
        
        $this->db->where('idtropiezo', $arr['idtropiezo']);        
        unset($arr['idtropiezo']);
        unset($arr['fecha_registro']);
        if ($this->db->update('tbtropiezo', $arr)) {
            $res['status'] = 1;
            $res['mensaje'] = 'Actualizado con Exito';
            
        } else {
            $res['status'] = 0;
            $res['mensaje'] = 'Ocurrio un Problema al Actualizar';
          
        }
        return $res;
    }

    public function insert_tropiezo() {
        $arr = $this->getInputFromAngular();
        $res = array();
        $this->db->select('descripcion');
        $this->db->where('descripcion', $arr['descripcion']);
        $query1 = $this->db->get('tbtropiezo');
        if ($query1->num_rows() > 0) {
            $res['status'] = 0;
            $res['mensaje'] = 'El Tropiezo ya se encuentra registrado';
            return $res;
        }
$this->db->flush_cache();

        $this->db->select('abreviatura');
        $this->db->where('abreviatura', $arr['abreviatura']);
        $query1 = $this->db->get('tbtropiezo');
        if ($query1->num_rows() > 0) {
            $res['status'] = 0;
            $res['mensaje'] = 'La abreviatura ya se encuentra registrada con otro Tropiezo';
            return $res;
        }
        $this->db->flush_cache();


        $this->db->set('fecha_registro', 'NOW()', FALSE);

        if ($this->db->insert('tbtropiezo', $arr)) {
            $res['status'] = 1;
            $res['mensaje'] = 'Registrado con Exito';
        } else {
            $res['status'] = 0;
            $res['mensaje'] = 'Error Desconocido';
        }

        return $res;
    }

}
