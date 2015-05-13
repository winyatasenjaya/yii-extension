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
    array('name' => Yii::t('app', 'Manage')),
);\n";
?>
$this->fiturTitle = "<?php echo $this->modelClass; ?>";
$this->pageTitle = Yii::app()->name." - ".$this->fiturTitle;

$this->menu = array(
		array('label'=>Yii::t('app', 'Create'), 'url'=>array('create'), 'img'=>'<i class="fa fa-plus-circle"></i>'),
	);

$this->widget('application.components.CustomMenu', array(
  'label' => $this->menu,
));

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('<?php echo $this->class2id($this->modelClass); ?>-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<p style="clear:both;"></p>
<div class='box box-default'>
	<div class='box-header with-border'>
		<h3 class='box-title'><i class="fa fa-table"></i> Manage</h3>
	</div>

	<div class='box-body'>

		<?php echo "<?php echo GxHtml::link(Yii::t('app', 'Advanced Search'), '#', array('class' => 'search-button')); ?>"; ?>

		<div class="search-form">
		<?php echo "<?php \$this->renderPartial('_search', array(
			'model' => \$model,
		)); ?>\n"; ?>
		</div><!-- search-form -->

		<?php echo '<?php'; ?> $this->widget('zii.widgets.grid.CGridView', array(
			'id' => '<?php echo $this->class2id($this->modelClass); ?>-grid',
			'dataProvider' => $model->search(),
			'filter' => $model,
			'columns' => array(
		<?php
		$count = 0;
		foreach ($this->tableSchema->columns as $column) {
			if (++$count == 7)
				echo "\t\t/*\n";
			echo "\t\t" . $this->generateGridViewColumn($this->modelClass, $column).",\n";
		}
		if ($count >= 7)
			echo "\t\t*/\n";
		?>
				array(
					'class' => 'CButtonColumn',
					'htmlOptions' => array('style'=>'width: 100px; text-align: center;'),
				),
			),
			'itemsCssClass' => 'table table-bordered table-striped table-hover',
		)); ?>
	</div>
</div>