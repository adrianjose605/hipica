<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Pista_model
 *
 * @author zyos
 */
class Pista_model extends CI_Model {

//put your code here
    public function __construct() {
        $this->load->database();
    }

    public function edit_tipo_pista() {
        $res = array();

        $arr = $this->getInputFromAngular();

        $this->db->select('descripcion');
        $this->db->where('descripcion', $arr['descripcion']);
        $this->db->where('idtipopista!=', $arr['idtipopista']);

        $query1 = $this->db->get('tbtipopista');
        if ($query1->num_rows() > 0) {
            $res['status'] = 0;
            $res['mensaje'] = 'El tipo de pista ya se encuentra registrada';
            return $res;
        }
        $this->db->flush_cache();



        $this->db->where('idtipopista', $arr['idtipopista']);
        unset($arr['idtipopista']);
        if ($this->db->update('tbtipopista', $arr)) {
            $res['status'] = 1;
            $res['mensaje'] = 'Actualizado con Exito';
        } else {
            $res['status'] = 0;
            $res['mensaje'] = 'Ocurrio un Problema al Actualizar';
        }

        return $res;
    }

    public function insert_tipoPista() {

        $arr = $this->getInputFromAngular();
        $res = array();
        $this->db->select('descripcion');
        $this->db->where('descripcion', $arr['descripcion']);
        $query1 = $this->db->get('tbtipopista');
        if ($query1->num_rows() > 0) {
            $res['status'] = 0;
            $res['mensaje'] = 'El tipo de pista ya se encuentra registrado';
            return $res;
        }


        if ($this->db->insert('tbtipopista', $arr)) {
            $res['status'] = 1;
            $res['mensaje'] = 'Se inserto con exito';
        } else {
            $res['status'] = 0;
            $res['mensaje'] = 'Ups! , Ha ocurrido un error';
        }





        return $res;
    }

    public function get_tipo_pista($id) {
        $this->db->select('descripcion ,estatus,idtipopista');
        $this->db->where('idtipopista', $id);
        $query = $this->db->get('tbtipopista');
        return $query->result_array();
    }

    public function generar_json_tabla_tipo_pista($offset, $cantidad, $order, $type) {
        $arr = $this->getInputFromAngular();


        $this->db->select('COUNT(1) AS cantidad');
        if ($arr['estatus'])
            $this->db->where('estatus', $arr['estatus']);
        if (!empty($arr['query']))
            $this->db->like('descripcion', $arr['query']);



        $query1 = $this->db->get('tbtipopista');
        $respuesta['cantidad'] = $query1->result_array();




        $this->db->select('descripcion AS Descripcion, estatus AS Estatus,idtipopista AS Opciones');
        if ($arr['estatus'])
            $this->db->where('estatus', $arr['estatus']);
        if (isset($arr['query']))
            $this->db->like('descripcion', $arr['query']);

        $this->db->limit($cantidad, $offset);
        $this->db->order_by($order, $type);
        $query = $this->db->get('tbtipopista');
        $respuesta['resultado'] = $query->result_array();

        $respuesta['meta'] = $query->list_fields();

        return $respuesta;
    }

    /**
     * INICIO DE LA SECCION DE DISTANCIAS
     * 
     */
    public function edit_distancia() {
        $res = array();

        $arr = $this->getInputFromAngular();
        $this->db->where('iddistancia', $arr['iddistancia']);
        unset($arr['iddistancia']);
        if ($this->db->update('tbdistancia', $arr)) {
            $res['status'] = 1;
            $res['mensaje'] = 'Actualizado con Exito';
        } else {
            $res['status'] = 0;
            $res['mensaje'] = 'Ocurrio un Problema al Actualizar';
        }

        return $res;
    }

    public function insert_distancia() {

        $arr = $this->getInputFromAngular();
        $res = array();
        $this->db->select('distancia');
        $this->db->where('distancia', $arr['distancia']);
        $query1 = $this->db->get('tbdistancia');
        if ($query1->num_rows() > 0) {
            $res['status'] = 0;
            $res['mensaje'] = 'La distancia ya se encuentra registrada';
            return $res;
        }


        if ($this->db->insert('tbdistancia', $arr)) {
            $res['status'] = 1;
            $res['mensaje'] = 'Se inserto con exito';
        } else {
            $res['status'] = 0;
            $res['mensaje'] = 'Ups! , Ha ocurrido un error';
        }
        return $res;
    }

