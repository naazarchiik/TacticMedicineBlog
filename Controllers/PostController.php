<?php

namespace Controllers;

use Core\Template;

class PostController
{
    public function action_add(){
        $template = new Template('views/post/add.php');
        return [
            'content' => $template -> get_html(),
            'title' => 'Додавання посту до блогу'
        ];
    }

    public function action_index(){
        return [
            'content' => 'index Action',
            'title' => 'Список постів'
        ];
    }

    public function action_view($params){
        return [
            'content' => 'view Action',
            'title' => 'Перегляд поста'
        ];
    }
}