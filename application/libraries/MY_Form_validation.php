<?php

class MY_Form_validation extends CI_Form_validation
{
    function __construct($rules = array())
    {
        parent::__construct($rules);
        $this->CI =& get_instance();
    }

    public function get_rules()
    {
        return $this->_config_rules;
    }

    public function get_errors()
    {
        return $this->_error_array;
    }

    public function get_fields($form_data)
    {
        $field_name = array();

        $rules = $this->get_rules();
        $rules = $rules[$form_data];

        foreach ($rules as $info) {
            $field_name[] = $info['field'];
        }

        return $field_name;
    }
}



