<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Participante_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function edit_tipo_implemento() {
        $res = array();
        $arr = $this->getInputFromAngular();
        
        $this->db->select('descripcion');
        $this->db->where('descripcion', $arr['descripcion']);
        $this->db->where('idtipoimplemento!=', $arr['idtipoimplemento']);
        $query1 = $this->db->get('tbtipoimplemento');
        if ($query1->num_rows() > 0) {
            $res['status'] = 0;
            $res['mensaje'] = 'El Tipo de implemento ya se Encuentra Registrado';
            return $res;
        }
        $this->db->flush_cache();
        
        
        
        $this->db->select('descripcion');
        $this->db->where('abreviatura', $arr['abreviatura']);
        $this->db->where('idtipoimplemento!=', $arr['idtipoimplemento']);
        $query1 = $this->db->get('tbtipoimplemento');
        if ($query1->num_rows() > 0) {
            $res['status'] = 0;
            $res['mensaje'] = 'La abreviatura ya se encuentra registrada';
            return $res;
        }
        $this->db->flush_cache();
        
        
        
        
        
        
        
        $this->db->where('idtipoimplemento', $arr['idtipoimplemento']);
        unset($arr['idtipoimplemento']);
        if ($this->db->update('tbtipoimplemento', $arr)) {
            $res['status'] = 1;
            $res['mensaje'] = 'Actualizado con Exito';
        } else {
            $res['status'] = 0;
            $res['mensaje'] = 'Ocurrio un Problema al Actualizar';
        }

        return $res;
    }

    public function insert_tipo_implemento() {

        $arr = $this->getInputFromAngular();
        $res = array();
        $this->db->select('descripcion');
        $this->db->where('abreviatura', $arr['abreviatura']);
        $query1 = $this->db->get('tbtipoimplemento');
        if ($query1->num_rows() > 0) {
            $res['status'] = 0;
            $res['mensaje'] = 'La abreviatura ya se encuentra registrada';
            return $res;
        }
        $this->db->flush_cache();



        if ($this->db->insert('tbtipoimplemento', $arr)) {
            $res['status'] = 1;
            $res['mensaje'] = 'Se inserto con exito';
        } else {
            $res['status'] = 0;
            $res['mensaje'] = 'Ups! , Ha ocurrido un error';
        }
        return $res;
    }

    public function get_tipo_implemento($id) {
        $this->db->select('abreviatura,descripcion ,estatus,idtipoimplemento');
        $this->db->where('idtipoimplemento', $id);
        $query = $this->db->get('tbtipoimplemento');
        return $query->result_array();
    }

    public function get_tipo_implemento_sel($activos = false) {
        $this->db->select('idtipoimplemento  AS id,abreviatura AS val');

        if ($activos)
            $this->db->where('estatus', $activos);

        $query = $this->db->get('tbtipoimplemento');
        return $query->result_array();
    }

    public function generar_json_tabla_tipo_implemento($offset, $cantidad, $order, $type) {
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


        $query1 = $this->db->get('tbtipoimplemento');
        $respuesta['cantidad'] = $query1->result_array();

        $this->db->select('descripcion AS Descripcion,abreviatura AS Abreviatura,fecha_registro AS Registrado,estatus AS Estatus,idtipoimplemento AS Opciones');
        if ($arr['estatus'])
            $this->db->where('estatus', $arr['estatus']);
        if (!empty($likes))
            $this->db->where($likes);


        $this->db->limit($cantidad, $offset);
        $this->db->order_by($order, $type);

        $query = $this->db->get('tbtipoimplemento');
        $respuesta['resultado'] = $query->result_array();
        $respuesta['meta'] = $query->list_fields();
        return $respuesta;
    }
    
    
    
    /**
     * Segmento  de Implemento
     */
    
    
    public function get_implementos_por_defecto($id){
        $ultima_part=  $this->get_ultima_participacion($id);
        
        if($ultima_part<0){            
            return $this->get_defecto();
        }
        $this->db->select('tbimplemento.descripcion AS implemento ,tbimplemento.idimplemento AS id');
        $this->db->from('tbimplemento');
        $this->db->join('tbpartimplementollamado', 'tbpartimplementollamado.idimplemento=tbimplemento.idimplemento');        
        $this->db->where('tbpartimplementollamado.idparticipantellamado', $ultima_part);
        $this->db->where('tbimplemento.defecto', 1);
        $this->db->where('tbimplemento.estatus', 1);
        $query = $this->db->get();
        
        return $query->result_array();
        
    }
    
    
    public function get_defecto(){
        $this->db->select('descripcion AS implemento ,idimplemento AS id');
        $this->db->where('defecto', 1);
        $this->db->where('estatus', 1);
        $query = $this->db->get('tbimplemento');
        return $query->result_array();        
    }
    
    
    public function get_ultima_participacion($id){
        $consulta="SELECT tbparticipante_llamado.idparticipacion as part FROM tbejemplar INNER JOIN tbparticipante_llamado "            
        ."INNER JOIN tbcarrera ON (tbparticipante_llamado.idcarrera=tbcarrera.idcarrera) "
        . "WHERE tbejemplar.idejemplar='".$id."' "
        ."ORDER BY tbcarrera.fecha_carrera DESC LIMIT 1";
        
        $query = $this->db->query($consulta);
                 
        
        if ($query->num_rows() > 0) {                
            return $query->result_array()[0]['part'];
        }
        
        return -1;
    }
    
    
    public function get_implemento($id) {
        $this->db->select('tbimplemento.descripcion,tbimplemento.abreviatura,tbimplemento.fecha_registro,tbimplemento.estatus ,idtipoimplemento AS tipo, idimplemento AS id, defecto');
        $this->db->from('tbimplemento'); 
        
            $this->db->where('idimplemento', $id);
        $query = $this->db->get();
        return $query->result_array();
    }
    
    
    
    public function search_implemento($descripcion = '') {
        $this->db->select('descripcion AS implemento ,idimplemento AS id');
        $this->db->like('descripcion', $descripcion);
        $query = $this->db->get('tbimplemento');
        return $query->result_array();
    }

    public function generar_json_tabla_implemento($offset, $cantidad, $order, $type) {
        $arr = $this->getInputFromAngular();
        $params = preg_split('#\s+#', trim($arr['query']));
        $w = false;
        if ($arr['estatus'])
            $this->db->where('tbimplemento.estatus', $arr['estatus']);
        $likes = '';


        for ($i = 0; $i != count($params); $i++) {
            if ($i == 0)
                $likes.="(tbimplemento.descripcion LIKE '%" . $params[$i] . "%' OR tbimplemento.abreviatura LIKE '%" . $params[$i] . "%'";
            else
                $likes.="OR tbimplemento.descripcion LIKE '%" . $params[$i] . "%' OR tbimplemento.abreviatura LIKE '%" . $params[$i] . "%'";
            if ($i + 1 == count($params))
                $likes.=")";
        }

        if (!empty($likes))
            $this->db->where($likes);


        $this->db->select('COUNT(1) AS cantidad');
        $query1 = $this->db->get('tbimplemento');
        $respuesta['cantidad'] = $query1->result_array();




        $this->db->select('tbimplemento.descripcion AS Descripcion,tbimplemento.abreviatura AS Abreviatura,tbtipoimplemento.abreviatura AS Tipo,tbimplemento.fecha_registro AS Registrado,tbimplemento.estatus AS Estatus,idimplemento AS Opciones');
        $this->db->from('tbimplemento');
        $this->db->join('tbtipoimplemento', 'tbtipoimplemento.idtipoimplemento = tbimplemento.idtipoimplemento');

        if ($arr['estatus'])
            $this->db->where('tbimplemento.estatus', $arr['estatus']);
        if (!empty($likes))
            $this->db->where($likes);

        $this->db->limit($cantidad, $offset);
        $this->db->order_by($order, $type);
        $query = $this->db->get();
        $respuesta['resultado'] = $query->result_array();

        $respuesta['meta'] = $query->list_fields();

        return $respuesta;
    }

    public function edit_implemento() {

        $arr = $this->getInputFromAngular();
        $res = array();
        $arr['idtipoimplemento'] = $arr['tipo'];        
        unset($arr['registrado']);      
        unset($arr['tipo']);
        

        $this->db->select('descripcion');
        $this->db->where('descripcion', $arr['descripcion']);
        $this->db->where('idimplemento!=', $arr['id']);
        $query1 = $this->db->get('tbimplemento');
        if ($query1->num_rows() > 0) {
            $res['status'] = 0;
            $res['mensaje'] = 'El Implemento ya se encuentra registrado';
            return $res;
        }
        $this->db->flush_cache();


        $this->db->select('abreviatura');
        $this->db->where('abreviatura', $arr['abreviatura']);
        $this->db->where('idimplemento!=', $arr['id']);
        $query1 = $this->db->get('tbimplemento');
        if ($query1->num_rows() > 0) {
            $res['status'] = 0;
            $res['mensaje'] = 'La abreviatura ya se encuentra Registrada';
            return $res;
        }
        $this->db->flush_cache();


        $this->db->where('idimplemento', $arr['id']);
        unset($arr['id']);


        if ($this->db->update('tbimplemento', $arr)) {
            $res['status'] = 1;
            $res['mensaje'] = 'Actualizado con Exito';
        } else {
            $res['status'] = 0;
            $res['mensaje'] = 'Ocurrio un Problema al Actualizar';
        }

        return $res;
    }

    public function insert_implemento() {
        $arr = $this->getInputFromAngular();
        $res = array();
        $arr['idtipoimplemento'] = $arr['tipo'];                
        unset($arr['tipo']);

        $this->db->select('descripcion');
        $this->db->where('descripcion', $arr['descripcion']);
        $query1 = $this->db->get('tbimplemento');
        if ($query1->num_rows() > 0) {
            $res['status'] = 0;
            $res['mensaje'] = 'El Implemento ya se encuentra registrado';
            return $res;
        }
        $this->db->flush_cache();


        $this->db->select('abreviatura');
        $this->db->where('abreviatura', $arr['abreviatura']);
        $query1 = $this->db->get('tbimplemento');
        if ($query1->num_rows() > 0) {
            $res['status'] = 0;
            $res['mensaje'] = 'La abreviatura ya se encuentra Registrada';
            return $res;
        }

        $this->db->flush_cache();

        if ($this->db->insert('tbimplemento', $arr)) {
            $res['status'] = 1;
            $res['mensaje'] = 'Se inserto con exito';
        } else {
            $res['status'] = 0;
            $res['mensaje'] = 'Ups! , Ha ocurrido un error';
        }

        return $res;
    }

}
