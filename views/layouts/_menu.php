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
if (!empty($this->homeBrandLabel)) {
    $brand = $this->homeBrandLabel;
    $brandOptions = $navbarHtmlOptions = array('class' => 'gapminder-org-brand');
} else {
    $brand = TbHtml::image(baseUrl('/images/logo.png'), 'Gapminder') . '<span>' . t('app', 'friends') . '</span>';
    $brandOptions = $navbarHtmlOptions = array('class' => 'gapminder-friends-brand');
}
?>
<?php $this->widget(
    '\TbNavbar',
    array(
        'brandLabel' => $brand,
        'brandUrl' => $this->getBrandUrl(),
        'brandOptions' => $brandOptions,
        'collapse' => true,
        'display' => TbHtml::NAVBAR_DISPLAY_FIXEDTOP,
        'fluid' => true,
        'htmlOptions' => $navbarHtmlOptions,
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
                ),
            ),
            array(
                'class' => '\TbNav',
                'htmlOptions' => array(
                    'class' => 'navbar-right',
                ),
                'encodeLabel' => false,
                'items' => array(
                    array(
                        'class' => 'language-menu',
                        'label' => Yii::app()->language,
                        'htmlOptions' => array('class' => 'language-menu'),
                        'items' => Controller::getLanguageMenuItems(),
                    ),
                    array(
                        'label' => t('app', 'Search'),
                        'url' => array('#'),
                        'class' => 'search-link',
                    ),
                    array(
                        'label' => isset(user()->model->profile->picture_media_id)
                            ? user()->renderPicture('user-profile-picture-mini') . user()->name
                            : user()->name,
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
                                'url' => array('/restrictedAccess/admin/manageAccounts'),
                                'visible' => Yii::app()->user->isAdmin(),
                            ),
                            '---',
                            array(
                                'label' => Yii::t('app', 'Logout'),
                                'url' => array('/account/authenticate/logout'),
                                'visible' => !Yii::app()->user->isGuest,
                                'id' => 'logoutLink',
                                'class' => 'hidden-xs',
                            ),
                        ),
                    ),
                    array(
                        'label' => Yii::t('app', 'Logout'),
                        'url' => array('/account/authenticate/logout'),
                        'visible' => !Yii::app()->user->isGuest,
                        'id' => 'logoutLinkMobile',
                        'class' => 'visible-xs-block visible-xs',
                    ),
                    array(
                        'label' => Yii::t('app', 'Sign In'),
                        'url' => user()->loginUrl,
                        'visible' => Yii::app()->user->isGuest,
                        'id' => 'loginLink',
                        'class' => 'login-class',
                    ),
                ),
            ),
        )
    )
); ?>
