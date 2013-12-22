<?php
/**
 * @var $this EmailWebController
 * @var $content string
 *
 * @author Brett O'Donnell <cornernote@gmail.com>
 * @author Zain Ul abidin <zainengineer@gmail.com>
 * @copyright 2013 Mr PHP
 * @link https://github.com/cornernote/yii-email-module
 * @license BSD-3-Clause https://raw.github.com/cornernote/yii-email-module/master/LICENSE
 *
 * @package yii-email-module
 */
$cs = Yii::app()->clientScript;
$cs->coreScriptPosition = CClientScript::POS_HEAD;
$cs->scriptMap = array();
$baseUrl = $this->module->assetsUrl;
$cs->registerCoreScript('jquery');
$cs->registerScriptFile($baseUrl . '/js/bootstrap.min.js');
$cs->registerCssFile($baseUrl . '/css/bootstrap.min.css');
$cs->registerCssFile($baseUrl . '/css/font-awesome.min.css');
$cs->registerCssFile($baseUrl . '/css/main.css');
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="language" content="en"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>
<body>

<div class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only"><?php echo Yii::t('email', 'Toggle navigation'); ?></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <?php echo CHtml::link($this->module->getName(), array('/' . $this->module->id), array('class' => 'navbar-brand')); ?>
        </div>
        <div class="navbar-collapse collapse">
            <?php
            $items = array();
            foreach (array_keys($this->module->controllerMap) as $controllerName) {
                $items[] = array(
                    'label' => Yii::t('email', ucfirst($controllerName)),
                    'url' => Yii::app()->getUser()->getState('index.email' . ucfirst($controllerName), array($controllerName . '/index')),
                    'active' => $this->id == $controllerName,
                );
            }
            $this->widget('zii.widgets.CMenu', array(
                'htmlOptions' => array('class' => 'nav navbar-nav'),
                'items' => $items,
            ));
            $this->widget('zii.widgets.CMenu', array(
                'htmlOptions' => array('class' => 'nav navbar-nav navbar-right'),
                'items' => array(
                    array(
                        'label' => Yii::t('email', 'Home'),
                        'url' => Yii::app()->getHomeUrl(),
                    ),
                ),
            ));
            ?>
        </div>
    </div>
</div>

<?php echo $content; ?>

<div id="footer" class="container small text-center">
    <?php if (Yii::app()->hasModule('audit')) $this->renderPartial('audit.views.request.__footer'); ?>
    <br/><?php echo EmailModule::powered(); ?>
    <br/>A product of <a href="http://mrphp.com.au">Mr PHP</a>.
</div>

</body>
</html>
