<?php
/**
 * Description of CausaRetiro
 *
 * @author zyos
 */
class PreCarga extends CI_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('Carrera_model');
        
    }
    

    public function index() {
        $data['nombre'] = 'name';
        $data['title'] = 'Sistema Hipico';
        $this->load->view('templates/header', $data);
        $this->load->view('navbars/admin', $data);

        $this->load->view('bloque/Precarga', $data);
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
