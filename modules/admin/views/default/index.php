<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;

use kartik\grid\GridView;

use app\models\Student;

$this->title = Yii::$app->params['apptitle'].': Dashboard';
?>

<script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
<script src="<?php echo Yii::$app->request->baseUrl; ?>/scripts/owl.carousel.js" ></script>
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />
<link rel="stylesheet" href="<?php echo Yii::$app->request->baseUrl; ?>/css/styles/owl.carousel.css" type="text/css">
<div ui-view class="app-body" id="view">
    <div class="padding">
        <?php echo Yii::$app->getSession()->getFlash('flash_msg'); ?>
        <div class="row">
			<div class="col-xs-6 col-sm-4">
                <div class="box p-a flat-badge">
                  <div class="pull-left m-r">
                    <span class="w-48 rounded primary">
                      <i class="material-icons">&#xe7ef;</i>
                    </span>
                  </div>
                  <div class="clear">
                    <h4 class="m-a-0 text-lg _300 flat-total-badge"><a href="<?php echo Yii::$app->request->baseUrl.'/admin/student/pending'?>">
                    <?php echo Student::find()->where(['is_deleted'=>'N'])->count();?> <span class="text-sm">Students</span></a></h4>
                    <small class="text-muted">&nbsp;</small>
                  </div>
                </div>
            </div>
			<?php /*
            <div class="col-xs-6 col-sm-4">
                <div class="box p-a flat-badge">
                  <div class="pull-left m-r">
                    <span class="w-48 rounded  accent">
                      <i class="material-icons">&#xe8d3;</i>
                    </span>
                  </div>
                  <div class="clear">
                    <h4 class="m-a-0 text-lg _300 flat-total-badge"><a href = "<?php echo Yii::$app->request->baseUrl.'/admin/user/candidate'?>">
                    <?php echo User::find()->count(); ?> <span class="text-sm">Candidates</span></a></h4>
                    <small class="text-muted">&nbsp;</small>
                  </div>
                </div>
            </div>
            <div class="col-xs-6 col-sm-4">
                <div class="box p-a flat-badge">
                  <div class="pull-left m-r">
                    <span class="w-48 rounded warn">
                      <i class="material-icons">&#xe8f9;</i>
                    </span>
                  </div>
                  <div class="clear">
                    <h4 class="m-a-0 text-lg _300 flat-total-badge"><a href="<?php echo Yii::$app->request->baseUrl.'/admin/job/index'?>">
                    <?php //echo Job::find()->where(['is_deleted'=>'N'])->count();?> <span class="text-sm">Jobs</span></a></h4>
                    <small class="text-muted">&nbsp;</small>
                  </div>
                </div>
            </div>
            */ ?>
        </div>
		<div class="row">
			<div class="col-sm-6 col-md-6">
				
			</div>
			<div class="col-sm-6 col-md-6">
				
			</div>
		</div>
		<div class="row">
			<div class="col-sm-6 col-md-6">
				
			</div>
			<div class="col-sm-6 col-md-6">
				
			</div>
		</div>
		
		<div class="row">
			
		</div>
		
    </div>
