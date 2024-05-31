<?php

namespace Controllers;

use Core\Template;
use Core\Controller;
use Core\Core;
use Models\Post;

class PostController extends Controller
{
    public function action_add()
    {
        /*$this -> template -> set_template_file_path('views/post/add.php');
        return [
            'content' => $this -> template -> get_html(),
            'title' => 'Додавання посту до блогу'
        ];*/
        return $this->render();
    }

    public function action_index()
    {
        $db = Core::get()->db;

        /*$post = new Post();
        $post->id = 1;
        $post->title = 'New post';
        $post->text = 'New content';    
        $post->short_text = 'Short content';
        $post->save();*/

        //$rows = $db -> select('post', ['title'], ['id' => 1]);
        /*$db->insert('post', [
            'title' => 'New post', 
            'text' => 'New content',
            'short_text' => 'Short content',
        ]);*/
        //$db->delete('post', ['id' => 2]);
        /*$db->update('post', [
            'title' => 'Updated post'
        ],
        [
            'id' => 1
        ]);*/
        return $this->render();
    }

    public function action_view($params)
    {
        /*return [
            'content' => 'view Action',
            'title' => 'Перегляд поста'
        ];*/
        return $this->render();
    }
}
