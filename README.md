\xampp\htdocs\advanced\composer.json
 "require": {
        "php": ">=5.4.0",
        "yiisoft/yii2": ">=2.0.6",
        "yiisoft/yii2-bootstrap": "*",
        "yiisoft/yii2-swiftmailer": "*",
        "sarikayabtl/blog":"dev-master"
    },
    
    
    \xampp\htdocs\advanced\backend\config\main-local.php
     $config = [
        'modules' => [
            'blog' => [
                'class' => 'sarikayabtl\mesaj\Module',
            ],
        ],
