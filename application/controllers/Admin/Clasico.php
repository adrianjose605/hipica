<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Clasico extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Clasico_model');
    }

    public function crear_clasico() {
        echo json_encode($this->Clasico_model->insert_clasico());
    }

    public function modificar_clasico() {
        echo json_encode($this->Clasico_model->edit_clasico());
    }

    public function ver_busqueda($condicion) {
        $result = $this->Clasico_model->search_clasico($condicion);
        $res = array();
        foreach ($result as $row) {
            $res[] = $row;
        }
        echo json_encode($res);
    }

    public function index() {
        $data['nombre'] = 'name';
        $data['title'] = 'Sistema Hipico';
        $this->load->view('templates/header', $data);
        $this->load->view('navbars/admin', $data);

        $this->load->view('Admin/Clasico', $data);
        $this->load->view('templates/footer', $data);
    }

    public function ver($id = null) {
        $result = $this->Clasico_model->get_clasico($id);
        foreach ($result as $row) {
            echo json_encode($row);
            break;
        }
    }

    public function tabla_principal_clasico($count = 5, $page = 1, $order = 'tbclasico.descripcion', $type = 'asc') {
        if ($type != 'asc') {
            $type = 'desc';
        }
        $ret = array();
        $inicio = $page * $count - $count;
        $array = $this->Clasico_model->generar_json_tabla_clasico($inicio, $count, $order, $type);

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

}
