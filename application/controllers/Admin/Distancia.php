<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Distancia extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Pista_model');
    }

    public function ver($id = null) {
        $result = $this->Pista_model->get_distancia($id);
        foreach ($result as $row) {
            echo json_encode($row);
            break;
        }
    }

    public function ver_busqueda($descripcion) {
        $result = $this->Pista_model->search_distancia($descripcion);
        $res = array();
        foreach ($result as $row) {
            $res[] = $row;
        }
        echo json_encode($res);
    }

    public function tabla_principal_distancia($count = 15, $page = 1, $order = 'distancia', $type = 'asc') {
        if ($type != 'asc') {
            $type = 'desc';
        }
        $ret = array();
        $inicio = $page * $count - $count;
        $array = $this->Pista_model->generar_json_tabla_distancia($inicio, $count, $order, $type);

        if ($type != 'asc') {
            $type = 'dsc';
        }
        $cantidad_total = $array['cantidad'][0]['cantidad'] + 0;
        $paginas_totales = ceil($cantidad_total / $count);

        $result = $array['resultado'];

        $meta = $array['meta'];
        foreach ($result as $row) {
            $ret['rows'][] = $row;
        }

        foreach ($meta as $row) {
            $ret['header'][] = array_map('utf8_encode', array('name' => $row, 'key' => $row));
        }

        $ret['pagination'] = array('count' => $count, 'page' => $page, 'pages' => $paginas_totales, 'size' => $cantidad_total);

        $ret['sort-by'] = $order;
        $ret['sort-order'] = $type;

        echo json_encode($ret);
    }

    public function crear_distancia() {
        echo json_encode($this->Pista_model->insert_distancia());
    }

    public function modificar_distancia() {
        echo json_encode($this->Pista_model->edit_distancia());
    }

    public function index() {
        $data['nombre'] = 'name';
        $data['title'] = 'Sistema Hipico';
        $this->load->view('templates/header', $data);
        $this->load->view('navbars/admin', $data);

        $this->load->view('Admin/Distancia', $data);
        $this->load->view('templates/footer', $data);
    }
    
    
    public function ver_sel_pista($pista,$activos=true){
        $res=array();
        $result = $this->Pista_model->get_distancia_pista_sel($pista,$activos);
        foreach ($result as $row) {
            $res[]= $row;            
        }
        echo json_encode($res);        
        
    }

}
