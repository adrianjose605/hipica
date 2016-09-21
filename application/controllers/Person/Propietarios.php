<?php

class Propietarios extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Propietarios_model');
    }

    public function tabla_principal($count = 5, $page = 1, $order = 'ID', $type = 'asc'){
         if ($type != 'asc') {
            $type = 'desc';
        }
        $ret = array();
        $inicio = $page * $count - $count;
        $array = $this->Propietarios_model->generar_json_tabla_principal($inicio, $count, $order, $type);
        //print_r($array);
        if ($type != 'asc') {
            $type = 'dsc';
        }
        $cantidad_total = $array['cantidad'][0]['cantidad'] + 0;
        $paginas_totales = ceil($cantidad_total / $count);

        $result = $array['resultado'];

        $meta = $array['meta'];
        foreach ($result as $row) {
            $ret['rows'][] = array_map('utf8_encode', $row);
        }

        foreach ($meta as $row) {
            $ret['header'][] = array_map('utf8_encode', array('name' => $row, 'key' => $row));
        }

        $ret['pagination'] = array('count' => $count, 'page' => $page, 'pages' => $paginas_totales, 'size' => $cantidad_total);

        $ret['sort-by'] = $order;
        $ret['sort-order'] = $type;

        echo json_encode($ret);
    }  
    
    
    public function index() {
        $data['nombre'] = 'name';
        $data['title'] = 'Sistema Hipico';
        $this->load->view('templates/header', $data);
        $this->load->view('navbars/admin', $data);
        $this->load->view('Person/Propietarios', $data);
        $this->load->view('templates/footer', $data);
    }

    public function nuevo() {
        $data['nombre'] = 'name';
        $data['title'] = 'Sistema Hipico';
        $this->load->view('templates/header', $data);
        $this->load->view('navbars/admin', $data);

        $this->load->view('Person/Nueva_persona', $data);
        $this->load->view('templates/footer', $data);
    }

}
