<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Ejemplar_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function get_tipo_pelaje($all = false) {
        $this->db->select('idtipopelaje,abreviatura,descripcion,fecharegistro,estatus');
        $this->db->where('idtipopelaje', $all);
        $query = $this->db->get('tbtipopelaje');
        return $query->result_array();
    }

    public function get_estatus() {
        $this->db->select('id,nombre');
        $query = $this->db->get('tbejemplarstatus');
        return $query->result_array();
    }

    public function generar_json_tabla_tipo_pelaje($offset, $cantidad, $order, $type) {
        $arr = $this->getInputFromAngular();
        $params = preg_split('#\s+#', trim($arr['query']));
        $w = false;
        if ($arr['estatus'])
            $this->db->where('estatus', $arr['estatus']);
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


        $query1 = $this->db->get('tbtipopelaje');
        $respuesta['cantidad'] = $query1->result_array();

        $this->db->select('descripcion AS Descripcion,abreviatura AS Abreviatura,fecharegistro AS Registrado, estatus AS Estatus,idtipopelaje AS Opciones');
        if ($arr['estatus'])
            $this->db->where('estatus', $arr['estatus']);
        if (!empty($likes))
            $this->db->where($likes);


        $this->db->limit($cantidad, $offset);
        $this->db->order_by($order, $type);

        $query = $this->db->get('tbtipopelaje');
        $respuesta['resultado'] = $query->result_array();
        $respuesta['meta'] = $query->list_fields();
        return $respuesta;
    }

    public function edit_tipo_pelaje() {
        $res = array();
        $arr = $this->getInputFromAngular();

        $this->db->select('descripcion');
        $this->db->where('descripcion', $arr['descripcion']);
        $this->db->where('idtipopelaje!=', $arr['idtipopelaje']);

        $query1 = $this->db->get('tbtipopelaje');
        if ($query1->num_rows() > 0) {
            $res['status'] = 0;
            $res['mensaje'] = 'El tipo de pelaje ya se encuentra registrado';
            return $res;
        }
        $this->db->flush_cache();


        $this->db->select('descripcion');
        $this->db->where('abreviatura', $arr['abreviatura']);
        $this->db->where('idtipopelaje!=', $arr['idtipopelaje']);

        $query1 = $this->db->get('tbtipopelaje');
        if ($query1->num_rows() > 0) {
            $res['status'] = 0;
            $res['mensaje'] = 'La abreviatura ya se encuentra registrada';
            return $res;
        }

        $this->db->flush_cache();






        $this->db->where('idtipopelaje', $arr['idtipopelaje']);
        unset($arr['idtipopelaje']);



        unset($arr['fecharegistro']);
        if ($this->db->update('tbtipopelaje', $arr)) {
            $res['status'] = 1;
            $res['mensaje'] = 'Actualizado con Exito';
        } else {
            $res['status'] = 0;
            $res['mensaje'] = 'Ocurrio un Problema al Actualizar';
        }

        return $res;
    }

    public function get_tipo_pelaje_sel($activos = false) {
        $this->db->select('idtipopelaje  AS id,abreviatura AS val');

        if ($activos)
            $this->db->where('estatus', $activos);

        $query = $this->db->get('tbtipopelaje');
        return $query->result_array();
    }

    public function insert_tipo_pelaje() {
        $arr = $this->getInputFromAngular();
        $res = array();
        $this->db->select('descripcion');
        $this->db->where('descripcion', $arr['descripcion']);
        $query1 = $this->db->get('tbtipopelaje');
        if ($query1->num_rows() > 0) {
            $res['status'] = 0;
            $res['mensaje'] = 'El tipo de pelaje ya se encuentra registrado';
            return $res;
        }
        $this->db->flush_cache();


        $this->db->select('descripcion');
        $this->db->where('abreviatura', $arr['abreviatura']);
        $query1 = $this->db->get('tbtipopelaje');
        if ($query1->num_rows() > 0) {
            $res['status'] = 0;
            $res['mensaje'] = 'La abreviatura ya se encuentra registrada';
            return $res;
        }

        $this->db->flush_cache();


        $this->db->set('fecharegistro', 'NOW()', FALSE);


        if ($this->db->insert('tbtipopelaje', $arr)) {
            $res['status'] = 1;
            $res['mensaje'] = 'Se inserto con exito';
        } else {
            $res['status'] = 0;
            $res['mensaje'] = 'Ups! , Ha ocurrido un error';
        }

        return $res;
    }

    //SEGMENTO  DE ORIGEN

    public function get_tipo_origen($all = false) {
        $this->db->select('idtipoorigen,descripcion,abreviatura,fecha_registro,estatus');

        $this->db->where('idtipoorigen', $all);
        $query = $this->db->get('tbtipoorigen');
        return $query->result_array();
    }

    public function get_tipo_origen_sel($activos = false) {
        $this->db->select('idtipoorigen  AS id,abreviatura AS val');

        if ($activos)
            $this->db->where('estatus', $activos);

        $query = $this->db->get('tbtipoorigen');
        return $query->result_array();
    }

    public function generar_json_tabla_tipo_origen($offset, $cantidad, $order, $type) {
        $arr = $this->getInputFromAngular();
        $this->db->select('COUNT(1) AS cantidad');
        if ($arr['estatus'])
            $this->db->where('estatus', $arr['estatus']);
        if (!empty($arr['query']))
            $this->db->like('descripcion', $arr['query']);



        $query1 = $this->db->get('tbtipoorigen');
        $respuesta['cantidad'] = $query1->result_array();




        $this->db->select('descripcion AS Descripcion,abreviatura AS Abreviatura, fecha_registro AS Registrado, estatus AS Estatus,idtipoorigen AS Opciones');
        if ($arr['estatus'])
            $this->db->where('estatus', $arr['estatus']);
        if (isset($arr['query']))
            $this->db->like('descripcion', $arr['query']);

        $this->db->limit($cantidad, $offset);
        $this->db->order_by($order, $type);
        $query = $this->db->get('tbtipoorigen');
        $respuesta['resultado'] = $query->result_array();

        $respuesta['meta'] = $query->list_fields();

        return $respuesta;
    }

    public function edit_tipo_origen() {
        $res = array();
        $arr = $this->getInputFromAngular();

        $this->db->select('descripcion');
        $this->db->where('descripcion', $arr['descripcion']);
        $this->db->where('idtipoorigen!=', $arr['idtipoorigen']);
        $query1 = $this->db->get('tbtipoorigen');
        if ($query1->num_rows() > 0) {
            $res['status'] = 0;
            $res['mensaje'] = 'El Tipo de Origen ya se Encuentra Registrado';
            return $res;
        }
        $this->db->flush_cache();



        $this->db->select('descripcion');
        $this->db->where('abreviatura', $arr['abreviatura']);
        $this->db->where('idtipoorigen!=', $arr['idtipoorigen']);
        $query1 = $this->db->get('tbtipoorigen');
        if ($query1->num_rows() > 0) {
            $res['status'] = 0;
            $res['mensaje'] = 'La abreviatura ya se encuentra Registrada';
            return $res;
        }
        $this->db->flush_cache();





        $this->db->where('idtipoorigen', $arr['idtipoorigen']);
        unset($arr['idtipoorigen']);

        unset($arr['fecharegistro']);
        if ($this->db->update('tbtipoorigen', $arr)) {
            $res['status'] = 1;
            $res['mensaje'] = 'Actualizado con Exito';
        } else {
            $res['status'] = 0;
            $res['mensaje'] = 'Ocurrio un Problema al Actualizar';
        }

        return $res;
    }

    public function insert_tipo_origen() {
        $arr = $this->getInputFromAngular();
        $res = array();


        $this->db->select('descripcion');
        $this->db->where('descripcion', $arr['descripcion']);
        $query1 = $this->db->get('tbtipoorigen');
        if ($query1->num_rows() > 0) {
            $res['status'] = 0;
            $res['mensaje'] = 'El tipo de Origen ya se encuentra registrado';
            return $res;
        }
        $this->db->set('fecha_registro', 'NOW()', FALSE);

        $this->db->flush_cache();


        $this->db->select('descripcion');
        $this->db->where('abreviatura', $arr['abreviatura']);

        $query1 = $this->db->get('tbtipoorigen');
        if ($query1->num_rows() > 0) {
            $res['status'] = 0;
            $res['mensaje'] = 'La abreviatura ya se encuentra Registrada';
            return $res;
        }
        $this->db->flush_cache();


        if ($this->db->insert('tbtipoorigen', $arr)) {
            $res['status'] = 1;
            $res['mensaje'] = 'Se inserto con exito';
        } else {
            $res['status'] = 0;
            $res['mensaje'] = 'Ups! , Ha ocurrido un error';
        }

        return $res;
    }

    /**
     * Creacion del Modulo  de Ejemplares
     */
    public function get_ejemplar($id) {
        $this->db->select('fecha_nacimiento, tbejemplar.comentario_inicial,tbejemplar.nombre,tbejemplar.nombre_abrev,idpais AS pais,idtipopelaje AS pelaje,idtipoorigen AS origen, idharas AS hara,idstud AS stud,tbejemplar.sexo AS sexo,idejemplarmadre AS madre, idejemplarpadre AS padre,tbejemplar.castrado, tbejemplar.estatus, tbejemplar.idejemplar AS id');
        $this->db->where('idejemplar', $id);
        $query = $this->db->get('tbejemplar');
        return $query->result_array();
    }

    public function get_ejemplar_sel($activos = false, $sexo = 1) {
        $this->db->select('nombre AS val,idejemplar AS id');

        if ($activos)
            $this->db->where('estatus', $activos);
        $this->db->where('sexo', $sexo);

        $query = $this->db->get('tbejemplar');
        return $query->result_array();
    }

    public function edit_ejemplar() {

        $arr = $this->getInputFromAngular();
        $res = array();
        $arr['idpais'] = $arr['pais'];
        $arr['idtipopelaje'] = $arr['pelaje'];
        $arr['idtipoorigen'] = $arr['origen'];
        $arr['idstud'] = $arr['stud'];
        $arr['idharas'] = $arr['hara'];

        if (isset($arr['padre'])) {
            $arr['idejemplarpadre'] = $arr['padre'];
            unset($arr['padre']);
        }

        if (isset($arr['madre'])) {
            $arr['idejemplarmadre'] = $arr['madre'];
            unset($arr['madre']);
        }

        unset($arr['pais']);
        unset($arr['pelaje']);
        unset($arr['origen']);
        unset($arr['stud']);
        unset($arr['hara']);





        $arr['idejemplar'] = $arr['id'];
        unset($arr['id']);

        $this->db->select('idejemplar');
        $this->db->where('idejemplar!=', $arr['idejemplar']);
        $this->db->where('nombre', $arr['nombre']);
        $query1 = $this->db->get('tbejemplar');
        if ($query1->num_rows() > 0) {
            $res['status'] = 0;
            $res['mensaje'] = 'El Ejemplar ya se encuentra registrado';
            return $res;
        }

        $this->db->flush_cache();

        $this->db->select('idejemplar');
        $this->db->where('idejemplar!=', $arr['idejemplar']);
        $this->db->where('nombre_abrev', $arr['nombre_abrev']);
        $query1 = $this->db->get('tbejemplar');
        if ($query1->num_rows() > 0) {
            $res['status'] = 0;
            $res['mensaje'] = 'La Abreviatura ya se encuentra registrada';
            return $res;
        }
        $this->db->flush_cache();




        $this->db->where('idejemplar', $arr['idejemplar']);
        unset($arr['idejemplar']);
        if ($this->db->update('tbejemplar', $arr)) {
            $res['status'] = 1;
            $res['mensaje'] = 'Actualizado con Exito';
        } else {
            $res['status'] = 0;
            $res['mensaje'] = 'Ocurrio un Problema al Actualizar';
        }

        return $res;
    }

    public function search_ejemplar($descripcion = '') {
        $this->db->select('nombre AS ejemplar ,idejemplar AS id');
        $this->db->like('nombre', $descripcion);
        $query = $this->db->get('tbejemplar');
        return $query->result_array();
    }

    public function insert_ejemplar() {
        $arr = $this->getInputFromAngular();
        $res = array();
        $arr['idpais'] = $arr['pais'];
        $arr['idtipopelaje'] = $arr['pelaje'];
        $arr['idtipoorigen'] = $arr['origen'];
        $arr['idstud'] = $arr['stud'];
        $arr['idharas'] = $arr['hara'];

        if (isset($arr['padre'])) {
            $arr['idejemplarpadre'] = $arr['padre'];
            unset($arr['padre']);
        }

        if (isset($arr['madre'])) {
            $arr['idejemplarmadre'] = $arr['madre'];
            unset($arr['madre']);
        }

        unset($arr['pais']);
        unset($arr['pelaje']);
        unset($arr['origen']);
        unset($arr['stud']);
        unset($arr['hara']);






        $this->db->select('nombre');
        $this->db->where('nombre', $arr['nombre']);
        $query1 = $this->db->get('tbejemplar');
        if ($query1->num_rows() > 0) {
            $res['status'] = 0;
            $res['mensaje'] = 'El Nombre ya se encuentra Resgistrado para  algun ejemplar';
            return $res;
        }

        $this->db->flush_cache();

        $this->db->select('nombre');
        $this->db->where('nombre_abrev', $arr['nombre_abrev']);
        $query1 = $this->db->get('tbejemplar');
        if ($query1->num_rows() > 0) {
            $res['status'] = 0;
            $res['mensaje'] = 'La abreviatura ya se encuentra registrada';
            return $res;
        }

        $this->db->flush_cache();





        if ($this->db->insert('tbejemplar', $arr)) {
            $res['status'] = 1;
            $res['mensaje'] = 'Se inserto con exito';
        } else {
            $res['status'] = 0;
            $res['mensaje'] = 'Ups! , Ha ocurrido un error';
        }

        return $res;
    }

    public function generar_json_tabla_ejemplar($offset, $cantidad, $order, $type) {
        $arr = $this->getInputFromAngular();
        $params = preg_split('#\s+#', trim($arr['query']));
        $w = false;
        if ($arr['estatus'])
            $this->db->where('tbejemplar.estatus', $arr['estatus']);
        $likes = '';


        for ($i = 0; $i != count($params); $i++) {
            if ($i == 0)
                $likes.="(tbejemplar.nombre LIKE '%" . $params[$i] . "%' OR tbejemplar.nombre_abrev LIKE '%" . $params[$i] . "%'";
            else
                $likes.="OR tbejemplar.nombre LIKE '%" . $params[$i] . "%' OR tbejemplar.nombre_abrev LIKE '%" . $params[$i] . "%'";
            if ($i + 1 == count($params))
                $likes.=")";
        }

        if (!empty($likes))
            $this->db->where($likes);
        $this->db->where('tbejemplar.idejemplar!=1 AND tbejemplar.idejemplar!=2');


        $this->db->select('COUNT(1) AS cantidad');


        $query1 = $this->db->get('tbejemplar');
        $respuesta['cantidad'] = $query1->result_array();

        $this->db->select('tbejemplar.nombre AS Nombre,tbejemplar.nombre_abrev AS Abreviatura,tbpais.abreviatura AS Pais,tbtipopelaje.abreviatura AS Pelaje,tbtipoorigen.abreviatura AS Origen, tbharas.nombre AS Hara,tbstud.nombre AS Stud,tbejemplar.sexo AS Sexo,madre.nombre_abrev AS Madre, padre.nombre_abrev AS Padre, tbejemplar.estatus AS Estatus, tbejemplar.idejemplar AS Opciones');
        $this->db->from('tbejemplar');
        $this->db->join('tbpais', 'tbpais.idpais=tbejemplar.idpais');
        $this->db->join('tbharas', 'tbharas.idharas=tbejemplar.idharas');
        $this->db->join('tbstud', 'tbstud.idstud=tbejemplar.idstud');
        $this->db->join('tbtipoorigen', 'tbtipoorigen.idtipoorigen=tbejemplar.idtipoorigen');
        $this->db->join('tbtipopelaje', 'tbtipopelaje.idtipopelaje=tbejemplar.idtipopelaje');
        $this->db->join('tbejemplar AS padre', 'padre.idejemplar=tbejemplar.idejemplarpadre', 'left');
        $this->db->join('tbejemplar AS madre', 'madre.idejemplar=tbejemplar.idejemplarmadre', 'left');

        $this->db->where('tbejemplar.idejemplar!=1 AND tbejemplar.idejemplar!=2');

        if ($arr['estatus'])
            $this->db->where('tbejemplar.estatus', $arr['estatus']);
        if (!empty($likes))
            $this->db->where($likes);


        $this->db->limit($cantidad, $offset);
        $this->db->order_by($order, $type);

        $query = $this->db->get();
        $respuesta['resultado'] = $query->result_array();
        $respuesta['meta'] = $query->list_fields();
        return $respuesta;
    }

}
