<h1>Register page</h1>
<?php $form = \app\core\form\Form::begin('', 'post'); ?>
    <div class="row">
        <div class="col">
            <?= $form->field($model, 'firstname'); ?>
        </div>
        <div class="col">
            <?= $form->field($model, 'lastname'); ?>
        </div>
    </div>
    <?= $form->field($model, 'email'); ?>
    <?= $form->field($model, 'password'); ?>
    <?= $form->field($model, 'passwordConfirm'); ?>
    <button type="submit" class="btn btn-primary">Submit</button>
<?php \app\core\form\Form::end(); ?>