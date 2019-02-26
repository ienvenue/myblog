<?php

use http\Env\Request;

class Posts extends CI_Controller{
    public function index($offset = 0){
        $this->load->view('posts/index');
    }
    public function store()
    {
        $data['post']=$this->Post_model->show();
        $this->load->view('posts/index',$data);
    }

    public function view($slug = NULL){
        $data['post'] = $this->post_model->get_posts($slug);
        $post_id = $data['post']['id'];
        $data['comments'] = $this->comment_model->get_comments($post_id);

        if(empty($data['post'])){
            show_404();
        }

        $data['title'] = $data['post']['title'];
        $this->load->view('templates/header');
        $this->load->view('posts/view', $data);
        $this->load->view('templates/footer');
    }



    public function delete($id){
        // Check login
        if(!$this->session->userdata('logged_in')){
            redirect('users/login');
        }

        $this->post_model->delete_post($id);

        // Set message
        $this->session->set_flashdata('post_deleted', 'Your post has been deleted');

        redirect('posts');
    }

    public function edit($slug){
        // Check login
        if(!$this->session->userdata('logged_in')){
            redirect('users/login');
        }

        $data['post'] = $this->post_model->get_posts($slug);

        // Check user
        if($this->session->userdata('user_id') != $this->post_model->get_posts($slug)['user_id']){
            redirect('posts');

        }

        $data['categories'] = $this->post_model->get_categories();

        if(empty($data['post'])){
            show_404();
        }

        $data['title'] = 'Edit Post';

        $this->load->view('templates/header');
        $this->load->view('posts/edit', $data);
        $this->load->view('templates/footer');
    }

    public function update(){
        // Check login
        if(!$this->session->userdata('logged_in')){
            redirect('users/login');
        }

        $this->post_model->update_post();

        // Set message
        $this->session->set_flashdata('post_updated', 'Your post has been updated');

        redirect('posts');
    }
}