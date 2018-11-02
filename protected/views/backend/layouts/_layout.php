<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ru" lang="ru">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title><?php echo CHtml::encode(Yii::app()->name . ' - ' . $this->pageTitle); ?></title>

    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/backend/reset.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/backend/typography.css "/>
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/backend/main.css"/>

    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/backend/forms.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/backend/buttons.css"/>
</head>

<?php
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/frontend/jquery.fancybox-1.3.4.pack.js');
Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/css/frontend/jquery.fancybox-1.3.4.css');
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/backend/jquery.pnotify/jquery.pnotify.min.js');
Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/js/backend/jquery.pnotify/jquery.pnotify.default.css');
Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/css/backend/widgets/jui/themes/custom-theme/jquery-ui.css');
?>

<body>
	
<!-- Yandex.Metrika counter -->
<div style="display:none;"><script type="text/javascript">
(function(w, c) {
    (w[c] = w[c] || []).push(function() {
        try {
            w.yaCounter11601889 = new Ya.Metrika({id:11601889, enableAll: true, webvisor:true});
        }
        catch(e) { }
    });
})(window, "yandex_metrika_callbacks");
</script></div>
<script src="//mc.yandex.ru/metrika/watch.js" type="text/javascript" defer="defer"></script>
<noscript><div><img src="//mc.yandex.ru/watch/11601889" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->
	
    <script type="text/javascript">
        var APP = {
            baseUrl: '<?php echo Yii::app()->getRequest()->getBaseUrl() ?>',
            baseRequestUrl: '<?php echo Yii::app()->getRequest()->getScriptUrl() ?>?r='
        };
    </script>
    <table width="100%" class="wrapper">
        <tr>
            <td class="menu">
                <?php
                $this->widget(
                    'application.zii.widgets.MyMenu',
                    array(
                         'items' => array(
                             array('label' => 'Главная', 'url' => array('/')),
                             array('items' => array(
                                 array('label' => 'Товары', 'url' => array('/products/admin'), 'visible' => Yii::app()->user->checkAccess('products_management')),
                                 array('label' => 'Кухни', 'url' => array('/menuCuisines'), 'visible' => Yii::app()->user->checkAccess('products_management')),
                                 array('label' => 'Категории', 'url' => array('/productGroups/admin'), 'visible' => Yii::app()->user->checkAccess('products_management')),
                                 array('label' => 'Подкатегории', 'url' => array('/menuSubcategories/admin'), 'visible' => Yii::app()->user->checkAccess('products_management')),
                                 array('label' => 'Ингридиенты', 'url' => array('/ingredients/admin'), 'visible' => Yii::app()->user->checkAccess('products_management')),
                                 //array('label' => 'Модификаторы', 'url' => array('/productAdditives/admin'), 'visible' => Yii::app()->user->checkAccess('products_management')),
                             )),
                             array('items' => array(
                                 array('label' => 'Города', 'url' => array('/cities'), 'visible' => Yii::app()->user->checkAccess('cities_management')),
                                 array('label' => 'Районы', 'url' => array('/districts'), 'visible' => Yii::app()->user->checkAccess('admin')),
                                 array('label' => 'Метро', 'url' => array('/metro'), 'visible' => Yii::app()->user->checkAccess('admin')),
                             )),
                             array('items' => array(
                                 array('label' => 'Фотогалерея', 'url' => array('/pictureLibrary'), 'visible' => Yii::app()->user->checkAccess('admin')),
                             )),
                             array('items' => array(
                                 array('label' => 'Клиенты', 'url' => array('/clients'), 'visible' => Yii::app()->user->checkAccess('clients_management') || Yii::app()->user->checkAccess('clients_browse')),
                                 array('label' => 'Денежные переводы', 'url' => array('/clientsMoneyTransactions/admin'), 'visible' => Yii::app()->user->checkAccess('admin')),
                                 array('label' => 'Партнеры', 'url' => array('/partners'), 'visible' => Yii::app()->user->checkAccess('admin')),
                                 array('label' => 'Заказы', 'url' => array('/orders'), 'visible' => Yii::app()->user->checkAccess('orders_management')),
                                 array('label' => 'Статусы заказов', 'url' => array('/ordersStatuses'), 'visible' => Yii::app()->user->checkAccess('orders_management')),
                                 array('label' => 'Причины отказа', 'url' => array('/refuseReasons'), 'visible' => Yii::app()->user->checkAccess('orders_management')),
                                 array('label' => 'Обновление данных', 'url' => array('/UpdateData'), 'visible' => Yii::app()->user->checkAccess('admin')),
                             )),
                             array('items' => array(
                                 array('label' => 'СД', 'url' => array('/restaurants'), 'visible' => Yii::app()->user->checkAccess('restaurants_management')),
                                 array('label' => 'Филиалы', 'url' => array('/restaurantBranches'), 'visible' => Yii::app()->user->checkAccess('restaurants_management')),
                                 array('label' => 'Независимые СД', 'url' => array('/independentSd'), 'visible' => Yii::app()->user->checkAccess('restaurants_management')),
                                 array('label' => 'Зоны', 'url' => array('/restaurantZones'), 'visible' => Yii::app()->user->checkAccess('restaurants_management')),
                                 array('label' => 'Типы СД', 'url' => array('/restaurantTypes'), 'visible' => Yii::app()->user->checkAccess('restaurants_management')),
                                 array('label' => 'Типы обработки заказов', 'url' => array('/ordersProcessingTypes'), 'visible' => Yii::app()->user->checkAccess('restaurants_management')),
                                 array('label' => 'Новые СД', 'url' => array('/favouriteShops'), 'visible' => Yii::app()->user->checkAccess('admin')),
//                                 array('label' => 'Вакансии', 'url' => array('/jobs'), 'visible' => Yii::app()->user->checkAccess('jobs_management')),
                             )),
                             array('items' => array(
                                 array('label' => 'Модерация', 'url' => array('/sdChanges'), 'visible' => Yii::app()->user->checkAccess('admin')),
                                 array('label' => 'Параметры', 'url' => array('/config'), 'visible' => Yii::app()->user->checkAccess('admin')),
                                 array('label' => 'Акции', 'url' => array('/stocks'), 'visible' => Yii::app()->user->checkAccess('stocks_management')),
                             )),
                             array('items' => array(
                                 array('label' => 'Страницы', 'url' => array('/pages'), 'visible' => Yii::app()->user->checkAccess('pages_management')),
                                 array('label' => 'SEO текст', 'url' => array('/pages/editSeo'), 'visible' => Yii::app()->user->checkAccess('pages_management')),
                                 array('label' => 'Пользователи', 'url' => array('/users'), 'visible' => Yii::app()->user->checkAccess('users_management')),
                                 array('label' => 'Сообщения', 'url' => array('/messages/admin'), 'visible' => Yii::app()->user->checkAccess('admin')),
                                 array('label' => 'Методы оплат', 'url' => array('/payments'), 'visible' => Yii::app()->user->checkAccess('payments_management')),
                                 array('label' => 'Методы доставки', 'url' => array('/deliveries'), 'visible' => Yii::app()->user->checkAccess('deliveries_management')),
                             )),
                             array('items' => array(
                                 array('label' => 'Распределение операторов по дням недели', 'url' => array('/orderOperatorDays'), 'visible' => Yii::app()->user->checkAccess('operator_management')),
                                 array('label' => 'Распределение операторов по приоритетам', 'url' => array('/orderOperatorPriority'), 'visible' => Yii::app()->user->checkAccess('operator_management')),
                             )),
                             array('items' => array(
                                array('label' => 'Отзывы', 'url' => array('/reviews'), 'visible' => Yii::app()->user->checkAccess('reviews_management') || Yii::app()->user->checkAccess('reviews_browse')),
                             )),
                             array('items' => array(
                                array('label' => 'Рассылка', 'url' => array('/newsletterGroups'), 'visible' => Yii::app()->user->checkAccess('admin')),
                                array('label' => 'Блоги', 'url' => array('/blogs'), 'visible' => Yii::app()->user->checkAccess('blogs_management')),
                                array('label' => 'Тема блогов', 'url' => array('/blogTheme'), 'visible' => Yii::app()->user->checkAccess('blogs_management')),
                                array('label' => 'Блоггеры', 'url' => array('/bloggers'), 'visible' => Yii::app()->user->checkAccess('blogs_management')),
								array('label' => 'Социальные сети', 'url' => array('/social'), 'visible' => Yii::app()->user->checkAccess('blogs_management')),
                                array('label' => 'ЛинкоГенератор', 'url' => array('/gena'), 'visible' => Yii::app()->user->checkAccess('blogs_management')),
                             )),
                             array('label' => 'Выход', 'url' => array('/site/logout')),
                         ),
                    )
                );
                ?>
            </td>

            <td class="content">
                <?php if (!empty($this->tabs)) { ?>
                    <div class="menu-tabs">
                        <?php $this->widget('application.zii.widgets.MyMenu', array('items' => $this->tabs)); ?>
                    </div>
                <?php } ?>

                <h1><?php echo $this->pageTitle ?></h1>

                <?php if (!empty($this->breadcrumbs) || !empty($this->menu)) { ?>
                    <table width="100%" class="content-middle-header">
                    <tr>
                        <td>
                            <div class="content-breadcumbs">
                                Навигация: <?php $this->widget('application.zii.widgets.MyBreadcrumbs', array(
                                    'tagName' => 'span',
                                    'links' => $this->breadcrumbs,
                                )); ?>
                            </div>
                        </td>
                        <td>
                            <div class="content-actions">
                                <?php
                                $this->beginWidget('application.zii.widgets.MyPortlet', array(
                                    //'title' => 'Действия',
                                ));
                                $this->widget('application.zii.widgets.MyMenu', array(
                                    'items' => $this->menu,
                                ));
                                $this->endWidget();
                                ?>
                            </div>
                        </td>
                    </tr>
                    </table>
                <?php } ?>

                <?php echo $content; ?>
            </td>
        </tr>
    </table>
</body>
</html>
