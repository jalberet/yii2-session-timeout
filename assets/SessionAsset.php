<?php

namespace app\assets;
use yii\web\AssetBundle;
use yii\web\View;
use yii\helpers\Json;

/**
 * Description of SessionAsset
 *
 * @author MMG120
 */
class SessionAsset extends AssetBundle{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $js = [
        'js/session-timeout.js'
    ];
    
    public $depends = [
        'yii\web\JqueryAsset',
        'yii\bootstrap5\BootstrapAsset'
    ];
    
    public function initPlugin(View $view, $options = []) {
        parent::init();

        $json = Json::encode($options);
        
        $view->registerJs("$('#session-warning-modal').sessionWarning({$json});");
        return $this;
    }
}
