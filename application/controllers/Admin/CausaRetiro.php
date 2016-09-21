<?php

/**
 * Description of CausaRetiro
 *
 * @author zyos
 */
class CausaRetiro extends CI_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('Retiros_model');
    }

    public function ver($id = nulal) {
        $result = $this->Retiros_model->get_causa_retiros($id);
        foreach ($result as $row) {
            echo json_encode($row);
            break;
        }
    }

    public function tabla_principal_causa_retiro($count = 5, $page = 1, $order = 'descripcion', $type = 'asc') {
        if ($type != 'asc') {
            $type = 'desc';
        }
        $ret = array();
        $inicio = $page * $count - $count;
        $array = $this->Retiros_model->generar_json_tabla_causa_retiro($inicio, $count, $order, $type);

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

    public function crear_causa_retiro() {
        echo json_encode($this->Retiros_model->insert_causa_retiros());
    }
    
     public function modificar_causa_retiro() {
        echo json_encode($this->Retiros_model->edit_causa_retiros());
    }


    public function index() {
        $data['nombre'] = 'name';
        $data['title'] = 'Sistema Hipico';
        $this->load->view('templates/header', $data);
        $this->load->view('navbars/admin', $data);

        $this->load->view('Admin/CausaRetiro', $data);
        $this->load->view('templates/footer', $data);
    }

}
