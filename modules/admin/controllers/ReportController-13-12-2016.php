<?php

namespace app\modules\admin\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use app\models\Classes;
use app\models\Subclass;
use app\models\Division;
use yii\db\Query;
use app\models\Mark;

/**
 * Controller to display all reports
 */

Class ReportController extends Controller {
    
    public $layout = "//listing";

    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index'],
                'rules' => [
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                    return true;
                },
                    ],
                    [
                        'actions' => ['login', 'logout', 'forgotpassword'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                ],
                'denyCallback' => function () {
            return Yii::$app->response->redirect(['admin/default/login']);
        },
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                //'delete' => ['post'],
                ],
            ],
        ];
    }
    
    public function actionClassResult()
    {
        $model = new \yii\base\DynamicModel([
            'year', 'class', 'subclass', 'division'
        ]);
        $model->addRule(['year','class'], 'required');
        
        $yearList = [];
        for ($i = 1430; $i <= 1600; $i++) {
            $yearList[$i] = $i;
        }
        $classList = ArrayHelper::map(Classes::findAll(['is_deleted' => 'N', 'is_active' => 'Y']), 'id', 'name');
        $subclassList = ArrayHelper::map(Subclass::findAll(['is_deleted' => 'N', 'is_active' => 'Y']), 'id', 'sub_class');
        $divisionList = ArrayHelper::map(Division::findAll(['is_deleted' => 'N', 'is_active' => 'Y']), 'id', 'division');
        
        
        return $this->render('class-result', [
            'model' => $model,
            'yearList' => $yearList,
            'classList' => $classList,
            'subclassList' => $subclassList,
            'divisionList' => $divisionList,
        ]);
    }

    public function actionClassResultReport()
    {
        $postdata = Yii::$app->request->post();

        $year = $postdata['year'];
        $class = $postdata['class'];
        $subclass = $postdata['subclass'];
        $division = $postdata['division'];
    
        $query = new Query();
        $query->select(['sm.id', "CONCAT(`sm`.`surname_en`,' ',`sm`.`firstname_en`,' ',`sm`.`lastname_en`) AS fullname", 'grno'])
            ->from('student_master sm')
            ->where(['class_id' => $class, 'sub_class_id' => $subclass]);
        if(isset($division) && $division!='') {
            $query->andWhere(['division_id' => $division]);
        }    

        $det = $query->createCommand()->queryAll();
        

        $query2 = new Query();
        $query2->select(['id', 'name_en'])
            ->from('subject_master')
            ->where(['class_id' => $class, 'subclass_id' => $subclass]);
        $det2 = $query2->createCommand()->queryAll();
        $i=0;
        foreach ($det as $student) {
            $j=0;
            foreach ($det2 as $subject) {
                $mark = Mark::findOne(['class_id' => $class, 'subclass_id' => $subclass, 'year' => $year, 'subject_id' => $subject['id']]);

                $det[$i]['subject'][$subject['id']] = (isset($mark->marks) && $mark->marks != '') ? $mark->marks : '';
            $j++;    
            }
            $i++;
        }
        
        return $this->renderPartial('class-result-report', [
                'data' => $det,
                'subjects' => $det2,
            ]);
    }
}