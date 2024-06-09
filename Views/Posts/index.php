<?php
$this->title = 'Список постів';

use Models\Posts;
use Models\Users;

$posts = Posts::find_all_posts();
?>

<div class="container">
    <div class="row justify-content-center">
        <?php foreach ($posts as $post) : ?>
            <?php if (!Users::is_admin() && !Users::is_publisher() && $post->visibility == 0) 
                continue;  
            ?>    
            <div class="col-6 col-md-5 col-lg-4 col-xl-3 mb-4">
                <div class="card h-100">

                    <a href="/posts/view/<?= $post->id ?>">
                        <img src="/Uploads/Category/default.jpeg" class="card-img-top" alt="Category_Photo" height="255" width="auto">
                    </a>

                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title"><?= $post->title ?></h5>
                        <?php if ($post->short_text != null) : ?>
                            <p class="card-text"><?= $post->short_text ?></p>
                        <?php else : ?>
                            <p>&nbsp;</p>
                        <?php endif; ?>
                        <a href="/posts/view/<?= $post->id ?>" class="btn btn-primary mt-auto">Перейти до посту</a>
                        <?php if (Users::is_admin()) : ?>
                            <div class="row justify-content-center">
                                <a href="/posts/edit/<?= $post->id ?>" class="card-link mx-0 ">Редагувати пост</a>
                                <a href="/posts/delete/<?= $post->id ?>" class="card-link link-danger mx-0 ">Видалити пост</a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
        