<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\EmployeesDepartments */

$this->title = 'Create Employees Departments';
$this->params['breadcrumbs'][] = ['label' => 'Employees Departments', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="employees-departments-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
