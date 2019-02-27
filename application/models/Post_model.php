<?php
	class Post_model extends CI_Model{
		public function __construct()
        {

        }

        public function show()
        {
            $this->load->library('mongo_db');
            $query=$this->mongo_db->get('users');
            return $query;
        }
        public function count()
        {
            $this->load->library('mongo_db');
            $count=$this->mongo_db->count('users');
            return $count;
        }

        public function store()
        {
            //var_dump($_POST);
            $this->load->library('mongo_db');
            $this->mongo_db->insert('users',array('name'=>$_POST['name'],'words'=>$_POST['words']));
        }
    }