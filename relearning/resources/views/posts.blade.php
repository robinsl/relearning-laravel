<h1>Posts</h1>

<?php foreach($posts as $post) : ?>
    <article>
        <h2><a href="/posts/<?= $post->slug ?>"><?= $post->title ?></a></h2>
        <h2><?= $post->date ?></h2>
        <p><?= $post->excerpt ?></p>
    </article>
<?php endforeach; ?>