    public function get_distancias_asociadas($idpista) {
        $this->db->select('tbdistancia.distancia ,tbdistancia.iddistancia AS id');
        $this->db->where('tbdistancia.estatus', true);
        $this->db->where('tbpistadistancia.estatus', true);
        $this->db->where('tbpistadistancia.idpista', $idpista);
        $this->db->from('tbdistancia');
        $this->db->join('tbpistadistancia', 'tbpistadistancia.iddistancia = tbdistancia.iddistancia');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function asociar_pistas($id, $pistas) {
        $this->db->where('idpista', $id);
        $this->db->set('estatus', false);
        $this->db->update('tbpistadistancia');

        foreach ($pistas AS $pista) {
            $this->db->flush_cache();
            $this->db->where('idpista', $id);
            $this->db->where('iddistancia', $pista['id']);
            $q = $this->db->get('tbpistadistancia');
            if ($q->num_rows() > 0) {
                $this->db->where('idpista', $id);
                $this->db->where('iddistancia', $pista['id']);
                $this->db->set('estatus', true);
                $this->db->update('tbpistadistancia');
            } else {
                $this->db->set('idpista', $id);
                $this->db->set('iddistancia', $pista['id']);
                $this->db->insert('tbpistadistancia');
            }
        }
    }

    public function search_distancia($descripcion = '') {
        $this->db->select('distancia ,iddistancia AS id');
        $this->db->like('distancia', $descripcion);
        $query = $this->db->get('tbdistancia');
        return $query->result_array();
    }

    public function get_distancia($id) {
        $this->db->select('distancia ,estatus,iddistancia');
        $this->db->where('iddistancia', $id);
        $query = $this->db->get('tbdistancia');
        return $query->result_array();
    }

    public function generar_json_tabla_distancia($offset, $cantidad, $order, $type) {
        $arr = $this->getInputFromAngular();


        $this->db->select('COUNT(1) AS cantidad');
        if ($arr['estatus'])
            $this->db->where('estatus', $arr['estatus']);
        if (!empty($arr['query']))
            $this->db->like('distancia', $arr['query']);



        $query1 = $this->db->get('tbdistancia');
        $respuesta['cantidad'] = $query1->result_array();




        $this->db->select('distancia AS Distancia,fecha_registro as Registrado ,estatus AS Estatus,iddistancia AS Opciones');
        if ($arr['estatus'])
            $this->db->where('estatus', $arr['estatus']);
        if (isset($arr['query']))
            $this->db->like('distancia', $arr['query']);

        $this->db->limit($cantidad, $offset);
        $this->db->order_by($order, $type);
        $query = $this->db->get('tbdistancia');
        $respuesta['resultado'] = $query->result_array();

        $respuesta['meta'] = $query->list_fields();

        return $respuesta;
    }

    public function get_tipo_pista_sel($activos = false) {
        $this->db->select('idtipopista  AS id,descripcion AS val');

        if ($activos)
            $this->db->where('estatus', $activos);

        $query = $this->db->get('tbtipopista');
        return $query->result_array();
    }

    /**
     * INICIO  DE LA SECCION DE PISTA
     * 
     */
    public function edit_pista() {
        $res = array();
        $arr = $this->getInputFromAngular();

        $this->db->where('idpista!=', $arr['idpista']);
        $this->db->where('descripcion', $arr['descripcion']);
        $query1 = $this->db->get('tbpista');
        if ($query1->num_rows() > 0) {
            $res['status'] = 0;
            $res['mensaje'] = 'La Pista ya se Encuentra Registrada';
            return $res;
        }
        $this->db->flush_cache();
        
        $id = $arr['idpista'];
        $distancia = $arr['distancias'];
        unset($arr['distancias']);

        $this->db->where('idpista', $arr['idpista']);
        unset($arr['idpista']);
        $arr['idtipopista'] = $arr['tipo'];
        unset($arr['tipo']);
        $arr['idhipodromo'] = $arr['hipodromo'];
        unset($arr['hipodromo']);

        if ($this->db->update('tbpista', $arr)) {
            $this->asociar_pistas($id, $distancia);
            $res['status'] = 1;
            $res['mensaje'] = 'Actualizado con Exito';
        } else {
            $res['status'] = 0;
            $res['mensaje'] = 'Ocurrio un Problema al Actualizar';
        }

        return $res;
    }

    public function insert_pista() {

        $arr = $this->getInputFromAngular();
        $res = array();
        $this->db->select('descripcion');
        $this->db->where('descripcion', $arr['descripcion']);


        $arr['idtipopista'] = $arr['tipo'];
        unset($arr['tipo']);
        $arr['idhipodromo'] = $arr['hipodromo'];
        unset($arr['hipodromo']);
        $query1 = $this->db->get('tbpista');
        if ($query1->num_rows() > 0) {
            $res['status'] = 0;
            $res['mensaje'] = 'La pista ya se encuentra registrado';
            return $res;
        }


        if ($this->db->insert('tbpista', $arr)) {
            $res['status'] = 1;
            $res['mensaje'] = 'Se inserto con exito';
        } else {
            $res['status'] = 0;
            $res['mensaje'] = 'Ups! , Ha ocurrido un error';
        }





        return $res;
    }

    public function get_pista($id) {
        $this->db->select('descripcion ,estatus,idpista,idtipopista AS tipo, idhipodromo AS hipodromo');
        $this->db->where('idpista', $id);
        $query = $this->db->get('tbpista');
        return $query->result_array();
    }

    public function generar_json_tabla_pista($offset, $cantidad, $order, $type) {
        $arr = $this->getInputFromAngular();


        $this->db->select('COUNT(1) AS cantidad');
        if ($arr['estatus'])
            $this->db->where('tbpista.estatus', $arr['estatus']);
        if (!empty($arr['query']))
            $this->db->like('tbpista.descripcion', $arr['query']);



        $query1 = $this->db->get('tbpista');
        $respuesta['cantidad'] = $query1->result_array();


        $this->db->select('tbpista.descripcion AS Descripcion, tbtipopista.descripcion AS Tipo, tbhipodromo.abreviatura AS Hipodromo,tbpista.estatus AS Estatus, tbpista.idpista AS Opciones');
        if ($arr['estatus'])
            $this->db->where('tbpista.estatus', $arr['estatus']);
        if (isset($arr['query']))
            $this->db->like('tbpista.descripcion', $arr['query']);
        $this->db->from('tbpista');
        $this->db->join('tbtipopista', 'tbtipopista.idtipopista = tbpista.idtipopista');
        $this->db->join('tbhipodromo', 'tbhipodromo.idhipodromo = tbpista.idhipodromo');
        $this->db->limit($cantidad, $offset);
        $this->db->order_by($order, $type);
        $query = $this->db->get();
        $respuesta['resultado'] = $query->result_array();

        $respuesta['meta'] = $query->list_fields();

        return $respuesta;
    }

    /**
     * SEGMENTO ESTADO PISTA
     */
    public function get_estado_pista($id) {

        $this->db->select('abreviatura, descripcion, pond, fecha_registro, estatus, idestadopista');
        $this->db->where('idestadopista', $id);
        $query = $this->db->get('tbestadopista');
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
                $likes.="(tbestadopista.descripcion LIKE '%" . $params[$i] . "%' OR tbestadopista.abreviatura LIKE '%" . $params[$i] . "%'";
            else
                $likes.="OR tbestadopista.descripcion LIKE '%" . $params[$i] . "%' OR tbestadopista.abreviatura LIKE '%" . $params[$i] . "%'";
            if ($i + 1 == count($params))
                $likes.=")";
        }

        if (!empty($likes))
            $this->db->where($likes);


        $this->db->select('COUNT(1) AS cantidad');


        $query1 = $this->db->get('tbestadopista');
        $respuesta['cantidad'] = $query1->result_array();

        $this->db->select('tbestadopista.descripcion AS Descripcion,tbestadopista.abreviatura AS Abreviatura,tbestadopista.pond AS Ponderacion, tbestadopista.fecha_registro AS Registrado,tbestadopista.estatus AS Estatus,idestadopista AS Opciones');
        $this->db->from('tbestadopista');

        if ($arr['estatus'])
            $this->db->where('tbestadopista.estatus', $arr['estatus']);
        if (!empty($likes))
            $this->db->where($likes);


        $this->db->limit($cantidad, $offset);
        $this->db->order_by($order, $type);

        $query = $this->db->get();
        $respuesta['resultado'] = $query->result_array();
        $respuesta['meta'] = $query->list_fields();
        return $respuesta;
    }

