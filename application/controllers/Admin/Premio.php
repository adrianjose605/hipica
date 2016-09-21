<?php

/**
 * Description of TipoImplemento
 *
 * @author zyos
 */
class Premio    extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Premio_model');
    }
    
    public function ver($id = null) {
        $result = $this->Premio_model->get_premio($id);
        foreach ($result as $row) {
            echo json_encode($row);
            break;
        }
    }
    
    public function ver_distribucion($id){
        $result = $this->Premio_model->get_distribucion_premios($id);
        foreach ($result as $row) {
            echo json_encode($row);
            break;
        }
    }
    
    
    public function ver_sel($activos=true) {
        $res=array();
        $result = $this->Premio_model->get_premio_sel($activos);
        foreach ($result as $row) {
            $res[]= $row;            
        }
        echo json_encode($res);
    }

    public function tabla_principal_premio($count = 5, $page = 1, $order = 'descripcion', $type = 'asc') {
        if ($type != 'asc') {
            $type = 'desc';
        }
        $ret = array();
        $inicio = $page * $count - $count;
        $array = $this->Premio_model->generar_json_tabla_premio($inicio, $count, $order, $type);

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

    public function crear_premio() {
        echo json_encode($this->Premio_model->insert_premio());
    }

    public function modificar_premio() {
        echo json_encode($this->Premio_model->edit_premio());
    }
    
    

    public function index() {
        $data['nombre'] = 'name';
        $data['title'] = 'Sistema Hipico';
        $this->load->view('templates/header', $data);
        $this->load->view('navbars/admin', $data);

        $this->load->view('Admin/Premio', $data);
        $this->load->view('templates/footer', $data);
    }

    

}
