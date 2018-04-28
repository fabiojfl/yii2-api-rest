<?php

namespace app\controllers;

use app\models\JobTitle;
use yii\rest\ActiveController;
use yii\web\Response;

class JobTitleController extends ActiveController
{
    public $modelClass = "app\models\JobTitle";

    public function actionListar()
    {
        \Yii::$app->response->format = Response::FORMAT_JSON;

        $jobsTitles = JobTitle::find()->all();

        return $jobsTitles;
    }
}
