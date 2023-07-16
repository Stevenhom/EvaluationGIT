<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SController extends CI_Controller{

    public function home(){
        $this->load->model('models');
		$this->load->helper('url');
		$this->load->helper('url_helper');

        //$data=$this->models->getData('laptop_info',['idlaptop','marque','reference','processeur','ram','ecran','type_ecran','disque_dur','memoire','prix','image']);
        //$user['datas']=$data;
        $data=$this->models->getData('event_list',['name','artist','sonorisation','logistique','lieu','communication','transport','sponsor','depense','date']);
        $user['datas']=$data;
        $data2=$this->models->getData('devis',['devis']);
        $user['calcul']=$data2;
        $this->load->view('Front-Office/templates/template', $user);
    }

}

