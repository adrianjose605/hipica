<?php

class Hipodromo extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Hipodromo_model');
    }    
    
    /**
     * Creacion  de un nuevo pais
     */
    public function crear_hipodromo(){        
        echo json_encode($this->Hipodromo_model->insert_hipodromo());         
    }
    
    
      public function modificar_hipodromo(){
        echo json_encode($this->Hipodromo_model->edit_hipodromo());         
    }
    
    public function ver_chip($descripcion) {
        $result = $this->Hipodromo_model->search_hipodromo($descripcion);
        $res = array();
        foreach ($result as $row) {
            $res[] = $row;
        }
        echo json_encode($res);
    }
    public function tabla_principal_hipodromo($count = 5, $page = 1, $order = 'Descripcion', $type = 'asc'){
         if ($type != 'asc') {
            $type = 'desc';
        }
        $ret = array();
        $inicio = $page * $count - $count;
        $array = $this->Hipodromo_model->generar_json_tabla_principal($inicio, $count, $order, $type);

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
        $result=$this->Hipodromo_model->get_hipodromo($id);
        foreach ($result as $row) {
            echo  json_encode($row);
            break;
        }
    }
    
   public function ver_sel($activos=true){        
        $res=array();
        $result = $this->Hipodromo_model->get_hipodromo_sel($activos);
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

        $this->load->view('Admin/Hipodromo', $data);
        $this->load->view('templates/footer', $data);
    }
    
    
    public function ver_sel_pais($pais,$activos=true){
        $res=array();
        $result = $this->Hipodromo_model->get_hipodromo_pais_sel($pais,$activos);
        foreach ($result as $row) {
            $res[]= $row;            
        }
        echo json_encode($res);        
        
    }
    
}


