<?php

class Tropiezo extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Tropiezo_model');
    }    
    
    /**
     * Creacion  de un nuevo pais
     */
    public function nuevo_tropiezo(){        
        echo json_encode($this->Tropiezo_model->insert_tropiezo());         
    }
    
    
      public function modificar_tropiezo(){
        echo json_encode($this->Tropiezo_model->edit_tropiezo());         
    }
    
    
    public function tabla_principal_tropiezo($count = 5, $page = 1, $order = 'Descripcion', $type = 'asc'){
         if ($type != 'asc') {
            $type = 'desc';
        }
        $ret = array();
        $inicio = $page * $count - $count;
        $array = $this->Tropiezo_model->generar_json_tabla_principal($inicio, $count, $order, $type);

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
    
    public function ver ($id=1){             
        $result=$this->Tropiezo_model->get_Tropiezo($id);
        foreach ($result as $row) {
            echo  json_encode($row);
            break;
        }
    }

    public function index() {
        $data['descripcion'] = 'name';
        $data['title'] = 'Sistema Hipico';
        $this->load->view('templates/header', $data);
        $this->load->view('navbars/admin', $data);

        $this->load->view('Admin/Tropiezo', $data);
        $this->load->view('templates/footer', $data);
    }
    
}


