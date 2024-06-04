<?php

namespace Core;

class Controller
{
    protected Template $template;
    protected $error_massages;
    public $is_post = false;
    public $is_get = false;
    public $post;
    public $get;

    public function __construct()
    {
        $action = Core::get()->action_name;
        $module = Core::get()->module_name;
        $path = "Views/$module/$action.php";
        $this->template = new Template($path);
        switch ($_SERVER['REQUEST_METHOD']) {
            case 'POST':
                $this->is_post = true;
                break;
            case 'GET':
                $this->is_get = true;
                break;
        }
        $this->post = new Post();
        $this->get = new Get();
        $this->error_massages = [];
    }

    public function render($path_to_view = null): array
    {
        if (!empty($path_to_view)) {
            $this->template->set_template_file_path($path_to_view);
        }
        return [
            'content' => $this->template->get_html(),
        ];
    }

    public function redirect($path): void
    {
        header("Location: $path");
        die;
    }

    public function add_error_message($message = null): void
    {
        $this->error_massages[] = $message;
        $this->template->set_param('error_massage', implode('<br/>', $this->error_massages));
    }

    public function clear_error_message(): void
    {
        $this->$this->error_massages = [];
        $this->template->set_param('error_massage', null);
    }

    public function is_error_massage_exist(): bool
    {
        return count($this->error_massages) > 0;
    }
}
