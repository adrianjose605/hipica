<?php

/**
 * Description of TipoCondicion
 *
 * @author zyos
 */
class TipoCondicion extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Condicion_model');
    }
    
    public function ver_sel($activos=true){        
        $res=array();
        $result = $this->Condicion_model->get_tipo_condicion_sel($activos);

        foreach ($result as $row) {
            $res[]= $row;            
        }
        echo json_encode($res);
        
    }
    
      public function ver($id = null) {
        $result = $this->Condicion_model->get_tipo_condicion($id);
        foreach ($result as $row) {
            echo json_encode($row);
            break;
        }
    }

    public function tabla_principal_tipo_condicion($count = 5, $page = 1, $order = 'descripcion', $type = 'asc') {
        if ($type != 'asc') {
            $type = 'desc';
        }
        $ret = array();
        $inicio = $page * $count - $count;
        $array = $this->Condicion_model->generar_json_tabla_tipo_condicion($inicio, $count, $order, $type);

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

    public function crear_tipo_condicion() {
        echo json_encode($this->Condicion_model->insert_tipo_condicion());
    }

    public function modificar_tipo_condicion() {
        echo json_encode($this->Condicion_model->edit_tipo_condicion());
    }

    public function index() {
        $data['nombre'] = 'name';
        $data['title'] = 'Sistema Hipico';
        $this->load->view('templates/header', $data);
        $this->load->view('navbars/admin', $data);

        $this->load->view('Admin/TipoCondicion', $data);
        $this->load->view('templates/footer', $data);
    }

    

}
