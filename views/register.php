<h1>Register</h1>
<?php $form = \app\core\form\Form::begin('' , "post") ?>

<div class="row">
    <div class="col">
        <?php echo $form->field($model , 'firstName') ?>
    </div>

    <div class="col">
        <?php echo $form->field($model , 'lastName') ?>
    </div>
</div>
<?php echo $form->field($model , 'email')->emailField() ?>
<?php echo $form->field($model , 'password')->passwordField()?>
<?php echo $form->field($model , 'confirmPassword')->passwordField()?>

<div class="col-12">
    <button type="submit" class="btn btn-primary">Sign up</button>
</div>
<?php $form = \app\core\form\Form::end() ?>
<!-- <form class="row g-3" method="post" >
    
    <div class="form-group">
        <label  class="form-label">FirstName</label>
        <input type="text"  name="firstName" value = "<?php // echo  $model->firstName ?>"
            class="form-control <?php // echo $model->hasError('firstName') ? ' is-invalid' : '' ?>" >
        <div class="invalid-feedback">
            <?php //echo  $model->getFirstError('firstName') ?>
        </div>
    </div>
    <div class="col-md-6">
        <label for="inputEmail4" class="form-label">LastName</label>
        <input type="text" class="form-control" name="lastName" >
    </div>
    <div class="col-12">
        <label for="inputEmail4" class="form-label">Email</label>
        <input type="email" class="form-control" name="email">

        <label for="inputPassword4" class="form-label">Password</label>
        <input type="password" class="form-control" name="password">

        <label for="inputPassword4" class="form-label">Confirm Password</label>
        <input type="password" class="form-control" name="confirmPassword">
    </div>
    <div class="col-12">
        <button type="submit" class="btn btn-primary">Sign up</button>
    </div>
</form> -->