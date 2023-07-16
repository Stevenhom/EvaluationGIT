<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transport_Controller extends CI_Controller{

    public function transport(){
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
        $data=$this->models->getData('transport',['idtransport','type','cout']);
        $user['datas']=$data;

        $this->session->flashdata('success', 'Insertion réussie');
        $this->load->view('Back-Office/templates/template-transport', $user);
    }

    public function transport_trait(){
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
        $data=$this->models->getData('transport',['idtransport','type','cout']);
        $user['datas']=$data;
        $type= $this->input->post('type');
        $cout= $this->input->post('cout');
        $insert= $this->models->insert('transport',['type','cout'],[$type,$cout]);
        $this->session->set_flashdata('success', 'Insertion réussi');
        $this->load->view('Back-Office/templates/template-transport', $user);
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
        $idtransport=$this->input->get('idtransport');
        $data= $this->models->getDataConditionated2('transport',['type','cout'],['idtransport'],[$idtransport]);
        $datas= $data;
        for ($i=0; $i < sizeof($datas); $i++) {
            $data2= $this->models->insert('transport_deleted',['type','cout'],[$datas[$i]['type'],$datas[$i]['cout']]);
            $data3= $this->models->delete('transport',['idtransport'],[$idtransport]);
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
        $idtransport=$this->input->get('idtransport');
        $data= $this->models->getDataConditionated2('transport',['idtransport','type','cout'],['idtransport'],[$idtransport]);
        $user['datas']= $data;
        $this->load->view('Back-Office/templates/template-form-update-transport', $user); 

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
        $idtransport=$this->input->get('idtransport');
        $data=$this->models->getData('transport',['type','cout']);
        $user['datas']=$data;
        $type= $this->input->post('type');
        $cout= $this->input->post('cout');
        $update= $this->models->update('transport',['type','cout'],[$type,$cout],['idtransport'],[$idtransport]);
        //$this->session->set_flashdata('success', 'réussi');
        $this->load->view('Back-Office/templates/template', $user);    
    }
}