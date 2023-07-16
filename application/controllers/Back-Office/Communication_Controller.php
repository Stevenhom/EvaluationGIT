<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Communication_Controller extends CI_Controller{

    public function communication(){
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
        $data=$this->models->getData('communication',['idcommunication','canal','cout']);
        $user['datas']=$data;

        $this->session->flashdata('success', 'Insertion réussie');
        $this->load->view('Back-Office/templates/template-communication', $user);
    }

    public function communication_trait(){
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
        $data=$this->models->getData('communication',['idcommunication','canal','cout']);
        $user['datas']=$data;
        $canal= $this->input->post('canal');
        $cout= $this->input->post('cout');
        $insert= $this->models->insert('communication',['canal','cout'],[$canal,$cout]);
        $this->session->set_flashdata('success', 'Insertion réussi');
        $this->load->view('Back-Office/templates/template-communication', $user);
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
        $idcommunication=$this->input->get('idcommunication');
        $data= $this->models->getDataConditionated2('communication',['canal','cout'],['idcommunication'],[$idcommunication]);
        $datas= $data;
        for ($i=0; $i < sizeof($datas); $i++) {
            $data2= $this->models->insert('communication_deleted',['canal','cout'],[$datas[$i]['canal'],$datas[$i]['cout']]);
            $data3= $this->models->delete('communication',['idcommunication'],[$idcommunication]);
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
        $idcommunication=$this->input->get('idcommunication');
        $data= $this->models->getDataConditionated2('communication',['idcommunication','canal','cout'],['idcommunication'],[$idcommunication]);
        $user['datas']= $data;
        $this->load->view('Back-Office/templates/template-form-update-communication', $user); 

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
        $idcommunication=$this->input->get('idcommunication');
        $data=$this->models->getData('communication',['canal','cout']);
        $user['datas']=$data;
        $canal= $this->input->post('canal');
        $cout= $this->input->post('cout');
        $update= $this->models->update('communication',['canal','cout'],[$canal,$cout],['idcommunication'],[$idcommunication]);
        //$this->session->set_flashdata('success', 'réussi');
        $this->load->view('Back-Office/templates/template', $user);    
    }
}