<?php
    use Sksamassa\MyFramework\src\form\Form;
    use Sksamassa\MyFramework\src\form\TextAreaField;

    $this -> title = 'Contact';
?>

<h1>Contact us</h1>

<?php $form = Form::begin('', 'post') ?>
  <?php echo $form -> field($model, 'subject') ?>
  <?php echo new TextAreaField($model, 'body') ?>
  <?php echo $form -> field($model, 'email') ?>
  <button type="submit" class="btn btn-primary">Submit</button>
<?php Form::end() ?>