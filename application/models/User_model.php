<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
{
    protected $table = 'users';

    public $id;
    public $email;
    public $password;

    function __construct()
    {
        parent::__construct();
    }

    public function create($data)
    {
        $this->db->insert($this->table, $data);
        $this->db->select('id, email');
        return $this->db->get_where($this->table, [
            'id' => $this->db->insert_id()
        ])->row();
    }

    public function find_by_email($data)
    {
        $this->db->select('id, email, password');
        return $this->db->get_where($this->table, [
            'email' => $data['email']
        ])->row();
    }
}