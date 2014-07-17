<?php /* @var Controller $this */ ?>
<?php Yii::import('p3pages.modules.*'); ?>
<?php
$rootNode = P3Page::model()->findByAttributes(array('name_id' => 'Navbar'));
$page = P3Page::getActivePage();

if ($page !== null) {
    $translation = $page->getTranslationModel();
} else {
    $translation = null;
}
?>
<?php $this->widget(
    '\TbNavbar',
    array(
        'brandLabel' => Html::renderLogo(),
        'collapse' => true,
        'display' => TbHtml::NAVBAR_DISPLAY_FIXEDTOP,
        'items' => array(
            array(
                'class' => '\TbNav',
                'items' => P3Page::getMenuItems($rootNode)
            ),
            array(
                'class' => '\TbNav',
                'htmlOptions' => array(
                    'class' => 'navbar-left',
                ),
                'items' => array(
                    array(
                        'label' => Yii::t('app', 'Dashboard'),
                        'icon' => TbHtml::ICON_TH,
                        'url' => array('/dashboard/index'),
                        'visible' => !Yii::app()->user->isGuest,
                    ),
                ),
            ),
            array(
                'class' => '\TbNav',
                'htmlOptions' => array(
                    'class' => 'navbar-right',
                ),
                'items' => array(
                    array(
                        'class' => 'language-menu',
                        'label' => Yii::app()->language,
                        'htmlOptions' => array('class' => 'language-menu'),
                        'items' => Controller::getLanguageMenuItems(),
                    ),
                    array(
                        'label' => Yii::app()->user->name,
                        'visible' => !Yii::app()->user->isGuest,
                        'id' => 'accountMenuLink',
                        'items' => array(
                            array(
                                'label' => Yii::t('app', 'Dashboard'),
                                'url' => array('/dashboard/index'),
                                'visible' => !Yii::app()->user->isGuest
                            ),
                            /*
                            array(
                                'label' => Yii::t('app', 'Translations'),
                                'icon' => 'globe',
                                'url' => array('/account/translations'),
                                'visible' => !Yii::app()->user->isGuest
                            ),
                            */
                            array(
                                'label' => Yii::t('app', 'Profile'),
                                'url' => array('/profile/edit'),
                                'visible' => !Yii::app()->user->isGuest
                            ),
                            /*
                            array(
                                'label' => Yii::t('app', 'History'),
                                'icon' => 'time',
                                'url' => array('/account/history'),
                                'visible' => !Yii::app()->user->isGuest
                            ),
                            */
                            array(
                                'label' => Yii::t('app', 'Manage Accounts'),
                                'url' => array('/admin/manageAccounts'),
                                'visible' => Yii::app()->user->isAdmin(),
                            ),
                            '---',
                            array(
                                'label' => Yii::t('app', 'Logout'),
                                'url' => array('/account/authenticate/logout'),
                                'visible' => !Yii::app()->user->isGuest,
                                'id' => 'logoutLink',
                            ),
                        )
                    ),
                    array(
                        'label' => Yii::t('app', 'Login'),
                        'url' => user()->loginUrl,
                        'visible' => Yii::app()->user->isGuest,
                        'id' => 'loginLink',
                    ),
                ),
            ),
        )
    )
); ?>
