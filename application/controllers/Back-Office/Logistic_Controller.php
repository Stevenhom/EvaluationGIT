<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logistic_Controller extends CI_Controller{

    public function logistique(){
        $this->load->model('models');
		$this->load->helper('url');
		$this->load->helper('url_helper');
        $this->load->library('session');
        $user_id = $this->session->userdata('user_id');
        $email = $this->session->userdata('email');
        $pass = $this->session->userdata('pass');
        $user_id = $this->models->get_userid($email, $pass);
        $this->session->set_userdata('user_id', $user_id);
        $user=$this->models->get_userdata($user_id);
        $user['admin']= $user;
        $data=$this->models->getData('logistique',['idlogistique','type','tarif_jour']);
        $user['datas']=$data;

        $this->session->flashdata('success', 'Insertion réussie');
        $this->load->view('Back-Office/templates/template-logistique', $user);
    }

    public function logistique_trait(){
        $this->load->model('models');
        $this->load->helper('url');
        $this->load->helper('url_helper');
        $this->load->library('session');
        $user_id = $this->session->userdata('user_id');
        $email = $this->session->userdata('email');
        $pass = $this->session->userdata('pass');
        $user_id = $this->models->get_userid($email, $pass);
        $this->session->set_userdata('user_id', $user_id);
        $user=$this->models->get_userdata($user_id);
        $user['admin']= $user;
        $data=$this->models->getData('logistique',['idlogistique','type','tarif_jour']);
        $user['datas']=$data;
        $type= $this->input->post('type');
        $tarif= $this->input->post('tarif');
        $insert= $this->models->insert('logistique',['type','tarif_jour'],[$type,$tarif]);
        $this->session->set_flashdata('success', 'Insertion réussi');
        $this->load->view('Back-Office/templates/template-logistique', $user);
    }

    public function delete(){
        $this->load->model('models');
		$this->load->helper('url');
		$this->load->helper('url_helper');
        $this->load->library('session');
        $user_id = $this->session->userdata('user_id');
        $email = $this->session->userdata('email');
        $pass = $this->session->userdata('pass');
        $user_id = $this->models->get_userid($email, $pass);
        $this->session->set_userdata('user_id', $user_id);
        $user=$this->models->get_userdata($user_id);
        $user['admin']= $user;
        $idlogistique=$this->input->get('idlogistique');
        $data= $this->models->getDataConditionated2('logistique',['type','tarif_jour'],['idlogistique'],[$idlogistique]);
        $datas= $data;
        for ($i=0; $i < sizeof($datas); $i++) {
            $data2= $this->models->insert('logistique_deleted',['type','tarif_jour'],[$datas[$i]['type'],$datas[$i]['tarif_jour']]);
            $data3= $this->models->delete('logistique',['idlogistique'],[$idlogistique]);
            //$this->session->set_flashdata('success2', 'Suppression réussi');
            redirect(site_url('Back-Office/SController/home'));
        }
        

    }

    public function update(){
        $this->load->model('models');
		$this->load->helper('url');
		$this->load->helper('url_helper');
        $this->load->library('session');
        $user_id = $this->session->userdata('user_id');
        $email = $this->session->userdata('email');
        $pass = $this->session->userdata('pass');
        $user_id = $this->models->get_userid($email, $pass);
        $this->session->set_userdata('user_id', $user_id);
        $user=$this->models->get_userdata($user_id);
        $user['admin']= $user;
        $idlogistique=$this->input->get('idlogistique');
        $data= $this->models->getDataConditionated2('logistique',['idlogistique','type','tarif_jour'],['idlogistique'],[$idlogistique]);
        $user['datas']= $data;
        $this->load->view('Back-Office/templates/template-form-update-logistique', $user); 

    }

    
    public function form_trait_update(){
        $this->load->model('models');
        $this->load->helper('url');
        $this->load->helper('url_helper');
        $this->load->library('session');
        $user_id = $this->session->userdata('user_id');
        $email = $this->session->userdata('email');
        $pass = $this->session->userdata('pass');
        $user_id = $this->models->get_userid($email, $pass);
        $this->session->set_userdata('user_id', $user_id);
        $user=$this->models->get_userdata($user_id);
        $user['admin']= $user;
        $idlogistique=$this->input->get('idlogistique');
        $data=$this->models->getData('logistique',['type','tarif_jour']);
        $user['datas']=$data;
        
        $type= $this->input->post('type');
        $tarif= $this->input->post('tarif');
        echo 
        $update= $this->models->update('logistique',['type','tarif_jour'],[$type,$tarif],['idlogistique'],[$idlogistique]);
        //$this->session->set_flashdata('success', 'réussi');
        $this->load->view('Back-Office/templates/template', $user);    
    }

}