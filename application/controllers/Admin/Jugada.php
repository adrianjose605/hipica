<?php

/**
 * Description of TipoCondicion
 *
 * @author zyos
 */
class Jugada extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Jugada_model');
    }

    public function ver_sel($activos = true) {
        $res = array();
        $result = $this->Jugada_model->get_jugadas_sel($activos);
        foreach ($result as $row) {
            $res[] = $row;
        }
        echo json_encode($res);
    }


     public function ver($id) {
        $result = $this->Jugada_model->get_Jugada($id);
        foreach ($result as $row) {
            
            $resultd=$this->Jugada_model->get_hipodromos_asociados($id);
            $res=array();
            $val=0;
            foreach ($resultd as $rowi) {
                $row['hipodromos'][] = array_map('utf8_encode', $rowi);
                $val++;
            }
            
            
            echo json_encode($row);


            break;
        }
    }
    
    
    
    public function ver_checks($hipodromo){
        $res = array();
        $result = $this->Jugada_model->get_jugadas_checkbox($hipodromo);
        foreach ($result as $row) {
            $res[] = $row;
        }
        echo json_encode($res);
    }
    
    public function tabla_principal_jugada($count = 5, $page = 1, $order = 'descripcion', $type = 'asc') {
        if ($type != 'asc') {
            $type = 'desc';
        }
        $ret = array();
        $inicio = $page * $count - $count;
        $array = $this->Jugada_model->generar_json_tabla_jugada($inicio, $count, $order, $type);

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

    public function crear_jugada() {
        echo json_encode($this->Jugada_model->insert_jugada());
    }

    public function modificar_jugada() {
        echo json_encode($this->Jugada_model->edit_jugada());
    }

    public function ver_busqueda($condicion) {
        $result = $this->Jugada_model->search_jugada($condicion);
        $res = array();
        foreach ($result as $row) {
            $res[] = $row;
        }
        echo json_encode($res);
    }

    public function index() {
        $data['nombre'] = 'name';
        $data['title'] = 'Sistema Hipico';
        $this->load->view('templates/header', $data);
        $this->load->view('navbars/admin', $data);

        $this->load->view('Admin/Jugada', $data);
        $this->load->view('templates/footer', $data);
    }

}