    public function edit_estado_pista() {
        $res = array();
        $arr = $this->getInputFromAngular();
        $this->db->select('descripcion');
        $this->db->where('descripcion', $arr['descripcion']);
        $this->db->where('idestadopista!=', $arr['idestadopista']);
        $query1 = $this->db->get('tbestadopista');
        if ($query1->num_rows() > 0) {
            $res['status'] = 0;
            $res['mensaje'] = 'El Estadopista ya se encuentra registrado';
            return $res;
        }

        $this->db->select('abreviatura');
        $this->db->where('abreviatura', $arr['abreviatura']);
        $this->db->where('idestadopista!=', $arr['idestadopista']);

        $query1 = $this->db->get('tbestadopista');
        if ($query1->num_rows() > 0) {
            $res['status'] = 0;
            $res['mensaje'] = 'La abreviatura ya se encuentra registrada con otro Estadopista';
            return $res;
        }



        $this->db->where('idestadopista', $arr['idestadopista']);
        unset($arr['idestadopista']);
        unset($arr['fecha_registro']);
        if ($this->db->update('tbestadopista', $arr)) {
            $res['status'] = 1;
            $res['mensaje'] = 'Actualizado con Exito';
        } else {
            $res['status'] = 0;
            $res['mensaje'] = 'Ocurrio un Problema al Actualizar';
        }
        return $res;
    }

