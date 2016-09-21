<?php

class Grupo_usuario_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function insert_grupo_usuario() {

        $arr = $this->getInputFromAngular();
        $res = array();
        $this->db->select('nombre');
        $this->db->where('nombre', $arr['nombre']);
        $query1 = $this->db->get('tbgrupo');

        if ($query1->num_rows() > 0) {
            $res['status'] = 0;
            $res['mensaje'] = 'Nombre de grupo ya se encuentra registrado';
            return $res;
        }
        if ($this->db->insert('tbgrupo', $arr)) {
            $res['status'] = 1;
            $res['mensaje'] = 'Se inserto con exito';
        } else {
            $res['status'] = 0;
            $res['mensaje'] = 'Ups! , Ha ocurrido un error';
        }
        return $res;
    }
    
    public function generar_json_tabla_principal($offset, $cantidad, $order, $type) {
        $arr = $this->getInputFromAngular();
        $params = preg_split('#\s+#', trim($arr['query']));
        $w = false;
        $likes = '';
        for ($i = 0; $i != count($params); $i++) {
            if ($i == 0)
                $likes.="(nombre LIKE '%" . $params[$i] . "%' OR idgrupo LIKE '%" . $params[$i] . "%'";
            else
                $likes.="OR nombre LIKE '%" . $params[$i] . "%' OR idgrupo LIKE '%" . $params[$i] . "%'";
            if ($i + 1 == count($params))
                $likes.=")";
        }

        if (!empty($likes))
            $this->db->where($likes);


        $this->db->select('COUNT(1) AS cantidad');


        $query1 = $this->db->get('tbgrupo');
        $respuesta['cantidad'] = $query1->result_array();

        $this->db->select('nombre AS Nombre,abreviatura AS Abreviatura,fecha_registro AS Registrado,estatus AS Estatus,idpais AS Opciones');
        if ($arr['estatus'])
            $this->db->where('estatus', $arr['estatus']);
        if (!empty($likes))
            $this->db->where($likes);


        $this->db->limit($cantidad, $offset);
        $this->db->order_by($order, $type);

        $query = $this->db->get('tbgrupo');
        $respuesta['resultado'] = $query->result_array();
        $respuesta['meta'] = $query->list_fields();
        return $respuesta;
    }

}
