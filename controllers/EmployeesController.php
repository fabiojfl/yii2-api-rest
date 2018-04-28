<?php

namespace app\controllers;

use app\models\EmployeeProvider;
use Yii;
use yii\rest\ActiveController;
use yii\web\ForbiddenHttpException;
use yii\web\Response;

class EmployeesController extends ActiveController
{
    public $modelClass = "app\models\Employee";

    public $serializer = [
        'class' => 'yii\rest\Serializer',
        'collectionEnvelope' => 'data',
        'linksEnvelope' => 'links_legais',
        'metaEnvelope' => "meta_legal"
    ];

    public function actions()
    {
        $actions = parent::actions();
        unset($actions['delete']);

        $actions['index']['prepareDataProvider'] = [$this, 'carregaDataProvider'];

        return $actions;
    }

    public function behaviors()
    {
        $b = parent::behaviors();
        $b['contentNegotiator']['formats']['text/html'] = Response::FORMAT_HTML;
        return $b;
    }

    public function actionListar()
    {
        return [
            'teste' => 'teste'
        ];
    }

    public function carregaDataProvider()
    {
        $params = Yii::$app->request->queryParams;
        $provider = new EmployeeProvider();
        return $provider->search($params);
    }

    public function checkAccess($action, $model = null, $params = [])
    {
        if($action == 'view') {
            if($model->id == 2) {
                throw new ForbiddenHttpException("Voce naõ pode acessar esse registro");
            }
        }
    }

}