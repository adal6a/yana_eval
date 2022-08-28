<?php
defined('BASEPATH') or exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class UserActivityController extends RestController
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('user_activity_model');
        $this->load->library('form_validation');
    }

    public function index_post()
    {
        $data = $this->post();

        $this->form_validation->set_data($data);

        if (!$this->form_validation->run('user_activities')) {
            $this->create_response($this->form_validation->get_errors(), RestController::HTTP_BAD_REQUEST);
        } else {
            $activities = $this->user_activity_model->find_by_user($data);

            $data_response = [];

            foreach ($activities as $activity) {
                $data_response[] = [
                    'id' => $activity->id,
                    'messageFrom' => $activity->message_from,
                    'value' => $activity->message_text,
                    'timestamp' => $activity->timestamp,
                ];
            }

            $this->create_response($data_response);
        }
    }

    private function create_response($payload, $code = RestController::HTTP_OK)
    {
        $this->response([
            'code' => $code,
            'payload' => $payload
        ], $code);
    }
}