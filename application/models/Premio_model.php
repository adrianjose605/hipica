<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Premio_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function get_premio($all = false) {
        $this->db->select('idpremios AS id, idhipodromo AS hipodromo,  porcentaje_1,porcentaje_2,porcentaje_3,porcentaje_4,porcentaje_5,estatus, descripcion');
            $this->db->where('idpremios', $all);
        $query = $this->db->get('tbpremios');
        return $query->result_array();
    }
    
    
    public function get_distribucion_premios($idpremio){
        $this->db->select('porcentaje_1,porcentaje_2,porcentaje_3,porcentaje_4,porcentaje_5');
            $this->db->where('idpremios', $idpremio);
        $query = $this->db->get('tbpremios');
        return $query->result_array();
    }

    public function get_premio_sel($activos = false) {
        $this->db->select('idpremios  AS id,descripcion AS val');

        if ($activos)
            $this->db->where('estatus', $activos);

        $query = $this->db->get('tbpremios');
        return $query->result_array();
    }

    public function generar_json_tabla_premio($offset, $cantidad, $order, $type) {
        $arr = $this->getInputFromAngular();
        $params = $arr['query'];
        
        
        if (!empty($params))
            $this->db->where('tbpremios.descripcion',$params);


        $this->db->select('COUNT(1) AS cantidad');
        $query1 = $this->db->get('tbpremios');
        $respuesta['cantidad'] = $query1->result_array();




        $this->db->select("tbpremios.descripcion AS Descripcion,tbhipodromo.abreviatura AS Hipodromo,  CONCAT(tbpremios.porcentaje_1,'%') AS Primero, CONCAT(tbpremios.porcentaje_2,'%') AS Segundo, CONCAT(tbpremios.porcentaje_3,'%') AS Tercero, CONCAT(tbpremios.porcentaje_4,'%') AS Cuarto, CONCAT(tbpremios.porcentaje_5,'%') AS Quinto, tbpremios.estatus AS Estatus, tbpremios.idpremios AS Opciones");
        $this->db->from('tbpremios');
        $this->db->join('tbhipodromo', 'tbpremios.idhipodromo=tbhipodromo.idhipodromo');
        if ($arr['estatus'])
            $this->db->where('tbpremios.estatus', $arr['estatus']);
        if (!empty($params))
            $this->db->where('tbpremios.descripcion',$params);

        $this->db->limit($cantidad, $offset);
        $this->db->order_by($order, $type);
        $query = $this->db->get();
        $respuesta['resultado'] = $query->result_array();

        $respuesta['meta'] = $query->list_fields();

        return $respuesta;
    }

    public function edit_premio() {
       $arr = $this->getInputFromAngular();
        $res = array();
        $total=0;
        
        $arr['idhipodromo']=$arr['hipodromo'];
        unset($arr['hipodromo']);  
        
        
        if(isset($arr['porcentaje_1']))
            $total+=$arr['porcentaje_1'];
        if(isset($arr['porcentaje_2']))
            $total+=$arr['porcentaje_2'];
        if(isset($arr['porcentaje_3']))
            $total+=$arr['porcentaje_3'];
        if(isset($arr['porcentaje_4']))
            $total+=$arr['porcentaje_4'];
        if(isset($arr['porcentaje_5']))
            $total+=$arr['porcentaje_5'];
        
        if($total!=100){
            $res['status'] = 0;
            $res['mensaje'] = 'el monto total  de los premios debe ser 100%';
            return $res;
        }
        
        
        $this->db->select('descripcion');
        $this->db->where('descripcion', $arr['descripcion']);        
        $this->db->where('idpremios!=', $arr['id']);        
        $this->db->where('idhipodromo', $arr['idhipodromo']);        

        $query1 = $this->db->get('tbpremios');
        if ($query1->num_rows() > 0) {
            $res['status'] = 0;
            $res['mensaje'] = 'El Premio ya se encuentra registrado con otro Hipodromo';
            return $res;
        }        
        $this->db->flush_cache();
        
        $this->db->where('idpremios', $arr['id']);        
        unset($arr['id']);
        if ($this->db->update('tbpremios', $arr)) {
            $res['status'] = 1;
            $res['mensaje'] = 'Actualizado con Exito';
        } else {
            $res['status'] = 0;
            $res['mensaje'] = 'Ocurrio un Problema al Actualizar';
        }

        return $res;
    }

    public function insert_premio() {
        $arr = $this->getInputFromAngular();
        $res = array();
        $total=0;
        
        $arr['idhipodromo']=$arr['hipodromo'];
        unset($arr['hipodromo']);
        
        if(isset($arr['porcentaje_1']))
            $total+=$arr['porcentaje_1'];
        if(isset($arr['porcentaje_2']))
            $total+=$arr['porcentaje_2'];
        if(isset($arr['porcentaje_3']))
            $total+=$arr['porcentaje_3'];
        if(isset($arr['porcentaje_4']))
            $total+=$arr['porcentaje_4'];
        if(isset($arr['porcentaje_5']))
            $total+=$arr['porcentaje_5'];
        
        if($total!=100){
            $res['status'] = 0;
            $res['mensaje'] = 'el monto total  de los premios debe ser 100%';
            return $res;
        }
        
        
        $this->db->select('descripcion');
        $this->db->where('descripcion', $arr['descripcion']);
        $this->db->where('idhipodromo', $arr['idhipodromo']);
        
        $query1 = $this->db->get('tbpremios');
        if ($query1->num_rows() > 0) {
            $res['status'] = 0;
            $res['mensaje'] = 'El Premio ya se encuentra registrado con Otro Hipodromo';
            return $res;
        }        
        $this->db->flush_cache();


        if ($this->db->insert('tbpremios', $arr)) {
            $res['status'] = 1;
            $res['mensaje'] = 'Se inserto con exito';
        } else {
            $res['status'] = 0;
            $res['mensaje'] = 'Ups! , Ha ocurrido un error';
        }

        return $res;
    }

}
