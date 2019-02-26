<?php
	class Post_model extends CI_Model{
		public function __construct()
        {

        }

        public function show()
        {
            $this->load->library('mongo_db');
            $query=$this->mongo_db->get('name');
            return $query;
        }
    }