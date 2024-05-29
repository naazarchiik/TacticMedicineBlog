<?php

namespace Core;

class Template
{
    protected $template_file_path;
    protected $params_array;
    public function __construct($template_file_path){
        $this->template_file_path = $template_file_path;
        $this->params_array = [];
    }

    public function set_param($params_name, $params_value){
        $this->params_array[$params_name] = $params_value;
    }

    public function set_params($params_array){
        foreach($params_array as $key => $value){
            $this->set_param($key, $value);
        }
    }

    public function get_html(){
        ob_start();

        extract($this->params_array);
        include($this->template_file_path);
        $str = ob_get_contents();
        ob_end_clean();
        return $str;
    }

    public function dispaly(){
        echo $this->get_html();
    }
}