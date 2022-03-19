<?php

namespace app\controllers;

use Yii;
use app\models\Task;
use app\models\User;
use app\models\Category;
use app\models\TaskSearchForm;
use app\models\City;
use app\models\File;
use app\models\Response;
use app\models\Review;
use app\models\Executor;
use yii\web\Controller;
use app\controllers\AppController;
use yii\db\Expression;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\BadResponseException;
use yii\helpers\ArrayHelper;


class ProfileController extends SecuredController
{
   public function actionIndex() 
   {
      $id = \Yii::$app->user->identity->id;
      
      $user = User::findOne($id);
      $executor = Executor::find()->where("user_id={$id}")->one();
      if (isset($executor)) {
         $model = $executor;
      } else {
         $model = new Executor();
      }

      $categories = Category::find()->all();
      //echo AppController::debug($categories);
      //die;
      return $this->render('index', ['model' => $model, 'user' => $user, 'categories' => $categories]);
   }
} 