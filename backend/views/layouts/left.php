<?php
use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */
?>
<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?php echo $directoryImgAsset; ?>/web/img/pig-160-160.png" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p>
                    <?php echo Yii::$app->user->identity->username; ?>
                </p>

                <?= Html::a(
                    '<i class="fa fa-circle text-success"></i> Online',
                    ['/profile'],
                    ['class' => '']
                ) ?>
            </div>
        </div>

        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
        <!-- /.search form -->

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'items' => [
                    ['label' => 'Menu', 'options' => ['class' => 'header']],
                    ['label' => 'Dashboard', 'icon' => 'dashboard', 'url' => ['/']],
                    ['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],
                    [
                        'label' => 'Example Grid - Book',
                        'icon' => 'book',
                        'url' => ['/book']
                    ],
                    /*
                    [
                        'label' => 'Mailbox',
                        'icon' => 'envelope-o',
                        'url' => ['/mailbox'],
                        'template'=>'<a href="{url}">{icon} {label}<span class="pull-right-container"><small class="label pull-right bg-yellow">123</small></span></a>'
                    ],
                    */
                    [
                        'label' => 'Manage Record',
                        'icon' => 'file',
                        'url' => '#',
                        'items' => [
                            [
                                'label' => 'Manage Order (Relational Data)',
                                'icon' => 'reorder',
                                'url' => ['/order']
                            ],
                            [
                                'label' => 'Manage Booking (Relational Data)',
                                'icon' => 'calendar',
                                'url' => ['/order']
                            ],
                            [
                                'label' => 'Manage Customer (Relational Data)',
                                'icon' => 'user',
                                'url' => ['/customer']
                            ],
                            [
                                'label' => 'Manage User',
                                'icon' => 'user',
                                'url' => ['/user']
                            ],
                        ],
                    ],
                    [
                        'label' => 'Table Setup',
                        'icon' => 'database',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Item', 'icon' => 'table', 'url' => ['/item'],],
                            ['label' => 'Country', 'icon' => 'table', 'url' => ['/country'],],
                           // ['label' => 'Equipment', 'icon' => 'product-hunt', 'url' => ['/equipment'],],
                        ],
                    ],
                    [
                        'label' => 'Settings',
                        'icon' => 'cog',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Gii', 'icon' => 'file-code-o', 'url' => ['/gii'],],
                            ['label' => 'Debug', 'icon' => 'dashboard', 'url' => ['/debug'],],
                        ],
                    ],
                    [
                        'label' => 'Tools',
                        'icon' => 'share',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Gii', 'icon' => 'file-code-o', 'url' => ['/gii'],],
                            ['label' => 'Debug', 'icon' => 'dashboard', 'url' => ['/debug'],],
                            [
                                'label' => 'Level One',
                                'icon' => 'circle-o',
                                'url' => '#',
                                'items' => [
                                    ['label' => 'Level Two', 'icon' => 'circle-o', 'url' => '#',],
                                    [
                                        'label' => 'Level Two',
                                        'icon' => 'circle-o',
                                        'url' => '#',
                                        'items' => [
                                            ['label' => 'Level Three', 'icon' => 'circle-o', 'url' => '#',],
                                            ['label' => 'Level Three', 'icon' => 'circle-o', 'url' => '#',],
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ]
        ) ?>

    </section>

</aside>
