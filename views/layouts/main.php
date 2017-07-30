<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\NavBar;
use kartik\alert\AlertBlock;
use yii\bootstrap\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<?php $project_id = \Yii::$app->getSession()->get('project_id'); ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => is_null($project_id) ? Yii::t('app', 'My Company') : Yii::t('app', 'My Company({project_name})', ['project_name' => \app\models\Project::find()->where(['id' => $project_id])->one()->name]),
        'brandUrl' => is_null($project_id) ? Yii::$app->homeUrl : \yii\helpers\Url::to(['project/view', 'id' => $project_id]),
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);

    $items = [
        ['label' => Yii::t('app', 'Home'), 'url' => ['/site/index']],
        ['label' => Yii::t('app', 'Site'), 'items' => [
            ['label' => Yii::t('app', 'About'), 'url' => ['/site/about']],
            ['label' => Yii::t('app', 'Contact'), 'url' => ['/site/contact']],
        ]],
        ['label' => Yii::t('app', 'Scoring'), 'items' => [
            ['label' => Yii::t('app', 'Domains'), 'url' => ['domain/index']],
            ['label' => Yii::t('app', 'Visitors'), 'url' => ['visitor/index']],
            ['label' => Yii::t('app', 'Projects'), 'url' => ['project/index']],
            ['label' => Yii::t('app', 'Get code'), 'url' => ['project/get-code']],
            ['label' => Yii::t('app', 'Scorings'), 'url' => ['data/index']],
            ['label' => Yii::t('app', 'Pages'), 'url' => ['page/index']],
        ]],
        !\Yii::$app->user->isGuest ? '<li>'
            . Html::beginForm(['/logout'], 'post')
            . Html::submitButton(
                Yii::t('app', 'Logout ({username})', ['username' => Yii::$app->user->identity->username]),
                ['class' => 'btn btn-link logout']
            )
            . Html::endForm()
            . '</li>' : ''
    ];

    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => \Yii::$app->user->isGuest ? [['label' => Yii::t("app", "Login"), 'url' => ['/login']]] : $items,
    ]);
    NavBar::end();
    ?>
    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= AlertBlock::widget([
            'type' => AlertBlock::TYPE_ALERT,
            'useSessionFlash' => true
        ]); ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; <?= Yii::t('app', 'My Company') ?> <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
