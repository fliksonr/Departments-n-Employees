<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\web\JsExpression;
use yii\bootstrap4\Modal;

/* @var $this yii\web\View */
/* @var $model app\models\Employee */
/* @var $items app\models\Employee */
/* @var $form yii\widgets\ActiveForm */
/* @var $model_departments */

?>

<div class="employee-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'middle_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'gender')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'salary')->textInput() ?>

<!--    <label>Departments</label>-->
        <?=
//         Select2::widget([
//            'name' => 'CLASSIC (Multiple)',
//            'model' => $model_departments,
//            'data' => $items,
//            'theme' => Select2::THEME_MATERIAL,
//            'options' => ['placeholder' => 'Select a state ...', 'multiple' => true, 'autocomplete' => 'off'],
//            'pluginOptions' => [
//                'allowClear' => true
//            ],
//        ]);
         $form->field($model_departments, 'departments')->widget(Select2::classname(), [
            'name' => 'CLASSIC (Multiple)',
            'data' => $items,
            'options' => ['placeholder' => 'Select a state ...','multiple'=>true],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);

        ?>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
