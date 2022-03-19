<?php
use yii\helpers\Html;
use yii\helpers\Url;
   
$this->title = 'Мои задания';

?>

<main class="main-content container">
    <div class="left-menu">
        <h3 class="head-main head-task">Мои задания</h3>
        <ul class="side-menu-list">
        <?php if (Yii::$app->user->identity->role_id === 0): ?>
            <li class="side-menu-item <?= ($status === 'new' || !isset($status)) ? 'side-menu-item--active' : ''; ?>">
                <a href="<?= Url::to(['my-tasks/index/', 'status' => 'new']); ?>" class="link link--nav">Новые</a>
            </li>
         <?php endif; ?>   
            <li class="side-menu-item <?= ($status === 'during') ? 'side-menu-item--active' : ''; ?>">
                <a href="<?= Url::to(['my-tasks/index/', 'status' => 'during']); ?>" class="link link--nav">В процессе</a>
            </li>
            <?php if (Yii::$app->user->identity->role_id === 1): ?>
            <li class="side-menu-item <?= ($status === 'overdue') ? 'side-menu-item--active' : ''; ?>">
                <a href="<?= Url::to(['my-tasks/index/', 'status' => 'overdue']); ?>" class="link link--nav">Просрочено</a>
            </li>
            <?php endif; ?>
            <li class="side-menu-item <?= ($status === 'closed') ? 'side-menu-item--active' : ''; ?>">
                <a href="<?= Url::to(['my-tasks/index/', 'status' => 'closed']); ?>" class="link link--nav">Закрытые</a>
            </li>
        </ul>
    </div>
    <div class="left-column left-column--task">
        <!--<h3 class="head-main head-regular">Новые задания</h3>-->
        <?php if (count($myTasks) > 0): ?>
         <?php foreach ($myTasks as $task): ?>
         <div class="task-card">
            <div class="header-task">
               <a  href="<?= Url::to(['tasks/view', 'id' => $task->id]) ?>" class="link link--block link--big">
                  <?= Html::encode($task->title) ?>
               </a>
               <p class="price price--task"><?= Html::encode($task->budget) ?> ₽</p>
            </div>
            <p class="info-text">
               <span class="current-time">
               <?= Yii::$app->formatter->asRelativeTime($task->date_creation); ?>
               </span>
            </p>
            <p class="task-text">
               <?= Html::encode($task->task_description) ?>
            </p>
            <div class="footer-task">
               <p class="info-text town-text">
               <?php if ($task->task_location): ?>
                   <?= Html::encode($task->task_location) ?>
               <?php else: ?>
                  Удаленная работа    
               <?php endif; ?>    
               </p>
                <p class="info-text category-text"><?= Html::encode($task->category->name) ?></p>
                <a href="<?= Url::to(['tasks/view', 'id' => $task->id]) ?>" class="button button--black">Смотреть Задание</a>
            </div>
        </div>
        <?php endforeach; ?>
        <?php endif; ?>
        
        
    </div>
</main>