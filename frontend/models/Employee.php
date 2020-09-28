<?php

namespace app\models;

use phpDocumentor\Reflection\Types\This;
use Yii;

/**
 * This is the model class for table "employee".
 *
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property string|null $middle_name
 * @property string|null $gender
 * @property int $salary
 *
 * @property EmployeesDepartments[] $employeesDepartments
 */
class Employee extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'employee';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['first_name', 'last_name', 'salary'], 'required'],
            [['salary'], 'integer'],
            [['first_name', 'last_name', 'middle_name', 'gender'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        

        return [
            'id' => 'ID',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'middle_name' => 'Middle Name',
            'gender' => 'Gender',
            'salary' => 'Salary',
        ];
    }

    /**
     * Gets query for [[EmployeesDepartments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEmployeesDepartments()
    {
        return $this->hasMany(EmployeesDepartments::className(), ['employee_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDepartments()
    {
        return $this->hasMany(Department::className(),['id' => 'department_id'])
            ->viaTable('employees_departments', ['employee_id' => 'id']);
    }
}
