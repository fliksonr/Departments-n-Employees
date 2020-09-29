<?php

namespace frontend\controllers;

use Yii;
use app\models\Employee;
use app\models\Department;
use app\models\EmployeesDepartments;
use app\models\DepartmentsList;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * EmployeeController implements the CRUD actions for Employee model.
 */
class EmployeeController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Employee models.
     * @return mixed
     */
    public function actionIndex()
    {
        $model = new Employee();
        $model_departments = new DepartmentsList();
        // получаем все отделы
        $departments = Department::find()->all();
        // формируем массив, с ключем равным полю 'id' и значением равным полю 'name'
        $items = ArrayHelper::map($departments,'id','name');


        $dataProvider = new ActiveDataProvider([
            'query' => Employee::find()->with('employeesDepartments'),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'md_worker' => $model,
            'md_all_departments' => $model_departments,
            'items' => $items,
        ]);
    }

    /**
     * Displays a single Employee model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Employee model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Employee();
        $model_departments = new DepartmentsList();
        $departments = Department::find()->all();
        $items = ArrayHelper::map($departments,'id','name');


            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                $employee_id = $model->id;
                if ($model_departments->load(Yii::$app->request->post())) {
                    foreach ($model_departments->departments as $key => $value) {
                        $model_relation = new EmployeesDepartments();
                        $model_relation->employee_id = $employee_id;
                        $model_relation->department_id = $value;
                        $model_relation->save();
                    }
                    return $this->render('view', [
                        'model' => $this->findModel($employee_id),
                    ]);
                } else {
                    return false;
                }
            } else {
                return $this->render('create', [
                    'model' => $model,
                    'model_departments' => $model_departments,
                    'items' => $items,
                ]);
            }
        }

    /**
     * Updates an existing Employee model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = new Employee();
        $model_departments = new DepartmentsList();

        $departments = Department::find()->all();
        // формируем массив, с ключем равным полю 'id' и значением равным полю 'name'
        $items = ArrayHelper::map($departments,'id','name');

        $model = $this->findModel($id);

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                if ($model_departments->load(Yii::$app->request->post())) {
                    EmployeesDepartments::deleteAll([
                        'employee_id' => $id,
                    ]);
                    foreach ($model_departments->departments as $key => $value){
                        $model_relation = new EmployeesDepartments();
                        $model_relation->employee_id =$id;
                        $model_relation->department_id = $value;
                        $model_relation->save();
                    }
                    return $this->render('view', [
                        'model' => $this->findModel($id),
                    ]);
                } else {
                    return false;
                }
            } else {
                return $this->render('update', [
                    'model' => $model,
                    'model_departments' => $model_departments,
                    'items' => $items,
                ]);
            }
    }

    /**
     * Deletes an existing Employee model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Employee model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Employee the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Employee::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
