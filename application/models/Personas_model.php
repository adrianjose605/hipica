<?php

class Personas_model extends CI_Model {

//put your code here
    public function __construct() {
        $this->load->database();
    }

    public function generar_json_tabla_principal($offset, $cantidad, $order, $type) {
        $arr = $this->getInputFromAngular();
        $params = preg_split('#\s+#', trim($arr['query']));
        $w = false;
        $likes = "";
        for ($i = 0; $i != count($params); $i++) {
            if ($i == 0)
                $likes.="(primer_nombre LIKE '%" . $params[$i] . "%' OR primer_apellido LIKE '%" . $params[$i] . "%'";
            else
                $likes.="OR primer_nombre LIKE '%" . $params[$i] . "%' OR primer_apellido LIKE '%" . $params[$i] . "%'";
            if ($i + 1 == count($params))
                $likes.=")";
        }

        if (!empty($likes))
            $this->db->where($likes);


        $this->db->select('COUNT(1) AS cantidad');


        $query1 = $this->db->get('tbpersona');
        $respuesta['cantidad'] = $query1->result_array();

        $this->db->select('idpersona AS ID,cedula as Cedula,primer_nombre AS Nombre,primer_apellido AS Apellido, usuario as Usuario, jinete as Jinete, propietario as Propietario, entrenador as Entrenador,idpersona AS Opciones');
        

        $this->db->limit($cantidad, $offset);
        $this->db->order_by($order, $type);

        $query = $this->db->get('tbpersona');
        $respuesta['resultado'] = $query->result_array();
        $respuesta['meta'] = $query->list_fields();
        return $respuesta;
    }

    public function edit_pais() {
        $res = array();
        $arr = $this->getInputFromAngular();
        $this->db->where('idpais', $arr['idpais']);        
        unset($arr['idpais']);
        unset($arr['fecha_registro']);
        if ($this->db->update('tbpersona', $arr)) {
            $res['status'] = 1;
            $res['mensaje'] = 'Actualizado con Exito';
        } else {
            $res['status'] = 0;
            $res['mensaje'] = 'Ocurrio un Problema al Actualizar';
        }
        return $res;
    }
}