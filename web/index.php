<?php
ini_set('max_execution_time', 300);
// comment out the following two lines when deployed to production
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');

//date_default_timezone_set('Asia/Calcutta');

require(__DIR__ . '/../vendor/autoload.php');
require(__DIR__ . '/../vendor/yiisoft/yii2/Yii.php');

$config = require(__DIR__ . '/../config/web.php');

(new yii\web\Application($config))->run();
?>

<script>
    var path = "<?php echo Yii::$app->request->baseUrl; ?>";
    setTimeout(function(){
        $('.alert-dismissable').slideUp();
    },5000);
</script>