<?php
defined('BASEPATH') or exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class LoginController extends RestController
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

        if (!$this->form_validation->run('user_login')) {
            $this->create_response($this->form_validation->get_errors(), RestController::HTTP_BAD_REQUEST);
        } else {
            $user =  $this->user_model->find_by_email($data);
            if (is_null($user)) {
                $this->wrong_login();
            }

            if (!password_verify($data['password'], $user->password)) {
                $this->wrong_login();
            }

            unset($user->password);

            $this->create_response([
                'message' => 'Login successfully',
                'user' => $user
            ]);
        }
    }

    public function wrong_login()
    {
        $this->create_response([
            'message' => 'Incorrect email or password.'
        ], 401);
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