</div>
<script type="text/javascript">
$(function() {
	$('#daterange').daterangepicker({autoApply: true});
	$('#daterange').on('apply.daterangepicker', function(ev, picker) {
		t = picker.startDate.format('DD-MM-YYYY')+','+picker.endDate.format('DD-MM-YYYY');
		
		$.ajax({
			url:"<?=Yii::$app->request->baseUrl?>"+"/admin/default/dashboardgraph?tm="+t,
			type: 'get',
			success: function(response){
					console.log(response);
					option = response+",{series: { pie: { show: true, innerRadius: 0, stroke: { width: 0 }, label: { show: true, threshold: 0.05 } } },legend: {backgroundColor: 'transparent'},colors: ['#0cc2aa','#fcc100'],grid: { hoverable: true, clickable: true, borderWidth: 0, color: 'rgba(120,120,120,0.5)' },   tooltip: true,tooltipOpts: { content: '%s: %p.0%' }}";
					
					self = $('#pie-chart');
					var options = eval('[' + option + ']');
					if ($.isPlainObject(options[0])) {
						options[0] = $.extend({}, options[0]);
					}
					self[self.attr('ui-jp')].apply(self, options);
					
					//console.log(response);
					//option = "{tooltip : {trigger: 'item',formatter: '{b} : {c} <br>({d}%)'},legend: {orient : 'vertical',x : 'left',data:['Candidates','Employers','Jobs']},calculable : true,series : [{name:'Source',type:'pie',radius : '55%',center: ['50%', '60%'],data:"+response+"}]}";
					////option = response+",{series: { pie: { show: true, innerRadius: 0, stroke: { width: 0 }, label: { show: true, threshold: 0.05 } } },legend: {backgroundColor: 'transparent'},colors: ['#0cc2aa','#fcc100'],grid: { hoverable: true, clickable: true, borderWidth: 0, color: 'rgba(120,120,120,0.5)' },   tooltip: true,tooltipOpts: { content: '%s: %p.0%' }}";
					//
					//self = $('#pie-chart1');
					//var options = eval('[' + option + ']');
					//console.log(options);
					//if ($.isPlainObject(options[0])) {
					//	options[0] = $.extend({}, options[0]);
					//}
					//self[self.attr('ui-jp')].apply(self, options);
					
					//var obj =JSON.parse(response);
					//$('.custom-bar-chart').html(obj['html']);
					//$('[data-toggle="tooltip"]').tooltip();
			}
		});
		
	});
});
</script>
<script>
	function draw() {
		alert('sad');
		option = "[{data: 75, label: 'iPhone'}, {data: 20, label: 'iPad'}],{series: { pie: { show: true, innerRadius: 0, stroke: { width: 0 }, label: { show: true, threshold: 0.05 } } },legend: {backgroundColor: 'transparent'},colors: ['#0cc2aa','#fcc100'],grid: { hoverable: true, clickable: true, borderWidth: 0, color: 'rgba(120,120,120,0.5)' },   tooltip: true,tooltipOpts: { content: '%s: %p.0%' }}";
        self = $('#pie-chart');
		$(self).attr('ui-options',option);
		var options = eval('['+option+']');
		console.log(options);
		if ($.isPlainObject(options[0])) {
			options[0] = $.extend({}, options[0]);
		}
		self[self.attr('ui-jp')].apply(self, options);
    }
	//setTimeout(function(){ draw(); }, 5000);
</script>
<script>
//owl carousel
$(document).ready(function() {
	$("#owl-demo").owlCarousel({
		navigation : true,
		slideSpeed : 300,
		paginationSpeed : 400,
		singleItem : true,
		autoPlay:true

	});
});
</script>
<?php /*
<!--main content start-->
      <section id="main-content">
          <section class="wrapper">
			<?php
				echo Yii::$app->getSession()->getFlash('flash_msg');
			?>
              <!--state overview start-->
            
			  <div class="row">
				<div class="col-lg-12">
                      <!--custom chart start-->
                      <div class="border-head">
                          <h3>Statistics Graph 
						  
						  <input style="border: none;background: transparent;" type="text" id="daterange" name="daterange" value="<?php echo date("m/d/Y", strtotime("-1 month")); ?> - <?php echo date('m/d/Y'); ?>" />
						  </h3>
						  <script type="text/javascript">
							$(function() {
								$('#daterange').daterangepicker({autoApply: true});
								$('#daterange').on('apply.daterangepicker', function(ev, picker) {
									//console.log(picker.startDate.format('YYYY-MM-DD'));
									//console.log(picker.endDate.format('YYYY-MM-DD'));
									t = picker.startDate.format('DD-MM-YYYY')+','+picker.endDate.format('DD-MM-YYYY');
									
									$.ajax({
										url:"<?=Yii::$app->request->baseUrl?>"+"/admin/default/dashboardgraph?tm="+t,
										type: 'get',
										success: function(response){
												//console.log(response);
												 var obj =JSON.parse(response);
												$('.custom-bar-chart').html(obj['html']);
												$('[data-toggle="tooltip"]').tooltip();
										}
									});
									
								});
							});
							</script>
                      </div>
                      <div class="custom-bar-chart">
						  <?php echo $graph['html']; ?>
                    </div>
                      <!--custom chart end-->
                  </div>
			  </div>
			  
		  </section>
      </section>
<style>
	.custom-bar-chart .bar { width: 10%; }
</style>
*/ ?>