<?php
/**
 * The following variables are available in this template:
 * - $this: the CrudCode object
 */
?>
<div class="wide form">

<?php echo "<?php \$form = \$this->beginWidget('GxActiveForm', array(
	'action' => Yii::app()->createUrl(\$this->route),
	'method' => 'get',
	'htmlOptions'=>array('class'=>'form-horizontal'),
)); ?>\n"; ?>

<?php foreach($this->tableSchema->columns as $column): ?>
<?php
	$field = $this->generateInputField($this->modelClass, $column);
	if (strpos($field, 'password') !== false)
		continue;
?>
	<div class="form-group">
		<?php echo "<?php echo \$form->label(\$model, '{$column->name}', array('class'=>'col-sm-2 control-label')); ?>\n"; ?>
		<div class="col-sm-9">
			<?php echo "<?php " . $this->generateSearchField($this->modelClass, $column, array('class'=>'form-control'))."; ?>\n"; ?>
		</div>
	</div>

<?php endforeach; ?>
	<div class="buttons">
		<?php echo "<?php echo GxHtml::submitButton(Yii::t('app', 'Search'), array('class'=>'btn btn-default')); ?>\n"; ?>
	</div>

<?php echo "<?php \$this->endWidget(); ?>\n"; ?>

</div><!-- search-form -->
