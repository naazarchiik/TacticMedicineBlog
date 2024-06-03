<?php

namespace Controllers;

use Core\Controller;
use Models\Users;
use Core\Core;

class UsersController extends Controller
{
    public function action_index()
    {
        echo 'UsersController -> action_index()';
    }

    public function action_login()
    {
        if (Users::is_user_logged()) {
            return $this->redirect('/');
        }

        if ($this->is_post) {
            $user = Users::find_by_login_password($this->post->login, $this->post->password);
            if (!empty($user)) {
                Users::login_user($user);
                return $this->redirect('/');
            } else {
                $this->add_error_massege('Невірний логін та/або пароль');
            }
        }
        return $this->render();
    }

    public function action_register()
    {
        if ($this->is_post) {
            $user = Users::find_by_login($this->post->login);
            if (!empty($user)) {
                $this->add_error_massege('Користувач з таким логіном вже існує');
            }

            $firstname = $this->post->firstname;
            $lastname = $this->post->lastname;

            if (strlen($this->post->login) === 0) {
                $this->add_error_massege('Введіть логін');
            }
            if (strlen($this->post->password) === 0) {
                $this->add_error_massege('Введіть пароль');
            }
            if ($this->post->password != $this->post->password2) {
                $this->add_error_massege('Паролі не співпадають');
            }
            if (strlen($firstname) === 0) {
                $this->add_error_massege('Введіть ім\'я');
            }
            if (strlen($lastname) === 0) {
                $this->add_error_massege('Введіть прізвище');
            }
            if (!$this->is_error_massage_exist()) {
                Users::register_user(
                    $this->post->login,
                    $this->post->password,
                    $this->post->firstname,
                    $this->post->lastname
                );
                return $this->redirect('/users/registersuccess');
            }
        }

        return $this->render();
    }

    public function action_registersuccess()
    {
        return $this->render();
    }

    public function action_logout()
    {
        Users::logout_user();
        return $this->redirect('/users/login');
    }

    public function action_administration()
    {
        if (!Users::is_admin()) {
            return $this->redirect('/');
        }

        if ($this->is_post) {

            Users::update_user_permision(
                $this->post->user_id,
                $this->post->is_admin,
                $this->post->is_publisher
            );
        }

        return $this->render();
    }
}
