<?php

use yii\helpers\Html;
use yii\widgets\ListView;
use yii\helpers\Url;

use app\models\Student;
use app\models\CLasses;
use app\models\Subclass;
use app\models\Division;

$this->title = Yii::$app->params['apptitle'].' : Student Detail';
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
.u-skills {
    margin: 2px 0;
}
.mar-bot0 {
    margin-bottom: 0;
}
</style>
<div ui-view class="app-body" id="view">
	<!-- ############ PAGE START-->
	<?php
		if($model->image != ''){
            $image = $model->image;
        }else{
            $image = Url::to('@web/img/default.png',true);
        }
	?>
	<div class="item">
		<div class="item-bg">
			<img src="<?php echo $image; ?>" class="blur opacity-3">
		</div>
		<div class="p-a-md">
			<div class="row m-t">
				<div class="col-sm-7">
					<a href class="pull-left m-r-md">
						<span class="avatar w-96">
							<img src="<?php echo $image; ?>">
							<i class="on b-white"></i>
						</span>
					</a>
					<div class="clear m-b">
						<h3 class="m-a-0 m-b-xs"><?php echo $model->surname_en.' '.$model->firstname_en.' '.$model->lastname_en; ?></h3>
						<h5 class="m-a-0 m-b-xs"><?php echo $model->email; ?></h5>
						<small><i class="fa fa-map-marker m-r-xs"></i><?php echo $model->city; ?> <?php echo $model->state ?></small></p>
					</div>
				</div>
				<div class="col-sm-5">
					
				</div>
			</div>
		</div>
	</div>
    <div class="padding">
        <div class="row">
            <span class="col-md-4">
                <div class="mar-bot0 box p-a text-center">GR Number : <strong><?=$model->grno?></strong></div>
            </span>
            <span class="col-md-4">
                <div class="mar-bot0 box p-a text-center">Date of Birth : <strong><?=date('d/m/Y', $model->dob)?></strong></div>
            </span>
            <span class="col-md-4">
                <div class="mar-bot0 box p-a text-center">Mobile No. : <strong><?=$model->mobile_no?></strong></div>
            </span>
            <!--<span class="col-md-3">
                <div class="mar-bot0 box p-a text-center">Phone number : <strong><?php //$model->phone_no?></strong></div>
            </span>-->
        </div>
    </div>
	<div class="dker p-x">
		<div class="row">
			<div class="col-sm-6">
				<div class="p-y-md clearfix nav-active-primary">
					<ul class="nav nav-pills nav-sm">
						<li class="nav-item">
							<a class="nav-link active" href data-toggle="tab" data-target="#tab_1">Dini Education</a>
						</li>
                        <li class="nav-item">
							<a class="nav-link" href data-toggle="tab" data-target="#tab_2">School Education</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<div class="padding">
		<div class="row">
			<div class="col-sm-8 col-lg-9">
				<div class="tab-content">
                    <div class="tab-pane p-v-sm active" id="tab_1">
						<div class="box">
							<div class="box-header">
								<h2>Dini Education</h2>
							</div>
							<div class="table-responsive">
								<table class="table table-bordered m-a-0">
									<thead>
										<tr>
											<th>#</th>
											<th>Madrasa Name</th>
											<th>Nazra</th>
											<th>Hifz</th>
											<th>Arabic</th>
										</tr>
									</thead>
									<tbody>
										<?= ListView::widget([
											'dataProvider' => $dataProvider,
											'summary'=>false,
											'itemOptions' => ['class' => 'item'],
											'emptyText' => '<tr><td colspan="5">No results found.</td></tr>',
											'itemView' => function ($model, $key, $index, $widget) {
										?>
										<tr>
											<td><?php echo $index+1; ?></td>
											<td><?php echo $model->madrasa_name; ?></td>
											<td><?php if($model->nazra == 'Y'){ echo 'YES'; }else{ echo 'NO'; } ?></td>
											<td><?php if($model->hifz == 'Y'){ echo 'YES'; }else{ echo 'NO'; } ?></td>
											<td><?php if($model->arabic == 'Y'){ echo 'YES'; }else{ echo 'NO'; } ?></td>
										</tr>
										<?php
											},
										]) ?>  
									</tbody>
								</table>
							</div>
						</div>
					</div>
					<div class="tab-pane p-v-sm" id="tab_2">
						<div class="box">
							<div class="box-header">
								<h2>School Education</h2>
							</div>
							<div class="table-responsive">
								<table class="table table-bordered m-a-0">
									<thead>
										<tr>
											<th>#</th>
											<th>School Name</th>
											<th>Standard</th>
											<th>Medium</th>
											<th>Grade</th>
										</tr>
									</thead>
									<tbody>
										<?= ListView::widget([
											'dataProvider' => $dataProvider,
											'summary'=>false,
											'itemOptions' => ['class' => 'item'],
											'emptyText' => '<tr><td colspan="6">No results found.</td></tr>',
											'itemView' => function ($model, $key, $index, $widget) {
										?>
										<tr>
											<td><?php echo $index+1; ?></td>
											<td><?php echo $model->school_name; ?></td>
											<td><?php echo $model->school_standard; ?></td>
											<td><?php echo $model->school_medium; ?></td>
											<td><?php echo $model->grade; ?></td>
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
		</div>
	</div>
<!-- ############ PAGE END-->
</div>