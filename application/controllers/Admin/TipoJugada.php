<?php

class TipoJugada extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Jugada_model');
    }

    public function ver($id = null) {
        $result = $this->Jugada_model->get_tipo_jugada($id);
        foreach ($result as $row) {
            echo json_encode($row);
            break;
        }
    }

    public function ver_sel($activos=true) {
        $res=array();
        $result = $this->Jugada_model->get_tipo_jugada_sel($activos);

        foreach ($result as $row) {
            $res[]= $row;            
        }
        echo json_encode($res);
    }

    public function tabla_principal_tipo_jugada($count = 5, $page = 1, $order = 'descripcion', $type = 'asc') {
        if ($type != 'asc') {
            $type = 'desc';
        }
        $ret = array();
        $inicio = $page * $count - $count;
        $array = $this->Jugada_model->generar_json_tabla_tipo_jugada($inicio, $count, $order, $type);

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

    public function crear_tipo_jugada() {
        echo json_encode($this->Jugada_model->insert_tipo_jugada());
    }

    public function modificar_tipo_jugada() {
        echo json_encode($this->Jugada_model->edit_tipo_jugada());
    }

    public function index() {
        $data['nombre'] = 'name';
        $data['title'] = 'Sistema Hipico';
        $this->load->view('templates/header', $data);
        $this->load->view('navbars/admin', $data);

        $this->load->view('Admin/TipoJugada', $data);
        $this->load->view('templates/footer', $data);
    }

}
