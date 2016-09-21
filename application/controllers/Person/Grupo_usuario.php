<?php

class Grupo_usuario extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Grupo_usuario_model');
    }    
    
    /**
     * Creacion  de un nuevo pais
     */
    public function nuevo_pais(){        
        echo json_encode($this->Grupo_usuario_model->insert_pais());         
    }
    
    public function modificar_pais(){
        echo json_encode($this->Grupo_usuario_model->edit_pais());         
    }
    
    public function tabla_principal_paises($count = 5, $page = 1, $order = 'nombre', $type = 'asc'){
         if ($type != 'asc') {
            $type = 'desc';
        }
        $ret = array();
        $inicio = $page * $count - $count;
        $array = $this->Grupo_usuario_model->generar_json_tabla_principal($inicio, $count, $order, $type);

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
    
    public function ver ($id=1){             
        $result=$this->Grupo_usuario_model->get_pais($id);
        foreach ($result as $row) {
            echo  json_encode(array_map('utf8_encode', $row));
            break;
        }
    }
        
    public function ver_sel($activos=true){        
        $res=array();
        $result = $this->Grupo_usuario_model->get_pais_sel($activos);
        foreach ($result as $row) {
            $res[]= array_map('utf8_encode', $row);            
        }
        echo json_encode($res);        
    }
    

    public function index() {
        $data['nombre'] = 'name';
        $data['title'] = 'Sistema Hipico';
        $this->load->view('templates/header', $data);
        $this->load->view('navbars/admin', $data);

        $this->load->view('User/Grupo_usuario', $data);
        $this->load->view('templates/footer', $data);
    }
    
}
