<?php

namespace app\widgets;
use yii\base\Widget;
/**
 * Configuración widget Session
 * 
 * En el caso de que el usuario esté logueado se renderiza el modal
 * el cual se inicializará si "$alert = true" y si el tiempo de sesión
 * finalizó, en caso de "$alert = false" solo se refrescará la página actual
 * y esto lo redireccionará la página por default cuando no existe sesión
 * iniciada.
 */
class SessionWidget extends Widget{
    
    public $loginUrl;
    public $alert;
    public $authTimeout;
    
    public function init() {
        parent::init();
    }
    
    public function run() {
        parent::run();
        
        $user = \Yii::$app->user;
        if(!$user || $user->isGuest) {
            return false;
        }
        return $this->render('modal', [
            'web' => \Yii::getAlias('@web'),
            'loginUrl' => $this->loginUrl,
            'alert' => $this->alert,
            'authTimeout' => $this->authTimeout
        ]);
    }
}
