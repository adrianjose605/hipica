<?php

/**
 * Description of TipoCondicion
 *
 * @author zyos
 */
class Ejemplar extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Jugada_model');
        $this->load->model('Ejemplar_model');
    }

    public function ver($id = null) {
        $result = $this->Ejemplar_model->get_ejemplar($id);
        foreach ($result as $row) {
            echo json_encode($row);
            break;
        }
    }
    public function ver_busqueda($descripcion) {
        $result = $this->Ejemplar_model->search_ejemplar($descripcion);
        $res = array();
        foreach ($result as $row) {
            $res[] = $row;
        }
        echo json_encode($res);
    }

    public function ver_sel($activos = true, $sexo=1) {
        $res = array();
        $result = $this->Ejemplar_model->get_ejemplar_sel($activos,$sexo);
        foreach ($result as $row) {
            $res[] = $row;
        }
        echo json_encode($res);
    }
    
    public function ver_estatus() {
        $res = array();
        $result = $this->Ejemplar_model->get_estatus();
        foreach ($result as $row) {
            $res[] = $row;
        }
        echo json_encode($res);
    }

    public function tabla_principal_ejemplar($count = 5, $page = 1, $order = 'nombre', $type = 'asc') {
        if ($type != 'asc') {
            $type = 'desc';
        }
        $ret = array();
        $inicio = $page * $count - $count;
        $array = $this->Ejemplar_model->generar_json_tabla_ejemplar($inicio, $count, $order, $type);

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

    public function crear_ejemplar() {
        echo json_encode($this->Ejemplar_model->insert_ejemplar());
    }

    public function modificar_ejemplar() {
        echo json_encode($this->Ejemplar_model->edit_ejemplar());
    }

    public function index() {
        $data['nombre'] = 'name';
        $data['title'] = 'Sistema Hipico';
        $this->load->view('templates/header', $data);
        $this->load->view('navbars/admin', $data);

        $this->load->view('Admin/Ejemplar', $data);
        $this->load->view('templates/footer', $data);
    }

}
