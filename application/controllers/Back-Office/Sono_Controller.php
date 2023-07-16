<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sono_Controller extends CI_Controller{

    public function sono(){
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
        $data=$this->models->getData('sonorisation',['idsono','type','tarif_heure']);
        $user['datas']=$data;

        $this->session->flashdata('success', 'Insertion réussie');
        $this->load->view('Back-Office/templates/template-sonorisation', $user);
    }

    public function sono_trait(){
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
        $data=$this->models->getData('sonorisation',['idsono','type','tarif_heure']);
        $user['datas']=$data;
        $type= $this->input->post('type');
        $tarif= $this->input->post('tarif');
        $insert= $this->models->insert('sonorisation',['type','tarif_heure'],[$type,$tarif]);
        $this->session->set_flashdata('success', 'Insertion réussi');
        $this->load->view('Back-Office/templates/template-sonorisation', $user);
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
        $idsono=$this->input->get('idsono');
        $data= $this->models->getDataConditionated2('sonorisation',['type','tarif_heure'],['idsono'],[$idsono]);
        $datas= $data;
        for ($i=0; $i < sizeof($datas); $i++) {
            $data2= $this->models->insert('sonorisation_deleted',['type','tarif_heure'],[$datas[$i]['type'],$datas[$i]['tarif_heure']]);
            $data3= $this->models->delete('sonorisation',['idsono'],[$idsono]);
            $this->session->set_flashdata('success2', 'Suppression réussi');
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
        $idsono=$this->input->get('idsono');
        $data= $this->models->getDataConditionated2('sonorisation',['idsono','type','tarif_heure'],['idsono'],[$idsono]);
        $user['datas']= $data;
        $this->load->view('Back-Office/templates/template-form-update-sonorisation', $user); 

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
        $idsono=$this->input->get('idsono');
        $data=$this->models->getData('sonorisation',['type','tarif_heure']);
        $user['datas']=$data;
        $type= $this->input->post('type');
        $tarif= $this->input->post('tarif');
        $update= $this->models->update('sonorisation',['type','tarif_heure'],[$type,$tarif],['idsono'],[$idsono]);
        //$this->session->set_flashdata('success', 'réussi');
        $this->load->view('Back-Office/templates/template', $user);    
    }

}