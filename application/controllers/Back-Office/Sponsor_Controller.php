<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sponsor_Controller extends CI_Controller{

    public function sponsor(){
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
        $data=$this->models->getData('sponsor',['idsponsor','label','cout']);
        $user['datas']=$data;

        $this->session->flashdata('success', 'Insertion réussie');
        $this->load->view('Back-Office/templates/template-sponsor', $user);
    }

    public function sponsor_trait(){
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
        $data=$this->models->getData('sponsor',['idsponsor','label','cout']);
        $user['datas']=$data;
        $label= $this->input->post('label');
        $cout= $this->input->post('cout');
        $insert= $this->models->insert('sponsor',['label','cout'],[$label,$cout]);
        $this->session->set_flashdata('success', 'Insertion réussi');
        $this->load->view('Back-Office/templates/template-sponsor', $user);
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
        $idsponsor=$this->input->get('idsponsor');
        $data= $this->models->getDataConditionated2('sponsor',['label','cout'],['idsponsor'],[$idsponsor]);
        $datas= $data;
        for ($i=0; $i < sizeof($datas); $i++) {
            $data2= $this->models->insert('sponsor_deleted',['label','cout'],[$datas[$i]['label'],$datas[$i]['cout']]);
            $data3= $this->models->delete('sponsor',['idsponsor'],[$idsponsor]);
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
        $idsponsor=$this->input->get('idsponsor');
        $data= $this->models->getDataConditionated2('sponsor',['idsponsor','label','cout'],['idsponsor'],[$idsponsor]);
        $user['datas']= $data;
        $this->load->view('Back-Office/templates/template-form-update-sponsor', $user); 

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
        $idsponsor=$this->input->get('idsponsor');
        $data=$this->models->getData('sponsor',['label','cout']);
        $user['datas']=$data;
        $label= $this->input->post('label');
        $cout= $this->input->post('cout');
        $update= $this->models->update('sponsor',['label','cout'],[$label,$cout],['idsponsor'],[$idsponsor]);
        //$this->session->set_flashdata('success', 'réussi');
        $this->load->view('Back-Office/templates/template', $user);    
    }

}