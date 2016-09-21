<?php

class Carrera_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }
    
    
    public function cambiar_estado_carrera($id){
        $this->db->flush_cache();
        $this->db->set('integridad', 'NOT integridad',FALSE);        
        $this->db->where('idcarrera', $id);        
        $res=array();
        if($this->db->update('tbcarrera')){
            $res['status'] = 1;
            $res['mensaje'] = 'El estado fue cambiado';
            
        }else{
            $res['status'] = 0;
            $res['mensaje'] = 'Ocurrio un Error';            
        }
        return $res;

    }
    
    
    
    
    public function generar_json_tabla_principal($offset, $cantidad, $order, $type) {
        $arr = $this->getInputFromAngular();       
        
        $this->db->select('COUNT(1) AS cantidad');
        $this->db->from('tbcarrera');
        $this->db->join('tbpistadistancia','tbcarrera.idpistadistancia=tbpistadistancia.idpistadistancia');
        $this->db->join('tbpista','tbpista.idpista=tbpistadistancia.idpista');
        $this->db->join('tbhipodromo','tbhipodromo.idhipodromo=tbpista.idhipodromo');
        if(isset($arr['hipodromo']))                
            $this->db->where("tbpista.idhipodromo",$arr['hipodromo']);            
        
            
        if(isset($arr['pais']))
            $this->db->where("tbhipodromo.idpais",$arr['pais']);
            
        if(isset($arr['fecha_carrera']))
            $this->db->where("DATE(tbcarrera.fecha_carrera)",date("Y-m-d", strtotime($arr['fecha_carrera'])));            
        
        if(isset($arr['revisado']))
            $this->db->where("tbcarrera.integridad",$arr['revisado']);            
        
        $query1 = $this->db->get();        
        $respuesta['cantidad'] = $query1->result_array();

        
        
        $s_val="";
        
        $this->db->select('CONCAT(tbhipodromo.abreviatura,"-",(tbcarrera.numero)) AS `Hipodromo-Anual`, tbpista.descripcion AS Pista,tbdistancia.distancia AS Distancia,DATE_FORMAT(tbcarrera.fecha_carrera,"%m-%d-%Y %h:%i %p") AS `Fecha-Hora`, cantidad_participantes AS Participantes, tbcarrera.idcarrera AS Opciones,integridad AS Revisado');
        $this->db->from('tbcarrera');
        $this->db->join('tbpistadistancia','tbcarrera.idpistadistancia=tbpistadistancia.idpistadistancia');
        $this->db->join('tbpista','tbpista.idpista=tbpistadistancia.idpista');
        $this->db->join('tbhipodromo','tbhipodromo.idhipodromo=tbpista.idhipodromo');
        $this->db->join('tbpais','tbhipodromo.idpais=tbpais.idpais');
        $this->db->join('tbdistancia','tbpistadistancia.iddistancia=tbdistancia.iddistancia');
        
        
        if(isset($arr['hipodromo']))                
            $this->db->where("tbpista.idhipodromo",$arr['hipodromo']);            
            
        if(isset($arr['pais']))
            $this->db->where("tbhipodromo.idpais",$arr['pais']);
            
        if(isset($arr['fecha_carrera']))
            $this->db->where("DATE(tbcarrera.fecha_carrera)",date("Y-m-d", strtotime($arr['fecha_carrera'])));            
        
        if(isset($arr['revisado']))
            $this->db->where("tbcarrera.integridad",$arr['revisado']);            

            
        $this->db->limit($cantidad, $offset);
        $this->db->order_by($order, $type);

        $query = $this->db->get();
        
        
        
        $respuesta['resultado'] = $query->result_array();
        $respuesta['meta'] = $query->list_fields();
        return $respuesta;
    }

    public function get_jugadas_asociadas($hipodromo, $carrera) {
        $query = $this->db->query("SELECT tbjugada.abreviatura, tbjugada.idjugada AS id,IF(tbjugada.idjugada IN (SELECT idjugada FROM tbjugadacarrera WHERE idcarrera='" . $carrera . "'),1,0) as estatus ,0 as mierda FROM tbjugada,tbjugadahipodromo  WHERE tbjugada.idjugada=tbjugadahipodromo.idjugada AND idhipodromo='" . $hipodromo . "'");
        return $query->result_array();
    }

    public function get_implementos_asociados($id) {

        $this->db->select('descripcion AS implemento ,tbimplemento.idimplemento AS id');
        $this->db->from('tbimplemento');
        $this->db->join('tbpartimplementollamado','tbimplemento.idimplemento=tbpartimplementollamado.idimplemento');
        $this->db->where('tbpartimplementollamado.idparticipantellamado',$id);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_participantes($id) {
        $consulta = "SELECT pesojinete,idparticipacion ,llave, tbejemplar.nombre AS  nejemplar, tbejemplar.idejemplar as ejemplar ,tbjinete.idjinete AS jinete,tbentrenador.identrenador AS entrenador,puesto_pista AS posicion,numero, "
                . "CONCAT(n1.primer_nombre,' ',n1.segundo_nombre,' ',n1.primer_apellido,' ',n1.segundo_nombre) AS njinete,"
                . "CONCAT(n2.primer_nombre,' ',n2.segundo_nombre,' ',n2.primer_apellido,' ',n2.segundo_nombre) AS nentrenador"
                . " fROM tbparticipante_llamado INNER JOIN tbejemplar ON(tbejemplar.idejemplar=tbparticipante_llamado.idejemplar)"
                . " INNER JOIN tbentrenador On (tbentrenador.identrenador=tbparticipante_llamado.identrenador)"
                . " INNER JOIN tbjinete On (tbjinete.idjinete=tbparticipante_llamado.idjinete)"
                . "INNER JOIN tbpersona AS n1 On (n1.idpersona = tbjinete.idpersona) "
                . "INNER JOIN tbpersona AS n2 On (n2.idpersona = tbentrenador.idpersona) "
                . " WHERE idcarrera='" . $id . "'";
        $query = $this->db->query($consulta);
        $tmp = $query->result_array();
        $res = array();
        $i = 0;
        foreach ($tmp as $c) {
            $res[$i]['ejemplar'] = array(array('id' => $c['ejemplar'], 'ejemplar' => $c['nejemplar']));
            $res[$i]['jinete'] = array(array('id' => $c['jinete'], 'jinete' => $c['njinete']));
            $res[$i]['implemento'] = $this->get_implementos_asociados($c['idparticipacion']);
            $res[$i]['llave'] = $c['llave'];
            $res[$i]['posicion'] = (int)$c['posicion'];
            $res[$i]['numero'] = $c['numero'];
            $res[$i]['pesoJinete'] = (int)$c['pesojinete'];
            $res[$i++]['entrenador'] = array(array('id' => $c['entrenador'], 'entrenador' => $c['nentrenador']));
        }
        return $res;
    }

    public function get_clasicos_asociados($id) {
        $this->db->select('descripcion AS clasico ,tbclasico.idclasico AS id');
        $this->db->from('tbclasico');
        $this->db->join('tbcarrera', 'tbcarrera.idclasico=tbclasico.idclasico');
        $this->db->where('idcarrera', $id);
        $query = $this->db->get();
        //echo $this->db->last_query();
        return $query->result_array();
    }

    public function get_condiciones_asociadas($id) {
        $this->db->select('cond_descrip AS condicion ,tbcondicion.idcondicion AS id');
        $this->db->select('tbtipocondicion.descripcion AS tipo');
        $this->db->where('tbcondicioncarrera.idcarrera', $id);
        $this->db->from('tbcondicion');
        $this->db->join('tbtipocondicion', 'tbtipocondicion.idtipocondicion=tbcondicion.idtipocondicion');
        $this->db->join('tbcondicioncarrera', 'tbcondicion.idcondicion=tbcondicioncarrera.idcondicion');

        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_carrera($id) {
        $select = "tbcarrera.idpistadistancia AS distancia, cantidad_participantes AS cantidad,"
                . "DATE(fecha_carrera) AS fecha_carrera,"
                . "numero,"
                . "TIME(fecha_carrera) AS hora_carrera,"
                . "nro_llamado AS llamado,idpremio AS premio, premioTotal AS premioTotal,reunion,"
                . "trofeo,tbpistadistancia.idpista AS pista, tbpista.idhipodromo AS hipodromo,tbhipodromo.idpais AS pais";
        $this->db->select($select);
        $this->db->from('tbcarrera');
        $this->db->join('tbpistadistancia', 'tbpistadistancia.idpistadistancia=tbcarrera.idpistadistancia');
        $this->db->join('tbpista', 'tbpista.idpista=tbpistadistancia.idpista');
        $this->db->join('tbhipodromo', 'tbpista.idhipodromo=tbhipodromo.idhipodromo', 'left');
        $this->db->where('idcarrera', $id);
        $query = $this->db->get();
        $tmp = $query->result_array();
        $res = Array();
        foreach ($tmp as $c) {
            $res['c'] = $c;
            break;
        }

        $res['c']['clasico'] = $this->get_clasicos_asociados($id);
        $res['c']['condicion'] = $this->get_condiciones_asociadas($id);
        $res['c']['jug'] = $this->get_jugadas_asociadas($res['c']['hipodromo'], $id);
        $res['c']['participantes'] = $this->get_participantes($id);

        ///json_encode($this->get_jugadas_asociadas($res['c']['hipodromo'], $id));

        echo json_encode($res);
    }

    public function get_nombre() {
        
    }

    public function edit_carrera() {
        $arr = $this->getInputFromAngular();
        $arr['idclasico'] = $arr["clasico"] && !empty($arr["clasico"]) ? $arr["clasico"][0]['id'] : NULL;
        $condicion = Array();
        $jugadas = Array();

        $res = array();


        $this->eliminar_vinculo($arr['id']);
        foreach ($arr['condicion'] as $cond) {
            $condicion[] = $cond['id'];
        }
        foreach ($arr['jugadas'] as $juga) {
            if ($juga['estatus'])
                $jugadas[] = $juga['id'];
        }
        $arr['nro_llamado'] = $arr['llamado'];
        $arr['premiototal'] = $arr['premioTotal'];
        $arr['idpistadistancia'] = $arr['distancia'];
        $arr['cantidad_participantes'] = $arr['cantidad'];
        
        $arr['fecha_carrera'] = date("Y-m-d", strtotime($arr['fecha_carrera']))." ".date("H:i", strtotime($arr['hora_carrera']));
        $arr['idpremio'] = $arr['premio'];


        unset($arr['premio']);
        unset($arr['pista']);
        unset($arr['pais']);
        
        unset($arr['cantidad']);
        unset($arr['distancia']);
        unset($arr['premioTotal']);
        unset($arr['llamado']);
        unset($arr['hora_carrera']);
        unset($arr['jugadas']);
        unset($arr['condicion']);
        unset($arr['clasico']);
        unset($arr['cestatus']);
        $participantes = $arr['participantes'];
        unset($arr['participantes']);

        //  $this->db->insert_id();
           
        
        if(!$this->validar_carrera($arr)){
            $res['status'] = 0;
            $res['mensaje'] = 'El Numero  anual ya ha sido registrado  en este año';
            return $res;
            
        } $this->db->where('idcarrera', $arr['id']);
        $idcar = $arr['id'];    
        unset($arr['hipodromo']);

        unset($arr['id']);
        if ($this->db->update('tbcarrera', $arr)) {

            $this->insert_tbcondicioncarrera($idcar, $condicion);
            $this->insert_tbjugadacarrera($idcar, $jugadas);
            $this->insert_participantes($idcar, $participantes);
            $res['status'] = 1;

            $res['mensaje'] = 'Se inserto con exito';
        } else {
            $res['status'] = 0;
            $res['mensaje'] = 'Ups! , Ha ocurrido un error';
        }
        //$this->insert_participantes(5, $arr['participantes']);
        // print_r($arr['participantes']);
        return $res;
    }

    public function insert_carrera() {

        $arr = $this->getInputFromAngular();
        $arr['idclasico'] = $arr["clasico"] && !empty($arr["clasico"]) ? $arr["clasico"][0]['id'] : NULL;
        $condicion = Array();
        $jugadas = Array();

        $res = array();


        foreach ($arr['condicion'] as $cond) {
            $condicion[] = $cond['id'];
        }
        foreach ($arr['jugadas'] as $juga) {
            if ($juga['estatus'])
                $jugadas[] = $juga['id'];
        }
        $arr['nro_llamado'] = $arr['llamado'];
        $arr['premiototal'] = $arr['premioTotal'];
        $arr['idpistadistancia'] = $arr['distancia'];
        $arr['cantidad_participantes'] = $arr['cantidad'];
        
        $arr['fecha_carrera'] = date("Y-m-d", strtotime($arr['fecha_carrera']))." ".date("H:i", strtotime($arr['hora_carrera']));
        $arr['idpremio'] = $arr['premio'];
        


        unset($arr['premio']);
        unset($arr['hora_carrera']);
        unset($arr['pista']);
        unset($arr['pais']);
        unset($arr['hipodromo']);
        
        unset($arr['cantidad']);
        unset($arr['distancia']);
        unset($arr['premioTotal']);
        unset($arr['llamado']);
        unset($arr['jugadas']);
        unset($arr['condicion']);
        unset($arr['clasico']);
        unset($arr['cestatus']);
        $participantes = $arr['participantes'];
        unset($arr['participantes']);

        //  $this->db->insert_id();
        if ($this->db->insert('tbcarrera', $arr)) {
            $idcar = $this->db->insert_id();
            $this->insert_tbcondicioncarrera($idcar, $condicion);
            $this->insert_tbjugadacarrera($idcar, $jugadas);
            $this->insert_participantes($idcar, $participantes);
            $res['status'] = 1;

            $res['mensaje'] = 'Se inserto con exito';
            $res['id'] = $idcar;
            
        } else {
            $res['status'] = 0;
            $res['mensaje'] = 'Ups! , Ha ocurrido un error';
        }
//        $this->insert_participantes(5, $arr['participantes']);
        // print_r($arr['participantes']);

        return $res;
    }
    
    public function validar_carrera($arr){
        $this->db->select("*");
        $this->db->from('tbcarrera');
        $this->db->join('tbpistadistancia','tbpistadistancia.idpistadistancia=tbcarrera.idpistadistancia');
        $this->db->join('tbpista','tbpista.idpista=tbpistadistancia.idpista');
        $this->db->where('tbpista.idhipodromo',$arr['hipodromo']);
        $this->db->where('YEAR(tbcarrera.fecha_carrera)',date("Y", strtotime($arr['fecha_carrera'])));
        $this->db->where('tbcarrera.numero',$arr['numero']);
        
        if(isset($arr['id']))
            $this->db->where('tbcarrera.idcarrera!='.$arr['id']);
        $res=array();
        $query1 = $this->db->get();
        
        
        if ($query1->num_rows() > 0) {
            return false;
        }       
        return true;
    }
    
    
    public function insert_tbcondicioncarrera($idcarrera, $condiciones) {

        foreach ($condiciones as $cond) {
            $cond_carrera = Array("idcarrera" => $idcarrera, "idcondicion" => $cond);
            $this->db->insert('tbcondicioncarrera', $cond_carrera);
        }
    }

    public function insert_tbjugadacarrera($idcarrera, $jugada_carrera) {

        foreach ($jugada_carrera as $jugcar) {
            $jugada_carrera = Array("idcarrera" => $idcarrera, "idjugada" => $jugcar);
            $this->db->insert('tbjugadacarrera', $jugada_carrera);
        }
    }

    public function insert_participantes($idcarrera, $participantes) {

        foreach ($participantes as $part) {
            $part['pesojinete'] = $part['pesoJinete'];
            $part['puesto_pista'] = $part['posicion'];
            $part['numero'] = $part['numero'];            
            
            $part['idcarrera'] = $idcarrera;
            $part['idstud'] = $this->get_stud($part['idejemplar']);
            $implemento = $part['implementos'];

            unset($part['pesoJinete']);
            unset($part['posicion']);
            unset($part['implementos']);
            unset($part['valellave']);

            $this->db->insert('tbparticipante_llamado', $part);
            $this->insert_implementos($this->db->insert_id(), $implemento);
        }
    }

    public function insert_implementos($idparticipante, $implementos) {

        foreach ($implementos as $imp) {
            $imple = Array("idparticipantellamado" => $idparticipante, "idimplemento" => $imp['id']);

            $this->db->insert('tbpartimplementollamado', $imple);
        }
    }

    public function get_stud($ejemplar) {

        $this->db->select('idstud');
        $this->db->from('tbejemplar');
        $this->db->where('idejemplar', $ejemplar);
        $query = $this->db->get();
        foreach ($query->result() as $row) {
            return $row->idstud;
        }
    }

    public function eliminar_vinculo($idcarrera) {

        $this->db->select('idparticipacion');
        $this->db->from('tbparticipante_llamado');
        $this->db->where('idcarrera', $idcarrera);
        $query = $this->db->get();

        foreach ($query->result() as $row) {

            $this->db->delete('tbpartimplementollamado', array('idparticipantellamado' => $row->idparticipacion));
        }

        $this->db->delete('tbparticipante_llamado', array('idcarrera' => $idcarrera));
        $this->db->delete('tbcondicioncarrera', array('idcarrera' => $idcarrera));
        $this->db->delete('tbjugadacarrera', array('idcarrera' => $idcarrera));
    }

}
