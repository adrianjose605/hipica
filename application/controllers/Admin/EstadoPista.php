<?php

class EstadoPista extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Pista_model');
    }    
    
   
    public function crear_estado_pista(){        
        echo json_encode($this->Pista_model->insert_estado_pista());         
    }
    
    
      public function modificar_estado_pista(){
        echo json_encode($this->Pista_model->edit_estado_pista());         
    }
    
    
    public function tabla_principal_estado_pista($count = 5, $page = 1, $order = 'Descripcion', $type = 'asc'){
         if ($type != 'asc') {
            $type = 'desc';
        }
        $ret = array();
        $inicio = $page * $count - $count;
        $array = $this->Pista_model->generar_json_tabla_principal($inicio, $count, $order, $type);

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
        $result=$this->Pista_model->get_estado_pista($id);
        foreach ($result as $row) {
            echo  json_encode($row);
            break;
        }
    }
    
   public function ver_estadoPistas_sel($activos=true){        
        $res=array();
        $result = $this->Pista_model->get_estado_pista_sel($activos);
        foreach ($result as $row) {
            $res[]= $row;            
        }
        echo json_encode($res);        
    }
    


    public function index() {
        $data['descripcion'] = 'name';
        $data['title'] = 'Sistema Hipico';
        $this->load->view('templates/header', $data);
        $this->load->view('navbars/admin', $data);

        $this->load->view('Admin/EstadoPista', $data);
        $this->load->view('templates/footer', $data);
    }
    
}


