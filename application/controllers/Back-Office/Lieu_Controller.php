<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lieu_Controller extends CI_Controller{

    public function lieu(){
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
        $data=$this->models->getData('lieu',['idlieu','label','place','cout']);
        $user['datas']=$data;

        $this->session->flashdata('success', 'Insertion réussie');
        $this->load->view('Back-Office/templates/template-lieu', $user);
    }

    public function lieu_trait(){
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
        $data=$this->models->getData('lieu',['idlieu','label','place','cout']);
        $user['datas']=$data;
        $label= $this->input->post('label');
        $place= $this->input->post('place');
        $cout= $this->input->post('cout');
        $insert= $this->models->insert('lieu',['label','place','cout'],[$label,$place,$cout]);
        $this->session->set_flashdata('success', 'Insertion réussi');
        $this->load->view('Back-Office/templates/template-lieu', $user);
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
        $idlieu=$this->input->get('idlieu');
        $data= $this->models->getDataConditionated2('lieu',['label','place','cout'],['idlieu'],[$idlieu]);
        $datas= $data;
        for ($i=0; $i < sizeof($datas); $i++) {
            $data2= $this->models->insert('lieu_deleted',['label','place','cout'],[$datas[$i]['label'],$datas[$i]['place'],$datas[$i]['cout']]);
            $data3= $this->models->delete('lieu',['idlieu'],[$idlieu]);
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
        $idlieu=$this->input->get('idlieu');
        $data= $this->models->getDataConditionated2('lieu',['idlieu','label','place','cout'],['idlieu'],[$idlieu]);
        $user['datas']= $data;
        $this->load->view('Back-Office/templates/template-form-update-lieu', $user); 

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
        $idlieu=$this->input->get('idlieu');
        $data=$this->models->getData('lieu',['label','place','cout']);
        $user['datas']=$data;
        $label= $this->input->post('label');
        $place= $this->input->post('place');
        $cout= $this->input->post('cout');
        $update= $this->models->update('lieu',['label','place','cout'],[$label,$place,$cout],['idlieu'],[$idlieu]);
        //$this->session->set_flashdata('success', 'réussi');
        $this->load->view('Back-Office/templates/template', $user);    
    }

}