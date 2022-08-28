<?php
defined('BASEPATH') or exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class UserController extends RestController
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->library('form_validation');
    }

    public function index_post()
    {
        $data = $this->post();
        $this->form_validation->set_data($data);

        if (!$this->form_validation->run('user_store')) {
            $this->create_response($this->form_validation->get_errors(), RestController::HTTP_BAD_REQUEST);
        } else {
            $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
            $user = $this->user_model->create($data);
            $this->create_response(['user' => $user]);
        }
    }

    private function create_response($payload, $code = RestController::HTTP_OK)
    {
        $this->response([
                'payload' => $payload,
                'code' => $code
            ], $code
        );
    }
}