<?php
/**
 * The following variables are available in this template:
 * - $this: the CrudCode object
 */
?>
<?php
echo "<?php\n
\$this->breadcrumbs = array(
    array('name' => '$this->modelClass', 'url' => array('admin')),
    array('name' => Yii::t('app', 'Create')),
);\n";
?>
$this->fiturTitle = "<?php echo $this->modelClass; ?>";

$this->menu = array(
	array('label'=>Yii::t('app', 'Manage'), 'url' => array('admin'), 'img'=>'<i class="fa fa-table"></i>'),
);
$this->widget('application.components.CustomMenu', array(
  'label' => $this->menu,
));
?>

<p style="clear:both;"></p>

<div class='box box-default'>
	<div class='box-header with-border'>
		<h3 class='box-title'><i class="fa fa-plus-circle"></i> Create</h3>
	</div>

	<div class='box-body'>
		<?php echo "<?php\n"; ?>
		$this->renderPartial('_form', array(
				'model' => $model,
				'buttons' => 'create'));
		<?php echo '?>'; ?>
	</div>
</div>