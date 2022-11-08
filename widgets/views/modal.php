<?php
use yii\bootstrap5\Html;
use yii\bootstrap5\Modal;
use app\assets\SessionAsset;

Modal::begin([
    'title' => 'Sessión finalizada',
    'id' => 'session-warning-modal',
    'footer' => Html::a('Iniciar sesión', $loginUrl, ['class' => 'btn btn-warning btn-sm'])
]);
echo '<p>Por inactividad su sesión ha finalizado, vuelva a iniciar sesión para continuar.</p>';
Modal::end();


SessionAsset::register($this)->initPlugin($this, [
    'web' => $web,
    'loginUrl' => $loginUrl,
    'alert' => $alert,
    'authTimeout' => $authTimeout
]);