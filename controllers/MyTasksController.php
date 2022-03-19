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
use yii\web\Controller;
use app\controllers\AppController;
use yii\db\Expression;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;
use yii\helpers\ArrayHelper;



class MyTasksController extends SecuredController 
{
   public function actionIndex() 
   {
      $currentUserId = \Yii::$app->user->id;
      $status = \Yii::$app->request->get('status');

      $query = Task::find()->where(['or', "user_id={$currentUserId}", "executor_id={$currentUserId}"]);
      
      if ($status === null || $status === 'new') {
         $query->andWhere(['task_status' => 'new'])->andWhere(['user_id' => $currentUserId]);
      }
  
      if ($status === 'during') {
         $query->andWhere(['task_status' => 'working']);
     }
      
      if ($status ==='closed') {
         $query->andWhere(['task_status' => 'done'])
         ->orWhere(['task_status' => 'canceled'])
         ->orWhere(['task_status' => 'failed'])
         ->andWhere(['or', "user_id={$currentUserId}", "executor_id={$currentUserId}"]);
         
      }

      if ($status === 'overdue') {
         $query->andWhere(['task_status' => 'working'])->andWhere(['<=', 'period_execution', (new Expression("NOW()"))]);
     }

      $myTasks = $query->all();

      return $this->render('index', ['status' => $status, 'myTasks' => $myTasks]);
   }
}