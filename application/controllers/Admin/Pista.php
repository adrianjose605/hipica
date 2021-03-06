<?php

class Pista extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Pista_model');
    }

    /**
     * Creacion  de un nuevo pais
     */
    public function crear_Pista() {
        echo json_encode($this->Pista_model->insert_pista());
    }

    public function modificar_Pista() {
        echo json_encode($this->Pista_model->edit_pista());
    }

    public function tabla_principal_pista($count = 5, $page = 1, $order = 'descripcion', $type = 'asc') {
        if ($type != 'asc') {
            $type = 'desc';
        }
        $ret = array();
        $inicio = $page * $count - $count;
        $array = $this->Pista_model->generar_json_tabla_pista($inicio, $count, $order, $type);
        
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

    public function ver($id = 1) {
        $result = $this->Pista_model->get_Pista($id);
        foreach ($result as $row) {
            
            $resultd=$this->Pista_model->get_distancias_asociadas($id);
            $res=array();
            $val=0;
            foreach ($resultd as $rowi) {
                $row['distancias'][] = array_map('utf8_encode', $rowi);
                $val++;
            }
            
            
            echo json_encode($row);


            break;
        }
    }

    public function index() {
        $data['descripcion'] = 'name';
        $data['title'] = 'Sistema Hipico';
        $this->load->view('templates/header', $data);
        $this->load->view('navbars/admin', $data);

        $this->load->view('Admin/Pista', $data);
        $this->load->view('templates/footer', $data);
    }
    
    
    public function ver_sel_hipodromo($hipodromo,$activos=true){
        $res=array();
        $result = $this->Pista_model->get_pista_hipodromo_sel($hipodromo,$activos);
        foreach ($result as $row) {
            $res[]= $row;            
        }
        echo json_encode($res);        
        
    }

}

