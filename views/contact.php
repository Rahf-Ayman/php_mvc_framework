<?php
use app\core\form\Form;

$this->title = "Contanct us";
?>

<h1>Contanct us</h1>

<?php  Form::begin('' , "post")?>
<div class="mb-3">
        <?php  echo Form::field($model, 'subject') ?>
</div>
<div class="mb-3">
        <?php echo Form::field($model, 'email')->emailField() ?>
</div>
<div class="mb-3">
        <?php echo Form::field($model, 'body') ?>
</div>
<button type="submit" class="btn btn-primary">Submit</button>
<?php Form::end() ?>

<!-- <form action="" method="post">
    <div class="mb-3">
        <label class="form-label">Subject</label>
        <input type="text" class="form-control" name="subject" aria-describedby="emailHelp">
        <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
    </div>
    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Email</label>
        <input type="email" class="form-control" name="email">
    </div>
    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">body</label>
        <input type="text" class="form-control" name="body">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form> -->