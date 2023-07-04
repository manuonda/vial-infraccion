<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Informe extends CI_Controller {

    public function __construct() {
        parent::__construct();
        //$this->load->helper('form');
        $this->load->helper(array('url', 'form', 'array'));
        $this->load->library('form_validation');
        $this->load->library('Pdf');
        $this->load->model('carga_model');
        $this->load->model('movil_model');
        $this->load->model('carga_especial_model');
        $this->load->model('carga_particular_model');
        $this->load->model('provision_interior_model');
        $this->load->model('provision_puesto1_model');
        $this->load->model('provision_puesto1_vale_model');        
        $this->load->model('tipo_movil_model');
        $this->load->model('situacion_model');
        $this->load->model('unidad_policial_model');
        $this->load->model('dependencia_model');
        $this->load->model('tipo_combustible_model');
        $this->load->model('carga_vale_model');
        $this->load->model('personal_model');
        $this->load->model('estacion_model');

        //Cargamos el Helper para el uso del BASE_URL()
        $this->load->helper('url');
        ini_set('max_execution_time', 0);
        ini_set('memory_limit','4048M');
    }
    
    public function index($fecha_alta=null) {
        if ($this->ion_auth->logged_in()) {
            if(empty($fecha_alta)) {
                $this->data['fecha_desde'] = date('Y-m-d');
                $this->data['fecha_hasta'] = date('Y-m-d');
            }else {
                $this->data['fecha_desde'] = $fecha_alta;
                $this->data['fecha_hasta'] = $fecha_alta;
            }
//            $this->data['listado'] = $this->carga_model->buscar($this->data);
//            $this->data['tipo_moviles'] = $this->tipo_movil_model->get_all();
//            $this->data['unidades_policiales'] = $this->unidad_policial_model->get_all();

            $this->data['contenido'] = "informe_buscar";
            $this->load->view('frontend', $this->data);
        } else {
            redirect('admin/login');
        }
    }
    
    public function carga_diaria() {
        $this->data['fecha_desde'] = '2017-06-06';
        $this->data['fecha_hasta'] = '2017-06-06';
//        $this->data['fecha_desde'] = NULL;
//        $this->data['fecha_hasta'] = NULL;

        $this->data['titulo'] = NULL;
        $fecha_desde = $this->input->post('fecha_desde');

            if(!empty($fecha_desde)) {
                list($dia_desde, $mes_desde, $anio_desde) = explode("/", $fecha_desde);
                $fecha_desde = $anio_desde . "-" . $mes_desde . "-" . $dia_desde;
                $this->data['fecha_desde'] = date('Y-m-d', strtotime($fecha_desde));
                $this->data['fecha_hasta'] = date('Y-m-d', strtotime($fecha_desde));
                //$this->data['titulo'] = 'Movil Policial';                
            }else{
                echo "Se produsco un Error";
                return;
            }
        $data_header = null;
        $html = $this->get_header($data_header, $this->data);
        $this->data['titulo'] = 'Movil Policial';
        $html = $this->get_title($html, $this->data);
        $html = $this->carga_moviles_policiales($html);
        $this->data['titulo'] = 'Cargas Especiales';
        //$html = $this->get_header($html, $this->data);
        $html = $this->get_title($html, $this->data);
        $html = $this->carga_especiales($html);
        $this->data['titulo'] = 'Cargas Particulares';
        //$html = $this->get_header($html, $this->data);
        $html = $this->get_title($html, $this->data);
        $html = $this->carga_moviles_particulares($html);
        $this->data['titulo'] = 'PROVISION al Interior';
        //$html = $this->get_header($html, $this->data);
        $html = $this->get_title($html, $this->data);       
        $html = $this->provision_al_interior($html);
        $this->data['titulo'] = 'PROVISION al Puesto 1';
        //$html = $this->get_header($html, $this->data);
        $html = $this->get_title($html, $this->data);
        $html = $this->provision_al_puesto1($html);

//        echo $html;
        ob_end_clean();
        $this->load->library('pdf');
        $pdf = new TCPDF();
        $pdf->setPrintHeader(false);
        $pdf->SetPageOrientation("L");
        $pdf->SetTitle('Reporte');
        $pdf->setPrintFooter(true);
        $pdf->setFooterMargin(20);
        $pdf->SetFont('times', '', 11);
        $pdf->AddPage();
        $pdf->writeHTML($html);
        $pdf->Output('reporte.pdf', 'I');
    }

    private function show_value($value) {
        $html = '<td align="center">';
        $html = $html . '<font size="-3">'. $value . '</font>' ;
        $html = $html . '</td>';
        return $html;
    }

    private function get_header($data, $par) {
        //$parametros = 'FECHA: 10/10/2017';
        //$parametros = $par['titulo'] .'&nbsp;&nbsp;&nbsp;' . $par['fecha_desde'];
        $parametros = date_format(date_create($par['fecha_desde']), 'd/m/Y');
        //date_format(date_create($par['fecha_desde']), 'd/m/Y H:i');
        $html =  $data . '<br><table border="0" style="border:1px solid #000000;" cellpadding="5">
				<tr>
                    <td width="15%"><img src="assets/img/escudo.png" width="580" height="315" /></td>
                    <td width="70%">
						<div align="center">
                      		Policia de Jujuy - Departamento de Logística<br/>
                      		<b>INFORME DE CARGAS DIARIA</b><br/><br/>
                      			'. $parametros .'
                      	</div>
                    </td>
                    <td width="15%"><img src="assets/img/logo.jpg" width="580" height="315" /></td>
                  </tr>
                </table><br/>';
        return $html;
    }
//get_title
    private function get_title($data, $par) {

        $parametros = $par['titulo'];
        //date_format(date_create($par['fecha_desde']), 'd/m/Y H:i');
        $html =  $data . '                            
                      		<h4 align="center"><u>'. strtoupper($parametros) .'</u></h4>
                      	<br/>';
        return $html;
    }    
    
    
    
    public function carga_moviles_policiales($html) {
        $lista_cargas = $this->carga_model->buscar($this->data);
        //echo count($lista_cargas);
//        if(count($lista_cargas) > 0){
        if(!empty(count($lista_cargas))){
        $html = $html .'<br/><table border="1">
						<thead>';
        $html = $html . '<tr>
						<th align="center" style="background-color: #F3F3F3"><b>Legajo Movil</b></th>
						<th align="center" style="background-color: #F3F3F3"><b>Dependencia</b></th>
						<th align="center" style="background-color: #F3F3F3"><b>Unidad Policial</b></th>
						<th align="center" style="background-color: #F3F3F3"><b>Tipo/Marca/ Modelo</b></th>
                                                <th align="center" style="background-color: #F3F3F3"><b>Dominio</b></th>
						<th align="center" style="background-color: #F3F3F3"><b>Kilometraje</b></th>
						<th align="center" style="background-color: #F3F3F3"><b>Combustible</b></th>
    						<th align="center" style="background-color: #F3F3F3"><b>Cantidad de litros</b></th>
						<th align="center" style="background-color: #F3F3F3"><b>Vales</b></th>
						<th align="center" style="background-color: #F3F3F3"><b>Legajo Policial</b></th>
						<th align="center" style="background-color: #F3F3F3"><b>Jerarquía</b></th>
						<th align="center" style="background-color: #F3F3F3"><b>Apellido y nombre</b></th>
						</tr>';

        $html = $html . '</thead>
				         <tbody>';

        foreach($lista_cargas as $carga):
            $html = $html . '<tr>';
            $html = $html . $this->show_value($carga->legajo_movil);
            $html = $html . $this->show_value($carga->dependencia);
            $html = $html . $this->show_value($this->unidad_policial_model->get($carga->id_unidad_policial)->nombre);
            $html = $html . $this->show_value($carga->tipo . ' '.$carga->marca . ' ' . $carga->modelo);
            $html = $html . $this->show_value($carga->dominio);
            $html = $html . $this->show_value($carga->kilometraje);
            $html = $html . $this->show_value($carga->tipo_combustible);
            $html = $html . $this->show_value($carga->cantidad_litros);
            $html = $html . $this->show_value($this->carga_vale_model->findValesByIdCarga($carga->id));
            $html = $html . $this->show_value($carga->legajo_personal);
            $html = $html . $this->show_value($carga->jerarquia);
            $html = $html . $this->show_value($carga->apellido . ' ' . $carga->nombre);
            $html = $html . '</tr>';
        endforeach;

        $html = $html . '</tbody>
				         </table><br/>';
        }else{
                $html = $html.'<table border="0">		
                            <tr>                                              
				<td align="center" style="background-color: #F3F3F3"><b>No Registra carga para la feche ingresada</b></td>
                             </tr>
                             </table>
                             ';
        }
        return $html;
    }

    public function carga_moviles_particulares($html) {
        $lista_cargas = $this->carga_particular_model->buscar($this->data);

        if(!empty(count($lista_cargas))){        
        $html = $html . '<br/><table border="1">
						<thead>';
        $html = $html . '<tr>
						<th align="center" style="background-color: #F3F3F3"><b>Dominio</b></th>
						<th align="center" style="background-color: #F3F3F3"><b>Dependencia</b></th>
						<th align="center" style="background-color: #F3F3F3"><b>Unidad Policial</b></th>
                                                <th align="center" style="background-color: #F3F3F3"><b>Modelo</b></th>
                                                <th align="center" style="background-color: #F3F3F3"><b>Kilometraje</b></th>
						<th align="center" style="background-color: #F3F3F3"><b>Combustible</b></th>
    						<th align="center" style="background-color: #F3F3F3"><b>Cantidad de litros</b></th>
						<th align="center" style="background-color: #F3F3F3"><b>Vales</b></th>
						<th align="center" style="background-color: #F3F3F3"><b>Legajo/Dni</b></th>
						<th align="center" style="background-color: #F3F3F3"><b>Jerarquía</b></th>
						<th align="center" style="background-color: #F3F3F3"><b>Apellido y nombre</b></th>
                                                <th align="center" style="background-color: #F3F3F3"><b>Lugar de Trabajo</b></th>
						</tr>';

        $html = $html . '</thead>
				         <tbody>';

        foreach($lista_cargas as $carga):
            $html = $html . '<tr>';
            $html = $html . $this->show_value($carga->dominio);
            //if(!empty($carga->id_dependencia)) echo $this->dependencia_model->get($carga->id_dependencia)->dependencia;
            $x = NULL;
            if(!empty($carga->id_dependencia)) {
                $x=$this->dependencia_model->get($carga->id_dependencia)->dependencia;
            }
            $html = $html . $this->show_value($x);
            $html = $html . $this->show_value($this->unidad_policial_model->get($carga->id_unidad_policial)->nombre);
            $html = $html . $this->show_value($this->tipo_movil_model->get($carga->id_tipo_movil)->descripcion . ' '.$carga->marca . ' ' . $carga->modelo);
            $html = $html . $this->show_value($carga->kilometraje);
            $html = $html . $this->show_value($carga->tipo_combustible);
            $html = $html . $this->show_value($carga->cantidad_litros);
            $html = $html . $this->show_value($this->carga_vale_model->findValesByIdCargaParticular($carga->id));
            //$this->carga_vale_model->findValesByIdCargaParticular($item->id);
            $x = NULL;
                        if(!empty($carga->legajo) && !empty($carga->dni)) {
                            $x = $carga->legajo . ' / ' .$carga->dni;
                        }else {
                            if(!empty($carga->legajo)) {
                                $x = $carga->legajo;
                            }
                            if(!empty($carga->dni)) {
                                $x = $carga->dni;
                            }
                        }            
            $html = $html . $this->show_value($x);
            $html = $html . $this->show_value($carga->cargo_funcion);
            $html = $html . $this->show_value($carga->apellido . ' ' . $carga->nombre);
            $html = $html . $this->show_value($carga->lugar_de_trabajo);
            //$item->lugar_de_trabajo
            $html = $html . '</tr>';
        endforeach;

        $html = $html . '</tbody>
				         </table>';
        }else{
                $html = $html.' <table border="0">		
                            <tr>                                              
				<td align="center" style="background-color: #F3F3F3"><b>No Registra carga para la feche ingresada</b></td>
                             </tr>
                             </table>
                             ';
        }        
        return $html;        
        //return $html;
    }

    public function carga_especiales($html) {
        //$lista_cargas = $this->carga_model->buscar($this->data);
        $lista_cargas = $this->carga_especial_model->buscar($this->data);
        if(!empty(count($lista_cargas))){           
        $html = $html . '<br/><table border="1">
						<thead>';
        $html = $html . '<tr>
						<th align="center" style="background-color: #F3F3F3"><b>Descripcion</b></th>
						<th align="center" style="background-color: #F3F3F3"><b>Destino</b></th>
						<th align="center" style="background-color: #F3F3F3"><b>Unidad Policial</b></th>
						<th align="center" style="background-color: #F3F3F3"><b>Combustible</b></th>
    						<th align="center" style="background-color: #F3F3F3"><b>Cantidad de litros</b></th>
						<th align="center" style="background-color: #F3F3F3"><b>Vales</b></th>
						<th align="center" style="background-color: #F3F3F3"><b>Legajo Policial</b></th>
						<th align="center" style="background-color: #F3F3F3"><b>Jerarquía</b></th>
						<th align="center" style="background-color: #F3F3F3"><b>Apellido y nombre</b></th>
						</tr>';

        $html = $html . '</thead>
				         <tbody>';

        foreach($lista_cargas as $carga):
            $html = $html . '<tr>';
            $html = $html . $this->show_value($carga->descripcion);
            $html = $html . $this->show_value($carga->dependencia);
            $html = $html . $this->show_value($this->unidad_policial_model->get($carga->id_unidad_policial)->nombre);
            $html = $html . $this->show_value($carga->tipo_combustible);
            $html = $html . $this->show_value($carga->cantidad_litros);
            $html = $html . $this->show_value($this->carga_vale_model->findValesByIdCargaEspecial($carga->id));
            $html = $html . $this->show_value($carga->legajo_personal);
            $html = $html . $this->show_value($carga->jerarquia);
            $html = $html . $this->show_value($carga->apellido . ' ' . $carga->nombre);
            $html = $html . '</tr>';
        endforeach;

        $html = $html . '</tbody>
				         </table><br/>';
        }else{
                $html = $html.' <table border="0">		
                            <tr>                                              
				<td align="center" style="background-color: #F3F3F3"><b>No Registra carga para la feche ingresada</b></td>
                             </tr>
                             </table>
                             ';
        }                
        return $html;
    }

    public function provision_al_interior($html) {
        $lista_cargas = $this->provision_interior_model->buscar($this->data);
        //$this->provision_interior_model->buscar($this->data)
        if(!empty(count($lista_cargas))){  
        $html = $html . '<br/><table border="1">
						<thead>';
        $html = $html . '<tr>

						<th align="center" style="background-color: #F3F3F3"><b>Destino</b></th>
						<th align="center" style="background-color: #F3F3F3"><b>Combustible</b></th>
    						<th align="center" style="background-color: #F3F3F3"><b>Cantidad de litros</b></th>                                                
						<th align="center" style="background-color: #F3F3F3"><b>Vales</b></th>                                                
						<th align="center" style="background-color: #F3F3F3"><b>Legajo Policial</b></th>                                                
						<th align="center" style="background-color: #F3F3F3"><b>Jerarquía</b></th>
						<th align="center" style="background-color: #F3F3F3"><b>Apellido y nombre</b></th>
						</tr>';

        $html = $html . '</thead>
				         <tbody>';

        foreach($lista_cargas as $carga):
            $html = $html . '<tr>';
            $x = NULL;
                        if(!empty($carga->destino_1)){
                            $x = $this->unidad_policial_model->get($carga->destino_1)->nombre;
                        }
                        if(!empty($carga->destino_2)){
                            $x = $x . ' y '.$this->unidad_policial_model->get($carga->destino_2)->nombre;
                        }

            $html = $html . $this->show_value($x);
            $x = NULL;
                    if(empty($carga->id_tipo_combustible_2)) {
                        $x = $this->tipo_combustible_model->get($carga->id_tipo_combustible_1)->descripcion;
                    }else {
                        $x = $this->tipo_combustible_model->get($carga->id_tipo_combustible_1)->descripcion . " ($carga->cantidad_litros_1 Lt.), " . $this->tipo_combustible_model->get($carga->id_tipo_combustible_2)->descripcion . " ($carga->cantidad_litros_2 Lt.)";
                    }
            $html = $html . $this->show_value($x);
            $x = NULL;
                        if(empty($carga->cantidad_litros_2)) {
                            $x = $carga->cantidad_litros_1;
                        }else {
                            $x = $carga->cantidad_litros_1 + $carga->cantidad_litros_2;
                        }
            $html = $html . $this->show_value($x);
            $html = $html . $this->show_value($this->carga_vale_model->findValesByIdProvisionInterior($carga->id));
            $html = $html . $this->show_value($carga->legajo_personal);
            $html = $html . $this->show_value($carga->jerarquia);
            $html = $html . $this->show_value($carga->apellido . ' ' . $carga->nombre);
            $html = $html . '</tr>';
        endforeach;

        $html = $html . '</tbody>
				         </table><br/>';
        }else{
                $html = $html.' <table border="0">		
                            <tr>                                              
				<td align="center" style="background-color: #F3F3F3"><b>No Registra carga para la feche ingresada</b></td>
                             </tr>
                             </table>
                             ';
        }                  
        return $html;
    }

    public function provision_al_puesto1($html) {
        $lista_cargas = $this->provision_puesto1_model->buscar($this->data);
        //$this->provision_interior_model->buscar($this->data)
        if(!empty(count($lista_cargas))){  
        $html = $html . '<br/><table border="1">
						<thead>';
        $html = $html . '<tr>                                              
						<th align="center" style="background-color: #F3F3F3"><b>Vales</b></th>                                                
						<th align="center" style="background-color: #F3F3F3"><b>Legajo Policial</b></th>                                                
						<th align="center" style="background-color: #F3F3F3"><b>Jerarquía</b></th>
						<th align="center" style="background-color: #F3F3F3"><b>Apellido y nombre</b></th>
						</tr>';

        $html = $html . '</thead>
				         <tbody>';

        foreach($lista_cargas as $carga):
            $html = $html . '<tr>';
            $html = $html . $this->show_value($this->provision_puesto1_vale_model->findValesByIdProvision($carga->id));
            $html = $html . $this->show_value($carga->legajo_personal);
            $html = $html . $this->show_value($carga->jerarquia);
            $html = $html . $this->show_value($carga->apellido . ' ' . $carga->nombre);
            $html = $html . '</tr>';
        endforeach;

        $html = $html . '</tbody>
				         </table><br/>';
        }else{
                //$html = $html.' <b> No Registra carga para la feche ingresada</b><br/>';
                $html = $html. '<table border="0">		
                            <tr>                                              
				<td align="center" style="background-color: #F3F3F3"><b>No Registra carga para la feche ingresada</b></td>
                             </tr>
                             </table>
                             ';
        }                         
        return $html;        
        
    }

    public function pdf() {
        $pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
        $pdf->SetTitle('My Title');
        $pdf->SetHeaderMargin(30);
        $pdf->SetTopMargin(20);
        $pdf->setFooterMargin(20);
        $pdf->SetAutoPageBreak(true);
        $pdf->SetAuthor('Author');
        $pdf->SetDisplayMode('real', 'default');

        $pdf->AddPage();

        $pdf->Write(5, 'Some sample text');
        $pdf->Output('My-File-Name.pdf', 'I');
    }
}