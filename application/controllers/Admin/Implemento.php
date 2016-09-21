<?php

/**
 * Description of TipoImplemento
 *
 * @author zyos
 */
class Implemento extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Participante_model');
    }

    public function ver($id = null) {
        $result = $this->Participante_model->get_implemento($id);
        foreach ($result as $row) {
            echo json_encode($row);
            break;
        }
    }

    public function ver_busqueda($condicion) {
        $result = $this->Participante_model->search_implemento($condicion);
        $res = array();
        foreach ($result as $row) {
            $res[] = $row;
        }
        echo json_encode($res);
    }
    
    
    public function ver_busqueda_defecto($id) {
        $result = $this->Participante_model->get_implementos_por_defecto($id);
        $res = array();
        foreach ($result as $row) {
            $res[] = $row;            
        }
        echo json_encode($res);
    }    
    

    public function tabla_principal_implemento($count = 5, $page = 1, $order = 'descripcion', $type = 'asc') {
        if ($type != 'asc') {
            $type = 'desc';
        }
        $ret = array();
        $inicio = $page * $count - $count;
        $array = $this->Participante_model->generar_json_tabla_implemento($inicio, $count, $order, $type);

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

    public function crear_implemento() {
        echo json_encode($this->Participante_model->insert_implemento());
    }

    public function modificar_implemento() {
        echo json_encode($this->Participante_model->edit_implemento());
    }

    public function index() {
        $data['nombre'] = 'name';
        $data['title'] = 'Sistema Hipico';
        $this->load->view('templates/header', $data);
        $this->load->view('navbars/admin', $data);

        $this->load->view('Admin/Implemento', $data);
        $this->load->view('templates/footer', $data);
    }

}
