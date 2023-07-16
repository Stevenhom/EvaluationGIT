<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Artist_Controller extends CI_Controller{

    public function __construct() {
        parent::__construct();
        $this->load->library('upload');
        $this->load->helper(array('form','url'));
    }

    public function artist(){
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
        $data=$this->models->getData('artist',['idartist','name','tarif_heure']);
        $user['datas']=$data;

        $this->session->flashdata('success', 'Insertion réussie');
        $this->load->view('Back-Office/templates/template-artist', $user);
    }

    public function artist_trait(){
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
        $data=$this->models->getData('artist',['idartist','name','tarif_heure']);
        $user['datas']=$data;
        $name= $this->input->post('name');
        $tarif= $this->input->post('tarif');
        $insert= $this->models->insert('artist',['name','tarif_heure'],[$name,$tarif]);
        $this->session->set_flashdata('success', 'Insertion réussi');
        $this->load->view('Back-Office/templates/template-artist', $user);
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
        $idartist=$this->input->get('idartist');
        $data= $this->models->getDataConditionated2('artist',['name','tarif_heure'],['idartist'],[$idartist]);
        $datas= $data;
        for ($i=0; $i < sizeof($datas); $i++) {
            $data2= $this->models->insert('artist_deleted',['name','tarif_heure'],[$datas[$i]['name'],$datas[$i]['tarif_heure']]);
            $data3= $this->models->delete('artist',['idartist'],[$idartist]);
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
        $idartist=$this->input->get('idartist');
        $data= $this->models->getDataConditionated2('artist',['idartist','name','tarif_heure'],['idartist'],[$idartist]);
        $user['datas']= $data;
        $this->load->view('Back-Office/templates/template-form-update-artist', $user); 

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
        $idartist=$this->input->get('idartist');
        $data=$this->models->getData('artist',['name','tarif_heure']);
        $user['datas']=$data;
        $name= $this->input->post('name');
        $tarif= $this->input->post('tarif');
        $update= $this->models->update('artist',['name','tarif_heure'],[$name,$tarif],['idartist'],[$idartist]);
        //$this->session->set_flashdata('success', 'réussi');
        $this->load->view('Back-Office/templates/template', $user);    
    }

}