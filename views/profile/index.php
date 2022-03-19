<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use Taskforce\logic\Task;
use app\controllers\AppController; 
use app\models\Category;  
$this->title = 'Настройки профиля';

?>

<main class="main-content main-content--left container">
    <div class="left-menu left-menu--edit">
        <h3 class="head-main head-task">Настройки</h3>
        <ul class="side-menu-list">
            <li class="side-menu-item side-menu-item--active">
                <a class="link link--nav">Мой профиль</a>
            </li>
            <li class="side-menu-item">
                <a href="#" class="link link--nav">Безопасность</a>
            </li>
            <li class="side-menu-item">
                <a href="#" class="link link--nav">Уведомления</a>
            </li>
        </ul>
    </div>
    <div class="my-profile-form">
    <?php $form = ActiveForm::begin(['id' => 'profile-form']) ?>
            <h3 class="head-main head-regular">Мой профиль</h3>
            <div class="photo-editing">
                <div>
                    <p class="form-label">Аватар</p>
                    <img class="avatar-preview" src="/img/man-glasses.png" width="83" height="83">
                </div>
                <input hidden value="Сменить аватар" type="file" id="button-input">
                <label for="button-input" class="button button--black"> Сменить аватар</label>
            </div>
            <div class="form-group">
                <?= $form->field($user, 'user_name')->label('Ваше имя', ['class' => 'control-label']); ?>
                <span class="help-block">Error description is here</span>
            </div>
            <div class="half-wrapper">
                <div class="form-group">
                    <?= $form->field($user, 'email')->input('email')->label('Email', ['class' => 'control-label']); ?>
                    <span class="help-block">Error description is here</span>
                </div>
                <div class="form-group">
                <?= $form->field($model, 'birthday')->input('date')->label('День рождения', ['class' => 'control-label']); ?>
                    <span class="help-block">Error description is here</span>
                </div>
            </div>
            <div class="half-wrapper">
                <div class="form-group">
                <?= $form->field($model, 'phone')->input('tel')->label('Номер телефона', ['class' => 'control-label']); ?>
                    <span class="help-block">Error description is here</span>
                </div>
                <div class="form-group">
                <?= $form->field($model, 'telegram')->label('Telegram', ['class' => 'control-label']); ?>
                    <span class="help-block">Error description is here</span>
                </div>
            </div>
            <div class="form-group">
            <?= $form->field($model, 'profile_info')->textarea()->label('Информация о себе', ['class' => 'control-label']); ?>
                <span class="help-block">Error description is here</span>
            </div>
            <div class="form-group">
                <p class="form-label">Выбор специализаций</p>
                <div class="checkbox-profile">
                    <!--<label class="control-label" for="сourier-services">
                        <input type="checkbox" id="сourier-services" checked>
                        Курьерские услуги</label>
                    <label class="control-label" for="cargo-transportation">
                        <input id="cargo-transportation" type="checkbox">
                        Грузоперевозки</label>
                    <label class="control-label" for="cleaning">
                        <input id="cleaning" type="checkbox">
                        Клининг</label>
                    <label class="control-label" for="computer-help">
                        <input id="computer-help" type="checkbox" checked>
                        Компьютерная помощь</label>-->
                        <?= $form->field($model, 'specializations[]', ['options' => ['tag' => false]])->label(false)->checkboxList(Category::getCategoryMap(), $options = ['class' => 'control-label checkbox-profile'], $enclosedByLabel = false) ?> 
                        <?php foreach ($categories as $category): ?>
                       <?= $form->field($model, 'specializations', ['options' => ['tag' => false]])->checkbox($options = ['value' => $category->id], $enclosedByLabel = false)->label($category->name, ['class' => 'control-label']) ?>
                       <?php endforeach; ?>
                </div>
            </div>
            <input type="submit" class="button button--blue" value="Сохранить">
            <?php ActiveForm::end() ?>
    </div>
</main>