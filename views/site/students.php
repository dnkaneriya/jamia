<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\bootstrap\ActiveForm;
use yii\widgets\ListView;

use app\models\Classes;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UsersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::$app->params['apptitle'].' : Student List';
$this->params['breadcrumbs'][] = $this->title;
?>
<script type="text/javascript" src="<?php echo Yii::$app->request->baseUrl; ?>/scripts/jquery.validate.min.js"></script>
<div class="content">
	<div class="wrapper">
        <div class="dark">
            <div class="column12">
				<h1 class="marbot-30">Students</h1>
				<?php $form = ActiveForm::begin([
						'id'=>'student-form',
						'layout'=>'horizontal',
						'method'=>'get',
						'action'=>['students'],
						'options' => ['class' => 'form-horizontal'],
						'fieldConfig' => [
							//'template' => " <div class=\"control-group\">{lable}<div class=\"controls\">{input}</div>\n<div class=\"col-lg-7\">{error}</div></div>",
							/*'enableClientValidation'=>false,
							'enableAjaxValidation'=>false,
							'template' => "<div class=\"row\">{label}\n{beginWrapper}\n{input}\n{hint}\n{error}\n{endWrapper}</div>",
							'horizontalCheckboxTemplate'=>"{beginWrapper}\n<div class=\"checkbox\">\n{beginLabel}\n{input}\n{labelTitle}\n{endLabel}\n</div>\n{error}\n{endWrapper}\n{hint}",
							'horizontalCssClasses' => [
								'label' => 'col-sm-2 form-control-label',
								'offset' => 'col-sm-offset-4',
								'wrapper' => 'col-lg-4',
								'error' => '',
								'hint' => '',
							],*/
							//'template' => '{label} <div class="col-lg-6">{input}{error}</div>'
							// 'inputOptions' => ['class' => 'm-wrap span6'],
						],
					]);
				?>
				<div class="form-group field-student-search required">
					<div class="row">
						<label for="student-grno" class="control-label col-sm-2 form-control-label">GR No.</label>
						<div class="col-lg-4">
							<input type="text" placeholder="GR No." maxlength="255" name="grno" class="form-control has-value" id="student-grno">
						</div>
						<div class="col-lg-2">
							<?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-success']) ?>
						</div>
					</div>
				</div>
				<?php ActiveForm::end(); ?>
				<div class="timetable">
					<table width="100%">
						<thead class="dark salah">
							<th>#</th>
							<th>Name (English)</th>
							<th>Name (Arabic)</th>
							<th>GR No.</th>
							<th>Address</th>
							<th>City</th>
							<th>Parent Mobile</th>
						</thead>
						<tbody class="dark">
							<?= ListView::widget([
									'dataProvider' => $dataProvider,
									'summary'=>false,
									'itemOptions' => ['class' => 'item'],
									'emptyText' => '',
									'itemView' => function ($model, $key, $index, $widget) {
										//echo "<pre>";print_r($model);
										$index = $index+1;
										
							?>
							<tr>
								<td><?=$index?></td>
								<td><?=$model->name_en?></td>
								<td><?=$model->name_ar?></td>
								<td><?=$model->grno?></td>
								<td><?=$model->address?></td>
								<td><?=$model->city?></td>
								<td><?=$model->parent_mobile?></td>
							</tr>
							<?php
									},
							]) ?>
						</tbody>
					</table>
				</div>
			</div>
        </div>
	</div>
</div>
<div class="clear"></div>
<script type="text/javascript">
	
	var form1 = $('#student-form');
	var error1 = $('.alert-danger', form1);
    var success1 = $('.alert-success', form1);
	form1.validate({
		errorElement: 'span', //default input error message container
		errorClass: 'help-block', // default input error message class
		focusInvalid: true, // do not focus the last invalid input
		ignore: [],
		//ignore: "#job-walkin_time",
		rules: {
			"grno": {
				required: true
			},
		},
			
		invalidHandler: function (event, validator) { //display error alert on form submit              
			success1.hide();
			error1.show();
		},

		highlight: function (element) { // hightlight error inputs
			$(element)
				.closest('.form-group').addClass('has-error'); // set error class to the control group
		},
		
		unhighlight: function (element) { // revert the change done by hightlight
			$(element)
				.closest('.form-group').removeClass('has-error'); // set error class to the control group
		},

		success: function (label) {
			label
				.closest('.form-group').removeClass('has-error'); // set success class to the control group
	
		},
		errorPlacement: function (error, element) { // render error placement for each input type
			error.insertAfter(element); // for other inputs, just perform default behavoir
			
		},
	});
</script>