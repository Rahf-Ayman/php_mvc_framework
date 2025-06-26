<h1>Register</h1>
<?php $form = \McQueen\phpmvc\form\Form::begin('', "post") ?>

<div class="row">
    <div class="col">
        <?php echo $form->field($model, 'firstName') ?>
    </div>

    <div class="col">
        <?php echo $form->field($model, 'lastName') ?>
    </div>
</div>
<?php echo $form->field($model, 'email')->emailField() ?>
<?php echo $form->field($model, 'password')->passwordField() ?>
<?php echo $form->field($model, 'confirmPassword')->passwordField() ?>

<div class="col-12">
    <button type="submit" class="btn btn-primary">Sign up</button>
</div>
<?php $form = \McQueen\phpmvc\form\Form::end() ?>