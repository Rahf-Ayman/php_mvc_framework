<?php

use app\core\form\Form;

$this->title = "Login";
?>
<h1>Login</h1>

<?php $form = Form::begin('', "post") ?>

<?php echo $form->field($model, 'email')->emailField() ?>
<?php echo $form->field($model, 'password')->passwordField() ?>


<div class="col-12">
    <button type="submit" class="btn btn-primary">login</button>
</div>
<?php $form = Form::end() ?>