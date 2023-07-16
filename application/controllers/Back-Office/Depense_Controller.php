<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Depense_Controller extends CI_Controller{

    public function depense(){
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
        $data=$this->models->getData('depense',['iddepense','label','cout']);
        $user['datas']=$data;

        $this->session->flashdata('success', 'Insertion réussie');
        $this->load->view('Back-Office/templates/template-depense', $user);
    }

    public function depense_trait(){
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
        $data=$this->models->getData('depense',['iddepense','label','cout']);
        $user['datas']=$data;
        $label= $this->input->post('label');
        $cout= $this->input->post('cout');
        $insert= $this->models->insert('depense',['label','cout'],[$label,$cout]);
        $this->session->set_flashdata('success', 'Insertion réussi');
        $this->load->view('Back-Office/templates/template-depense', $user);
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
        $iddepense=$this->input->get('iddepense');
        $data= $this->models->getDataConditionated2('depense',['label','cout'],['iddepense'],[$iddepense]);
        $datas= $data;
        for ($i=0; $i < sizeof($datas); $i++) {
            $data2= $this->models->insert('depense_deleted',['label','cout'],[$datas[$i]['label'],$datas[$i]['cout']]);
            $data3= $this->models->delete('depense',['iddepense'],[$iddepense]);
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
        $iddepense=$this->input->get('iddepense');
        $data= $this->models->getDataConditionated2('depense',['iddepense','label','cout'],['iddepense'],[$iddepense]);
        $user['datas']= $data;
        $this->load->view('Back-Office/templates/template-form-update-depense', $user); 

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
        $iddepense=$this->input->get('iddepense');
        $data=$this->models->getData('depense',['label','cout']);
        $user['datas']=$data;
        $label= $this->input->post('label');
        $cout= $this->input->post('cout');
        $update= $this->models->update('depense',['label','cout'],[$label,$cout],['iddepense'],[$iddepense]);
        //$this->session->set_flashdata('success', 'réussi');
        $this->load->view('Back-Office/templates/template', $user);    
    }

}