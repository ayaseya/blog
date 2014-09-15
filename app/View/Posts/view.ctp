<!-- File: /app/View/Posts/view.ctp -->

<h2><?php
echo h($post['Post']['title']);
?>
</h2>
<p>
<?php
echo h($post['Post']['body']);
?>
</p>