<?php use app\core\Application; ?>
<h1>Hello World</h1>
<?php if (Application::isGuest()): ?>
<h1>Welcome Guest</h1>
<?php else: ?>
<h1>Welcome <?php echo Application::$app->user->getDisplayName() ?></h1>
<?php endif; ?>