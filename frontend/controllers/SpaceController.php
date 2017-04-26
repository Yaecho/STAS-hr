<?php
namespace frontend\controllers;

use frontend\controllers\base\BaseController;

class SpaceController extends BaseController
{
    public function actionIndex(){
        return $this->render('index');
    }
}