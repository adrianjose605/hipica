<?php

class Jugada_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function insert_tipo_jugada() {
        $arr = $this->getInputFromAngular();
        $res = array();

        $this->db->select('descripcion');
        $this->db->where('descripcion', $arr['descripcion']);
        $query1 = $this->db->get('tbtipojugada');
        if ($query1->num_rows() > 0) {
            $res['status'] = 0;
            $res['mensaje'] = 'El Tipo  de Jugada ya se encuentra registrada';
            return $res;
        }

        if ($this->db->insert('tbtipojugada', $arr)) {
            $res['status'] = 1;
            $res['mensaje'] = 'Se inserto con exito';
        } else {
            $res['status'] = 0;
            $res['mensaje'] = 'Ups! , Ha ocurrido un error';
        }

        return $res;
    }
    
    public function get_jugadas_checkbox($hipodromo){
        $this->db->select('abreviatura, tbjugada.idjugada AS id, tbjugada.estatus AS estatus');
        $this->db->from('tbjugada');
        $this->db->join('tbjugadahipodromo','tbjugada.idjugada=tbjugadahipodromo.idjugada');
        $this->db->where('tbjugada.estatus', 1);
        $this->db->where('tbjugadahipodromo.estatus', 1);
        $this->db->where('tbjugadahipodromo.idhipodromo', $hipodromo);        
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_tipo_jugada_sel($activos = false) {
        $this->db->select('idtipojugada  AS id,descripcion AS val');
        if ($activos)
            $this->db->where('estatus', $activos);
        $query = $this->db->get('tbtipojugada');
        return $query->result_array();
    }

    public function get_tipo_jugada($all = false) {
        $this->db->select('descripcion AS descripcion,estatus AS estatus,idtipojugada AS id');
        $this->db->from('tbtipojugada');


        $this->db->where('idtipojugada', $all);
        $query = $this->db->get('');
        return $query->result_array();
    }

    public function generar_json_tabla_tipo_jugada($offset, $cantidad, $order, $type) {
        $arr = $this->getInputFromAngular();
        $params = preg_split('#\s+#', trim($arr['query']));
        $w = false;
        if ($arr['estatus'])
            $this->db->where('estatus', $arr['estatus']);
        if ($arr['query'])
            $this->db->where("descripcion LIKE '%" . $arr['query'] . "%'");


        $this->db->select('COUNT(1) AS cantidad');
        $query1 = $this->db->get('tbtipojugada');
        $respuesta['cantidad'] = $query1->result_array();


        $this->db->select('descripcion AS Descripcion,estatus AS Estatus,idtipojugada AS Opciones');
        $this->db->from('tbtipojugada');

        if ($arr['query'])
            $this->db->where("descripcion LIKE '%" . $arr['query'] . "%'");

        $this->db->limit($cantidad, $offset);
        $this->db->order_by($order, $type);
        $query = $this->db->get();
        $respuesta['resultado'] = $query->result_array();

        $respuesta['meta'] = $query->list_fields();

        return $respuesta;
    }

    public function edit_tipo_jugada() {

        $arr = $this->getInputFromAngular();
        $res = array();


        $this->db->select('descripcion');
        $this->db->where('idtipojugada!=', $arr['id']);
        $this->db->where('descripcion', $arr['descripcion']);

        $query1 = $this->db->get('tbtipojugada');
        if ($query1->num_rows() > 0) {
            $res['status'] = 0;
            $res['mensaje'] = 'El Tipo  de jugada ya se encuentra registrado';
            return $res;
        }

        $this->db->flush_cache();
        $this->db->where('idtipojugada', $arr['id']);
        unset($arr['id']);

        if ($this->db->update('tbtipojugada', $arr)) {
            $res['status'] = 1;
            $res['mensaje'] = 'Actualizado con Exito';
        } else {
            $res['status'] = 0;
            $res['mensaje'] = 'Ocurrio un Problema al Actualizar';
        }

        return $res;
    }

    /**
     * Segmento  de Jugadas
     */
    public function get_jugada($all = false) {
        $this->db->select('descripcion,abreviatura, detalle,por_defecto, multijugada ,cantcarr,idtipojugada AS tipo, estatus,idjugada AS id, idjugadabase AS compuesta');
        $this->db->from('tbjugada');
     
            $this->db->where('idjugada', $all);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_jugadas_sel($activos) {
        $this->db->select('idjugada  AS id,descripcion AS val');

        if ($activos)
            $this->db->where('estatus', $activos);

        $query = $this->db->get('tbjugada');
        return $query->result_array();
    }
     public function get_hipodromos_asociados($idjugada) {
        $this->db->select('tbhipodromo.abreviatura ,tbhipodromo.idhipodromo AS id');
        $this->db->where('tbhipodromo.estatus', true);
        $this->db->where('tbjugadahipodromo.estatus', true);
        $this->db->where('tbjugadahipodromo.idjugada', $idjugada);
        $this->db->from('tbhipodromo');
        $this->db->join('tbjugadahipodromo', 'tbjugadahipodromo.idhipodromo = tbhipodromo.idhipodromo');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function generar_json_tabla_jugada($offset, $cantidad, $order, $type) {
        $arr = $this->getInputFromAngular();
        $params = preg_split('#\s+#', trim($arr['query']));
        $w = false;
        if ($arr['estatus'])
            $this->db->where('tbjugada.estatus', $arr['estatus']);
        $likes = '';


        for ($i = 0; $i != count($params); $i++) {
            if ($i == 0)
                $likes.="(tbjugada.descripcion LIKE '%" . $params[$i] . "%' OR tbjugada.detalle LIKE '%" . $params[$i] . "%'";
            else
                $likes.="OR tbjugada.detalle LIKE '%" . $params[$i] . "%' OR tbjugada.detalle LIKE '%" . $params[$i] . "%'";
            if ($i + 1 == count($params))
                $likes.=")";
        }

        if (!empty($likes))
            $this->db->where($likes);


        $this->db->select('COUNT(1) AS cantidad');
        $query1 = $this->db->get('tbjugada');
        $respuesta['cantidad'] = $query1->result_array();




        $this->db->select('tbjugada.descripcion AS Descripcion, tbjugada.abreviatura AS Abreviatura,tbjugada.detalle AS Detalle,tbjugada.idjugadabase AS Compuesta,por_defecto AS Default, tbjugada.multijugada AS Multiple,cantcarr AS Carreras,tbtipojugada.descripcion AS Tipo, tbjugada.estatus AS Estatus,idjugada AS Opciones');
        $this->db->from('tbjugada');
        $this->db->join('tbtipojugada', 'tbtipojugada.idtipojugada = tbjugada.idtipojugada');
       

        if ($arr['estatus'])
            $this->db->where('tbjugada.estatus', $arr['estatus']);
        if (!empty($likes))
            $this->db->where($likes);

        $this->db->limit($cantidad, $offset);
        $this->db->order_by($order, $type);
        $query = $this->db->get();
        $respuesta['resultado'] = $query->result_array();

        $respuesta['meta'] = $query->list_fields();

        return $respuesta;
    }

    public function edit_jugada() {

        $arr = $this->getInputFromAngular();
        $res = array();
        $arr['idtipojugada'] = $arr['tipo'];
       $hipodromos= $arr['hipodromos'];
       $id= $arr['id'];
        
         if(isset($arr['base'])){
            if(empty($arr['base'])){
                $arr['idjugadabase']=null;
            }else{
                $arr['idjugadabase']=$arr['base'];
            }
            unset($arr['base']);
        }
        
        unset($arr['compuesta']);
        unset($arr['tipo']);
        unset($arr['hipodromos']);
        unset($arr['hipodromo']);
        


        $this->db->select('descripcion');
        $this->db->where('descripcion', $arr['descripcion']);
        $this->db->where('idjugada!=', $arr['id']);
        $query1 = $this->db->get('tbjugada');
        if ($query1->num_rows() > 0) {
            $res['status'] = 0;
            $res['mensaje'] = 'La Jugada ya se encuentra registrada';
            return $res;
        }

        $this->db->flush_cache();


        $this->db->where('idjugada', $arr['id']);
        unset($arr['id']);


        if ($this->db->update('tbjugada', $arr)) {
             $this->asociar_hipodromos($id, $hipodromos);
            $res['status'] = 1;
            $res['mensaje'] = 'Actualizado con Exito';
        } else {
            $res['status'] = 0;
            $res['mensaje'] = 'Ocurrio un Problema al Actualizar';
        }

        return $res;
    }
    
    
    
    public function insert_jugada() {
        $arr = $this->getInputFromAngular();
        $res = array();
        $arr['idtipojugada'] = $arr['tipo'];
        $hipodromos = $arr['hipodromos'];
        
        if(isset($arr['base'])){
            if(empty($arr['base'])){
                $arr['idjugadabase']=null;
            }else{
                $arr['idjugadabase']=$arr['base'];
            }
            unset($arr['base']);
        }

      
     
        unset($arr['tipo']);
        unset($arr['hipodromos']);
        unset($arr['hipodromo']);

        $this->db->select('descripcion');
        $this->db->where('descripcion', $arr['descripcion']);
        $query1 = $this->db->get('tbjugada');
        if ($query1->num_rows() > 0) {
            $res['status'] = 0;
            $res['mensaje'] = 'El Tipo  de Jugada ya se encuentra registrado';
            return $res;
        }

        $this->db->flush_cache();


          
        if ($this->db->insert('tbjugada', $arr)) {
            
             $this->asociar_hipodromos($this->db->insert_id(), $hipodromos);
            $res['status'] = 1;
            $res['mensaje'] = 'Se inserto con exito';
        } else {
            $res['status'] = 0;
            $res['mensaje'] = 'Ups! , Ha ocurrido un error';
        }

        return $res;
    }

   




    public function asociar_hipodromos($id, $jugada) {
        $this->db->where('idjugada', $id);
        $this->db->set('estatus', false);
        $this->db->update('tbjugadahipodromo');

        foreach ($jugada AS $jug) {
            $this->db->flush_cache();
            $this->db->where('idjugada', $id);
            $this->db->where('idhipodromo', $jug['id']);
            $q = $this->db->get('tbjugadahipodromo');
            if ($q->num_rows() > 0) {
                $this->db->where('idjugada', $id);
                $this->db->where('idhipodromo', $jug['id']);
                $this->db->set('estatus', true);
                $this->db->update('tbjugadahipodromo');
            } else {
                $this->db->set('idjugada', $id);
                $this->db->set('idhipodromo', $jug['id']);
                $this->db->insert('tbjugadahipodromo');
            }
        }
    }
    
    
    public function search_jugada($condicion = '') {
        $this->db->select('tbjugada.descripcion AS descripcion ,tbjugada.idjugada AS id');
        $this->db->select('tbtipojugada.descripcion AS tipo');
        $this->db->like('tbjugada.descripcion', $condicion);
        $this->db->from('tbjugada');
        $this->db->join('tbtipojugada','tbtipojugada.idtipojugada=tbjugada.idtipojugada');
        $query = $this->db->get();
        return $query->result_array();
    }

    
    
}
