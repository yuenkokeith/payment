<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use kartik\bs4dropdown\Dropdown;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use kartik\nav\NavX;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>

   
    <!-- vuejs -->
	<link rel="stylesheet" href="/payment/css/fontawesome.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <link rel="stylesheet" href="/payment/css/jquery.mCustomScrollbar.min.css">
    
    <link
      type="text/css"
      rel="stylesheet"
      href="/payment/css/bootstrap-vue.css"
    />

	<script src="/payment/js/jquery3_4_1_slim.js"></script>
	<script src="/payment/js/vue.js"></script>
    <script src="/payment/js/bootstrap-vue.js"></script>
	<script src="/payment/js/vue-resource.js"></script>

	<!-- Date-picker itself -->
	<script src="/payment/js/moment.js"></script>
	<script src="/payment/js/bootstrap-datetimepicker.min.js"></script>
	
	<link href="/payment/css/bootstrap-datetimepicker.min.css" rel="stylesheet">
	
	<!-- Lastly add this package -->
	<script src="/payment/js/vue-bootstrap-datetimepicker.js"></script>

	<!-- use the latest vue-select release -->
	<script src="/payment/js/vue-select.js"></script>
	<link rel="stylesheet" href="/payment/css/vue-select.css">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	
	<script>
	  // Initialize as global component
	  Vue.component('date-picker', VueBootstrapDatetimePicker);
	  Vue.component('v-select', VueSelect.VueSelect)
	</script>


</head>
<body>
<?php $this->beginBody() ?>


    <div class="wrapper d-flex align-items-stretch"> <!-- container -->
                <nav id="sidebar">
				<div class="custom-menu">
					<button type="button" id="sidebarCollapse" class="btn btn-primary">
					  <i class="fa fa-bars"></i>
					  <span class="sr-only">Toggle Menu</span>
					</button>
				</div>
				<div class="p-4">
		  			<h1><a href="/payment" class="logo">Appnovation <span>Payment Integration</span></a></h1>
					<ul class="list-unstyled components mb-5">
					  <li class="active">
						<a href="/payment"><span class="fa fa-home mr-3"></span> Home</a>
					  </li>
					  <li>
						  <a href="/payment/create-payment"><span class="fa fa-user mr-3"></span> Create Payment</a>
					  </li>
					  <li>
					  <a href="/payment/check-payment"><span class="fa fa-briefcase mr-3"></span>Check Payment</a>
					  </li>
					  
					</ul>

					

				</div>
    		</nav>

			<!-- Page Content  -->
			<div id="content" class="p-4 p-md-5 pt-5">
				<?= Breadcrumbs::widget([
				'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
				]) ?>
				<?= Alert::widget() ?>
				<?php echo $content ?>
						
			</div>

    </div>



<!--
<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; Currency Exchange App <?= date('Y') ?></p>

        <p class="pull-right">Built with - MVC PHP Framework</p>
    </div>
</footer>
-->

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
