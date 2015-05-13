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
    array('name' => GxHtml::valueEx(\$model)),
);\n";
?>

	$this->fiturTitle = "View <?php echo $this->modelClass; ?> #............";

	$this->menu=array(
		array('label'=>Yii::t('app', 'Create'), 'url'=>array('create'), 'img'=>'<i class="fa fa-file"></i>'),
		array('label'=>Yii::t('app', 'Update'), 'url'=>array('update', 'id' => $model-><?php echo $this->tableSchema->primaryKey; ?>), 'img'=>'<i class="fa fa-edit"></i>'),
		array('label'=>Yii::t('app', 'Manage'), 'url'=>array('admin'), 'img'=>'<i class="fa fa-table"></i>'),
	);

	$this->widget('application.components.CustomMenu', array(
	  'label' => $this->menu,
	));
?>

<p style="clear:both;"></p>

<div class='box box-default'>
	<div class='box-header with-border'>
		<h3 class='box-title'><i class="fa fa-eye"></i> View</h3>
	</div>

	<div class='box-body'>

		<?php echo '<?php'; ?> $this->widget('zii.widgets.CDetailView', array(
			'data' => $model,
			'attributes' => array(
		<?php
		foreach ($this->tableSchema->columns as $column)
				echo $this->generateDetailViewAttribute($this->modelClass, $column) . ",\n";
		?>
			),
		)); ?>

		<?php foreach (GxActiveRecord::model($this->modelClass)->relations() as $relationName => $relation): ?>
		<?php if ($relation[0] == GxActiveRecord::HAS_MANY || $relation[0] == GxActiveRecord::MANY_MANY): ?>
		<h2><?php echo '<?php'; ?> echo GxHtml::encode($model->getRelationLabel('<?php echo $relationName; ?>')); ?></h2>
		<?php echo "<?php\n"; ?>
			echo GxHtml::openTag('ul');
			foreach($model-><?php echo $relationName; ?> as $relatedModel) {
				echo GxHtml::openTag('li');
				echo GxHtml::link(GxHtml::encode(GxHtml::valueEx($relatedModel)), array('<?php echo strtolower($relation[1][0]) . substr($relation[1], 1); ?>/view', 'id' => GxActiveRecord::extractPkValue($relatedModel, true)));
				echo GxHtml::closeTag('li');
			}
			echo GxHtml::closeTag('ul');
		<?php echo '?>'; ?>
		<?php endif; ?>
		<?php endforeach; ?>
	</div>
</div>