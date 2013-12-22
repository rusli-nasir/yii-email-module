<?php
/**
 * @var $this EmailSpoolController
 * @var $emailSpool EmailSpool
 *
 * @author Brett O'Donnell <cornernote@gmail.com>
 * @author Zain Ul abidin <zainengineer@gmail.com>
 * @copyright 2013 Mr PHP
 * @link https://github.com/cornernote/yii-email-module
 * @license BSD-3-Clause https://raw.github.com/cornernote/yii-email-module/master/LICENSE
 *
 * @package yii-email-module
 */
$this->pageTitle = Yii::t('email', 'Spool ID-:id', array(':id' => $emailSpool->id));

$attributes = array();
$attributes[] = array(
    'name' => 'id',
);
$attributes[] = array(
    'name' => 'transport',
);
$attributes[] = array(
    'name' => 'template',
);
$attributes[] = array(
    'name' => 'priority',
);
$attributes[] = array(
    'name' => 'status',
);
$attributes[] = array(
    'name' => 'model_name',
);
$attributes[] = array(
    'name' => 'model_id',
);
$attributes[] = array(
    'name' => 'to_address',
);
$attributes[] = array(
    'name' => 'from_address',
);
$attributes[] = array(
    'name' => 'subject',
);
$attributes[] = array(
    'name' => 'sent',
    'value' => $emailSpool->sent ? Yii::app()->format->formatDatetime($emailSpool->sent) : null,
);
$attributes[] = array(
    'name' => 'created',
    'value' => Yii::app()->format->formatDatetime($emailSpool->created),
);
$this->widget('zii.widgets.CDetailView', array(
    'data' => $emailSpool,
    'attributes' => $attributes,
));

// message
echo CHtml::tag('h2', array(), Yii::t('email', 'Message'));
echo CHtml::tag('pre', array(), $emailSpool->swiftMessage->getBody());

// other parts
foreach ($emailSpool->swiftMessage->getChildren() as $child) {
    /** @var Swift_MimePart $child */
    echo CHtml::tag('h2', array(), $child->getContentType());
    echo CHtml::tag('pre', array(), $child->getBody());
}