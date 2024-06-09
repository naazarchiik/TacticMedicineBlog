<?php

namespace Controllers;

use Core\Controller;
use Models\Users;
use Core\Core;

class UsersController extends Controller
{
    public function action_index(): void
    {
        echo 'UsersController -> action_index()';
    }

    public function action_login(): ?array
    {
        if (Users::is_user_logged()) {
            return $this->redirect('/');
        }

        if ($this->is_post) {
            $user = Users::find_by_login_password($this->post->login, Users::hash_password($this->post->password));
            if (!empty($user)) {
                Users::login_user($user);
                return $this->redirect('/');
            } else {
                $this->add_error_message('Невірний логін та/або пароль');
            }
        }
        return $this->render();
    }

    public function action_register(): ?array
    {
        if ($this->is_post) {
            $user = Users::find_by_login($this->post->login);
            if (!empty($user)) {
                $this->add_error_message('Користувач з таким логіном вже існує');
            }

            $firstname = $this->post->firstname;
            $lastname = $this->post->lastname;

            if (strlen($this->post->login) === 0) {
                $this->add_error_message('Введіть логін');
            }
            if (strlen($this->post->password) === 0) {
                $this->add_error_message('Введіть пароль');
            }
            if ($this->post->password != $this->post->password2) {
                $this->add_error_message('Паролі не співпадають');
            }
            if (strlen($firstname) === 0) {
                $this->add_error_message('Введіть ім\'я');
            }
            if (strlen($lastname) === 0) {
                $this->add_error_message('Введіть прізвище');
            }
            if (!$this->is_error_massage_exist()) {
                Users::register_user(
                    $this->post->login,
                    Users::hash_password($this->post->password),
                    $this->post->firstname,
                    $this->post->lastname
                );
                return $this->redirect('/users/registersuccess');
            }
        }

        return $this->render();
    }

    public function action_registersuccess(): array
    {
        return $this->render();
    }

    public function action_logout(): void
    {
        Users::logout_user();
        $this->redirect('/users/login');
    }

    public function action_administration(): ?array
    {
        if (!Users::is_admin()) {
            return $this->redirect('/');
        }

        if ($this->is_post) {

            Users::update_user_permission(
                $this->post->user_id,
                $this->post->is_admin,
                $this->post->is_publisher
            );
        }

        return $this->render();
    }

    public function action_profile()
    {
        if (!Users::is_user_logged()) {
            return $this->redirect('/users/login');
        }
        if ($this->is_post) {
            if (strlen($this->post->login) === 0) {
                $this->add_error_message('Введіть логін');
            }
            if (strlen($this->post->firstname) === 0) {
                $this->add_error_message('Введіть ім\'я');
            }
            if (strlen($this->post->lastname) === 0) {
                $this->add_error_message('Введіть прізвище');
            }
            if (strlen($this->post->password) === 0) {
               $password = Core::get()->session->get('user')->password;
            }
            elseif ($this->post->password != $this->post->password2) {
                $this->add_error_message('Паролі не співпадають');
            }
            else {
                $password = Users::hash_password($this->post->password);
            }
            if (!$this->is_error_massage_exist()) {
                Users::update_user(
                    Core::get()->session->get('user')->id,
                    $this->post->login,
                    $password,
                    $this->post->firstname,
                    $this->post->lastname
                );
                return $this->redirect('/');
            }
        }
        return $this->render();
    }
}
