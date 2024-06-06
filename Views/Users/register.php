<?php

/** @var string $error_massage Повідомлення про помилку */
$this->title = "Реєстрація користувача";
?>
<div class="container">
    <form method="post" action="">
    <div class="form-text text-info text-end">* Обов'язкові поля</div>
        <?php if (!empty($error_massage)) : ?>
            <div class="alert alert-danger" role="alert">
                <?= $error_massage ?>
            </div>
        <?php endif ?>
        <div class="mb-3">
            <label for="inputEmail" class="form-label">Логін / Пошта *</label>
            <input value="<?= $this->controller->post->login ?>" name="login" type="email" class="form-control" id="inputEmail" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
            <label for="inputPassword1" class="form-label">Пароль *</label>
            <input name="password" type="password" class="form-control" id="inputPassword1">
        </div>
        <div class="mb-3">
            <label for="inputPassword2" class="form-label">Підтвердіть пароль *</label>
            <input name="password2" type="password" class="form-control" id="inputPassword2">
        </div>
        <div class="mb-3">
            <label for="inputLastname" class="form-label">Прізвище *</label>
            <input value="<?= $this->controller->post->lastname ?>" name="lastname" type="text" class="form-control" id="inputLastname">
        </div>
        <div class="mb-5">
            <label for="inputFirstname" class="form-label">Ім'я *</label>
            <input value="<?= $this->controller->post->firstname ?>" name="firstname" type="text" class="form-control" id="inputFirstname">
        </div>
        <div class="d-flex justify-content-center"><button type="submit" class="btn btn-primary px-3 mx-3">Register</button></div>
        <div class="d-flex justify-content-center m-4 mb-0">Already have an account?</div>
        <div class="d-flex justify-content-center"> <a class="link-underline-primary" href="/users/login">Login</a></div>
    </form>
</div>