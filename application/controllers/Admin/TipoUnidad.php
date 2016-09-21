<?php


class TipoUnidad extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Unidad_model');
    }

    public function ver($id = null) {
        $result = $this->Unidad_model->get_tipo_unidad($id);
        foreach ($result as $row) {
            echo json_encode($row);
            break;
        }
    }

    public function tabla_principal_tipo_unidad($count = 5, $page = 1, $order = 'nombretipounidad', $type = 'asc') {
        if ($type != 'asc') {
            $type = 'desc';
        }
        $ret = array();
        $inicio = $page * $count - $count;
        $array = $this->Unidad_model->generar_json_tabla_tipo_unidad($inicio, $count, $order, $type);

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

    public function crear_tipo_unidad() {
        echo json_encode($this->Unidad_model->insert_tipo_unidad());
    }

    public function modificar_tipo_unidad() {
        echo json_encode($this->Unidad_model->edit_tipo_unidad());
    }

    public function index() {
        $data['nombre'] = 'name';
        $data['title'] = 'Sistema Hipico';
        $this->load->view('templates/header', $data);
        $this->load->view('navbars/admin', $data);

        $this->load->view('Admin/TipoUnidad', $data);
        $this->load->view('templates/footer', $data);
    }

}