    public function insert_estado_pista() {
        $arr = $this->getInputFromAngular();
        $res = array();

        $this->db->select('descripcion');
        $this->db->where('descripcion', $arr['descripcion']);
        $query1 = $this->db->get('tbestadopista');
        if ($query1->num_rows() > 0) {
            $res['status'] = 0;
            $res['mensaje'] = 'El Estadopista ya se encuentra registrado';
            return $res;
        }

        $this->db->select('abreviatura');
        $this->db->where('abreviatura', $arr['abreviatura']);
        $query1 = $this->db->get('tbestadopista');
        if ($query1->num_rows() > 0) {
            $res['status'] = 0;
            $res['mensaje'] = 'La abreviatura ya se encuentra registrada con otro Estadopista';
            return $res;
        }

        if ($this->db->insert('tbestadopista', $arr)) {
            $res['status'] = 1;
            $res['mensaje'] = 'Registrado con Exito';
        } else {
            $res['status'] = 0;
            $res['mensaje'] = 'Error Desconocido';
        }

        return $res;
    }

    public function get_estado_pista_sel($activos = false) {
        $this->db->select('idestadopista  AS id,abreviatura AS val');
        if ($activos)
            $this->db->where('estatus', $activos);
        $query = $this->db->get('tbestadopista');
        return $query->result_array();
    }

    public function get_pista_hipodromo_sel($hipodromo, $activos = false) {
        $this->db->select('idpista  AS id,descripcion AS val');        
        if ($activos)
            $this->db->where('estatus', $activos);
        $this->db->where('idhipodromo', $hipodromo);
        $query = $this->db->get('tbpista');
        return $query->result_array();
    }
    
    
    public function get_distancia_pista_sel($pista, $activos = false) {
        $this->db->select('idpistadistancia  AS id,tbdistancia.distancia AS val');        
        $this->db->from('tbpistadistancia');
        $this->db->join('tbdistancia', 'tbpistadistancia.iddistancia = tbdistancia.iddistancia');
        if ($activos)
            $this->db->where('tbpistadistancia.estatus', $activos);
        $this->db->where('tbpistadistancia.idpista', $pista);
        $query = $this->db->get('');
        return $query->result_array();
    }

    
    
}
