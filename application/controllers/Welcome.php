<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->database();
        $this->load->helper('url');

        $this->load->library('grocery_CRUD');
    }

    public function output($output = null)
    {
        $this->load->view('welcome.php', (array)$output);
    }

    public function index()
    {
        $this->output((object)array('output' => '', 'js_files' => array(), 'css_files' => array()));
    }

    public function users()
    {
        try {
            $crud = new grocery_CRUD();

            $crud->set_theme('datatables');
            $crud->set_table('users');
            $crud->set_subject('User');

            $crud->columns('id', 'email', 'password');

            $crud->fields('email', 'password', 'verify_password');

            $crud->unique_fields(['email']);

            $crud->change_field_type('password', 'password');
            $crud->change_field_type('verify_password', 'password');

            $crud->callback_before_insert([$this, 'hash_password']);
            $crud->callback_before_update([$this, 'hash_password_update']);

            if ($crud->getState() == 'add') {
                $crud->required_fields('email', 'password', 'verify_password');

                $crud->set_rules('password', 'Password', 'trim|required|matches[verify_password]|min_length[8]');
                $crud->set_rules('verify_password', 'Password confirm', 'trim|required');
            }

            if ($crud->getState() === 'update') {
                $crud->required_fields('email');
                $crud->set_rules('password', 'Password', 'trim|matches[verify_password]|min_length[8]');
                $crud->set_rules('verify_password', 'Password confirm', 'trim');
            }

            $crud->callback_edit_field('password', [$this, 'set_password_input_to_empty']);
            $crud->callback_add_field('password', [$this, 'set_password_input_to_empty']);

            $output = $crud->render();

            $this->output($output);

        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

    public function hash_password($data)
    {
        unset($data['verify_password']);
        $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);

        return $data;
    }

    public function hash_password_update($data)
    {
        if (empty($data['password'])) {
            unset($data['password'], $data['verify_password']);
        } else {
            return $this->hash_password($data);
        }

        return $data;
    }

    function set_password_input_to_empty(): string
    {
        return "<input type='password' name='password' value='' />";
    }
}
