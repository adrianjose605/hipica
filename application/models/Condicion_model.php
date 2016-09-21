<?php

class Condicion_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function get_tipo_condicion($all = false) {
        $this->db->select('idtipocondicion,descripcion,fecha_registro,tipocond_pond AS ponderacion,tipocond_orden AS orden,tipocond_multiple AS multiple, estatus');
        if (!$all)
            $this->db->where('idtipocondicion', $all);
        $query = $this->db->get('tbtipocondicion');
        return $query->result_array();
    }

    public function get_tipo_condicion_sel($activos = false) {
        $this->db->select('idtipocondicion  AS id,descripcion AS val');

        if ($activos)
            $this->db->where('estatus', $activos);

        $query = $this->db->get('tbtipocondicion');
        return $query->result_array();
    }

    public function generar_json_tabla_tipo_condicion($offset, $cantidad, $order, $type) {
        $arr = $this->getInputFromAngular();
        $params = preg_split('#\s+#', trim($arr['query']));
        $w = false;
        if ($arr['estatus'])
            $this->db->where('estatus', $arr['estatus']);
        $likes = '';


        for ($i = 0; $i != count($params); $i++) {
            if ($i == 0)
                $likes.="(descripcion LIKE '%" . $params[$i] . "%'";
            else
                $likes.="OR descripcion LIKE '%" . $params[$i] . "%'";
            if ($i + 1 == count($params))
                $likes.=")";
        }

        if (!empty($likes))
            $this->db->where($likes);


        $this->db->select('COUNT(1) AS cantidad');
        $query1 = $this->db->get('tbtipocondicion');
        $respuesta['cantidad'] = $query1->result_array();




        $this->db->select('descripcion AS Descripcion,fecha_registro AS Registrado,tipocond_pond AS Ponderacion,tipocond_orden AS Orden,tipocond_multiple AS Multiple, estatus AS Estatus,idtipocondicion AS Opciones');
        if ($arr['estatus'])
            $this->db->where('estatus', $arr['estatus']);
        if (!empty($likes))
            $this->db->where($likes);

        $this->db->limit($cantidad, $offset);
        $this->db->order_by($order, $type);
        $query = $this->db->get('tbtipocondicion');
        $respuesta['resultado'] = $query->result_array();

        $respuesta['meta'] = $query->list_fields();

        return $respuesta;
    }

    public function edit_tipo_condicion() {
        $res = array();
        $arr = $this->getInputFromAngular();

        $this->db->select('descripcion');
        $this->db->where('descripcion', $arr['descripcion']);
        $this->db->where('idtipocondicion!=', $arr['idtipocondicion']);
        $query1 = $this->db->get('tbtipocondicion');
        if ($query1->num_rows() > 0) {
            $res['status'] = 0;
            $res['mensaje'] = 'El Tipo  de Condicion ya se encuentra registrado';
            return $res;
        }

        $this->db->where('idtipocondicion', $arr['idtipocondicion']);
        unset($arr['idtipocondicion']);
        $arr['tipocond_pond'] = $arr['ponderacion'];
        $arr['tipocond_orden'] = $arr['orden'];
        $arr['tipocond_multiple'] = $arr['multiple'];
        unset($arr['ponderacion']);
        unset($arr['orden']);
        unset($arr['multiple']);



        unset($arr['fecha_registro']);
        if ($this->db->update('tbtipocondicion', $arr)) {
            $res['status'] = 1;
            $res['mensaje'] = 'Actualizado con Exito';
        } else {
            $res['status'] = 0;
            $res['mensaje'] = 'Ocurrio un Problema al Actualizar';
        }

        return $res;
    }

    public function insert_tipo_condicion() {
        $arr = $this->getInputFromAngular();
        $res = array();
        $arr['tipocond_pond'] = $arr['ponderacion'];
        $arr['tipocond_orden'] = $arr['orden'];
        $arr['tipocond_multiple'] = $arr['multiple'];
        unset($arr['ponderacion']);
        unset($arr['orden']);
        unset($arr['multiple']);

        $this->db->select('descripcion');
        $this->db->where('descripcion', $arr['descripcion']);
        $query1 = $this->db->get('tbtipocondicion');
        if ($query1->num_rows() > 0) {
            $res['status'] = 0;
            $res['mensaje'] = 'El Tipo  de Condicion ya se encuentra registrado';
            return $res;
        }


        if ($this->db->insert('tbtipocondicion', $arr)) {
            $res['status'] = 1;
            $res['mensaje'] = 'Se inserto con exito';
        } else {
            $res['status'] = 0;
            $res['mensaje'] = 'Ups! , Ha ocurrido un error';
        }

        return $res;
    }

    /*
     * INICIO  DE SEGMENTO  DE CONDICiONES
     */

    public function get_condicion($all = false) {
        $this->db->select('cond_descrip AS descripcion,idpais AS pais,cond_abrev AS abreviatura,idtipocondicion AS tipo,tbcondicion.fecha_registro AS registrado,cond_pond AS ponderacion,tbcondicion.estatus AS estatus,idcondicion AS id');
        $this->db->from('tbcondicion');
        
        
        
            $this->db->where('idcondicion', $all);
        $query = $this->db->get('');
        return $query->result_array();
    }

    public function generar_json_tabla_condicion($offset, $cantidad, $order, $type) {
        $arr = $this->getInputFromAngular();
        $params = preg_split('#\s+#', trim($arr['query']));
        $w = false;
        if ($arr['estatus'])
            $this->db->where('tbcondicion.estatus', $arr['estatus']);
        $likes = '';


        for ($i = 0; $i != count($params); $i++) {
            if ($i == 0)
                $likes.="(cond_descrip LIKE '%" . $params[$i] . "%' OR cond_abrev LIKE '%" . $params[$i] . "%'";
            else
                $likes.="OR cond_descrip LIKE '%" . $params[$i] . "%' OR cond_abrev LIKE '%" . $params[$i] . "%'";
            if ($i + 1 == count($params))
                $likes.=")";
        }

        if (!empty($likes))
            $this->db->where($likes);


        $this->db->select('COUNT(1) AS cantidad');
        $query1 = $this->db->get('tbcondicion');
        $respuesta['cantidad'] = $query1->result_array();




        $this->db->select('cond_descrip AS Descripcion,cond_abrev AS Abreviatura,tbpais.Abreviatura AS  Pais,tbtipocondicion.descripcion AS Tipo,tbcondicion.fecha_registro AS Registrado,cond_pond AS Ponderacion, tbcondicion.estatus AS Estatus,idcondicion AS Opciones');
        $this->db->from('tbcondicion');
        $this->db->join('tbtipocondicion', 'tbtipocondicion.idtipocondicion = tbcondicion.idtipocondicion');
        $this->db->join('tbpais', 'tbpais.idpais = tbcondicion.idpais');
        if ($arr['estatus'])
            $this->db->where('tbcondicion.estatus', $arr['estatus']);
        if (!empty($likes))
            $this->db->where($likes);

        $this->db->limit($cantidad, $offset);
        $this->db->order_by($order, $type);
        $query = $this->db->get();
        $respuesta['resultado'] = $query->result_array();

        $respuesta['meta'] = $query->list_fields();

        return $respuesta;
    }

    public function edit_condicion() {

        $arr = $this->getInputFromAngular();
        $res = array();
        $arr['idtipocondicion'] = $arr['tipo'];
        $arr['cond_pond'] = $arr['ponderacion'];
        $arr['cond_descrip'] = $arr['descripcion'];
        $arr['cond_abrev'] = $arr['abreviatura'];
        $arr['idpais'] = $arr['pais'];

        unset($arr['ponderacion']);
        unset($arr['pais']);
        unset($arr['registrado']);
        unset($arr['descripcion']);
        unset($arr['abreviatura']);
        unset($arr['tipo']);

        $this->db->select('cond_pond');
        $this->db->where('cond_descrip', $arr['cond_descrip']);
        $this->db->where('idpais', $arr['idpais']);
        $this->db->where('idcondicion!=', $arr['id']);
        $query1 = $this->db->get('tbcondicion');
        if ($query1->num_rows() > 0) {
            $res['status'] = 0;
            $res['mensaje'] = 'La Condicion ya se encuentra registrada Con Otro Pais';
            return $res;
        }
        $this->db->flush_cache();


        $this->db->select('cond_pond');
        $this->db->where('cond_abrev', $arr['cond_abrev']);
        $this->db->where('idpais', $arr['idpais']);
        $this->db->where('idcondicion!=', $arr['id']);
        $query1 = $this->db->get('tbcondicion');
        if ($query1->num_rows() > 0) {
            $res['status'] = 0;
            $res['mensaje'] = 'La abreviatura ya se encuentra Registrada Con Otro Pais';
            return $res;
        }
        $this->db->flush_cache();

        $this->db->where('idcondicion', $arr['id']);
        unset($arr['id']);


        if ($this->db->update('tbcondicion', $arr)) {
            $res['status'] = 1;
            $res['mensaje'] = 'Actualizado con Exito';
        } else {
            $res['status'] = 0;
            $res['mensaje'] = 'Ocurrio un Problema al Actualizar';
        }

        return $res;
    }

    public function insert_condicion() {
        $arr = $this->getInputFromAngular();
        $res = array();
        $arr['idtipocondicion'] = $arr['tipo'];
        $arr['cond_pond'] = $arr['ponderacion'];        
        $arr['cond_descrip'] = $arr['descripcion'];
        $arr['cond_abrev'] = $arr['abreviatura'];
        $arr['idpais'] = $arr['pais'];
        unset($arr['ponderacion']);
        unset($arr['pais']);
        unset($arr['descripcion']);
        unset($arr['abreviatura']);
        unset($arr['tipo']);

        $this->db->select('cond_pond');
        $this->db->where('cond_descrip', $arr['cond_descrip']);
        $this->db->where('idpais', $arr['idpais']);
        $query1 = $this->db->get('tbcondicion');
        if ($query1->num_rows() > 0) {
            $res['status'] = 0;
            $res['mensaje'] = 'El Tipo  de Condicion ya se encuentra registrado';
            return $res;
        }


        $this->db->select('cond_pond');
        $this->db->where('cond_abrev', $arr['cond_abrev']);
        $this->db->where('idpais', $arr['idpais']);
        $query1 = $this->db->get('tbcondicion');
        if ($query1->num_rows() > 0) {
            $res['status'] = 0;
            $res['mensaje'] = 'La abreviatura ya se encuentra Registrada';
            return $res;
        }

        if ($this->db->insert('tbcondicion', $arr)) {
            $res['status'] = 1;
            $res['mensaje'] = 'Se inserto con exito';
        } else {
            $res['status'] = 0;
            $res['mensaje'] = 'Ups! , Ha ocurrido un error';
        }

        return $res;
    }
    
    
    public function search_condicion($condicion = '') {
        $this->db->select('cond_descrip AS condicion ,idcondicion AS id');
        $this->db->select('tbtipocondicion.descripcion AS tipo');
        $this->db->like('cond_descrip', $condicion);
        $this->db->from('tbcondicion');
        $this->db->join('tbtipocondicion','tbtipocondicion.idtipocondicion=tbcondicion.idtipocondicion');
        $query = $this->db->get();
        return $query->result_array();
    }


}
