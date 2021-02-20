<?php

/* @var $this yii\web\View */

$this->title = 'Appnovation';
use yii\helpers\Json;
use yii\helpers\ArrayHelper;
?>
<div class="site-index">

    <div class="body-content">

		<div class="row">

            <div class="col-lg-12 col-sm-12">
				The following software components are used for this project:<br/>
				- Bootstrap 4<br/>
				- VueJS UI Framework 2.x <br/>
				- PHP MVC Framework <br/>
				<?php

					if(Yii::$app->redis->exists('test')) {
						Yii::$app->redis->set('test', '- Redis Cache is on!!');
					} else {
						Yii::$app->redis->set('test', '- Redis Cache is on!!');
						echo Yii::$app->redis->get('test') . "<br/>";
					}
					echo Yii::$app->redis->get('test') . "<br/>";

					echo Yii::$app->redis->get('pVKecZaJj39P') . "<br/>";
					echo "<br/> found by name (sin) <br/>";
					echo Yii::$app->redis->get('sin') . "<br/>";

				?>
			</div>

		</div>

    </div>
</div>
 