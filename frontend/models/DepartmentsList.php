<?php


namespace app\models;
use yii\base\Model;


class DepartmentsList extends Model
{
    public $departments;

    public function rules()
    {
        return [
            [['departments'], 'required'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'departments' => 'Отделы',
        ];
    }

}