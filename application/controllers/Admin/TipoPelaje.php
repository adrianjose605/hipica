<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class TipoPelaje extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Ejemplar_model');
    }

    public function ver($id = null) {
        $result = $this->Ejemplar_model->get_tipo_pelaje($id);
        foreach ($result as $row) {
            echo json_encode($row);
            break;
        }
    }

    public function tabla_principal_tipo_pelaje($count = 5, $page = 1, $order = 'descripcion', $type = 'asc') {
        if ($type != 'asc') {
            $type = 'desc';
        }
        $ret = array();
        $inicio = $page * $count - $count;
        $array = $this->Ejemplar_model->generar_json_tabla_tipo_pelaje($inicio, $count, $order, $type);

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
    
    public function ver_sel($activos=true){        
        $res=array();
        $result = $this->Ejemplar_model->get_tipo_pelaje_sel($activos);
        foreach ($result as $row) {
            $res[]= $row;            
        }
        echo json_encode($res);        
    }

    public function crear_tipo_pelaje() {
        echo json_encode($this->Ejemplar_model->insert_tipo_pelaje());
    }

    public function modificar_tipo_pelaje() {
        echo json_encode($this->Ejemplar_model->edit_tipo_pelaje());
    }

    public function index() {
        $data['nombre'] = 'name';
        $data['title'] = 'Sistema Hipico';
        $this->load->view('templates/header', $data);
        $this->load->view('navbars/admin', $data);

        $this->load->view('Admin/TipoPelaje', $data);
        $this->load->view('templates/footer', $data);
    }

}
