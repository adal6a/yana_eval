<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_Activity_model extends CI_Model
{
    protected $table = 'user_activities';

    public $id;
    public $uid;
    public $message_text;
    public $message_from;
    public $datetime;
    public $timestamp;

    function __construct()
    {
        parent::__construct();
    }

    public function find_by_user($data)
    {
        $this->db->select("{$this->table}.id, {$this->table}.message_from, {$this->table}.message_text, {$this->table}.timestamp");
        $this->db->from($this->table);
        $this->db->join('users', "{$this->table}.uid = users.id");
        $this->db->where("{$this->table}.uid", $data['uid']);
        return $this->db->get()->result();
    }
}