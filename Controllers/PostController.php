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
        return $this->render();
    }

    public function action_index()
    {
        return $this->render('views/post/view.php');
    }

    public function action_view($params)
    {
        return $this->render();
    }
}
