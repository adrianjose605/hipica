<?php

/**
 * Description of CausaRetiro
 *
 * @author zyos
 */
class NuevaCarrera extends CI_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('Carrera_model');
    }
    
    public function ver($id) {
        return$this->Carrera_model->get_carrera($id);
        /*
        foreach ($result as $row) {
            echo json_encode($row);
            break;
        }
         * */         
    }
    
    public function cambiar_estado($id){
        echo json_encode ($this->Carrera_model->cambiar_estado_carrera($id));            
            
      
                
    }
    
    public function ver_anual($tipo,$id){
        echo  $this->Carrera_model->get_anual($tipo=='true',$id);
        
    }
    
   
    
    
    public function tabla_principal_carrera($count = 5, $page = 1, $order = '`Fecha-Hora`', $type = 'asc'){
         if ($type != 'asc') {
            $type = 'desc';
        }
        $ret = array();
        $inicio = $page * $count - $count;
        $array = $this->Carrera_model->generar_json_tabla_principal($inicio, $count, $order, $type);

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
    

    public function index() {
        $data['nombre'] = 'name';
        $data['title'] = 'Sistema Hipico';
        //
        $this->load->view('templates/header', $data);
        $this->load->view('navbars/admin', $data);        
        $data['hipodromo'] = $this->input->post('hipodromo') ? $this->input->post('hipodromo') : null;
        $data['id'] = $this->input->post('id') ? $this->input->post('id') : null;
        
        
        $data['pais'] = $this->input->post('pais') ? $this->input->post('pais') : null;
        $data['fecha'] = $this->input->post('fecha') ? $this->input->post('fecha') : null;
        ;
        $this->load->view('bloque/NuevaCarrera', $data);
        $this->load->view('templates/footer', $data);
    }

    public function nueva() {

        echo json_encode($this->Carrera_model->insert_carrera());
    }

    public function edit() {
        echo json_encode($this->Carrera_model->edit_carrera());
    }

    public function listado() {
        echo json_encode($this->Carrera_model->edit_carrera());
    }

}
