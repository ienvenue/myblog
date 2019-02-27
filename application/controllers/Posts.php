<?php

use http\Env\Request;

class Posts extends CI_Controller{
    public function index(){

        $data= $this->Post_model->show();
        //var_dump($data);
        if(empty($data)){
            show_404();
        }
//        $data2=array_column($data,'name');
        $count=$this->Post_model->count();
        $data2['name']=$data[$count-1]['name'];
        $data2['words']=$data[$count-1]['words'];
        //var_dump($data2);
        $this->load->view('posts/index',$data2);
    }

    public function store()
    {
        $data=($this->Post_model->store());
        redirect('http://myblog.com/posts');
    }

}