<?php

use McQueen\phpmvc\form\Form;
use McQueen\phpmvc\form\TextareaField;

$this->title = "Contanct us";
?>

<h1>Contanct us</h1>

<?php Form::begin('', "post") ?>
<div class="mb-3">
    <?php echo Form::field($model, 'subject') ?>
</div>
<div class="mb-3">
    <?php echo Form::field($model, 'email')->emailField() ?>
</div>
<div class="mb-3">
    <?php echo new TextareaField($model, 'body'); ?>
</div>
<button type="submit" class="btn btn-primary">Submit</button>
<?php Form::end() ?>