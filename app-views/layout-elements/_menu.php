<?php /* @var Controller $this */ ?>
<?php
if (!empty($this->homeBrandLabel)) {
    $brand = $this->homeBrandLabel;
} else {
    $brand = Yii::t('brand', 'Simplicity');
}
$brandOptions = $navbarHtmlOptions = array('class' => 'app-brand');
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
            /*
            array(
                'class' => '\TbNav',
                'items' => P3Page::getMenuItems($rootNode)
            ),
            */
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
                    /*
                    array(
                        'class' => 'language-menu',
                        'label' => Yii::app()->language,
                        'htmlOptions' => array('class' => 'language-menu'),
                        'items' => Controller::getLanguageMenuItems(),
                    ),
                    */
                    array(
                        'label' => t('app', 'Search'),
                        'url' => array('#'),
                        'class' => 'search-link',
                    ),
                    array(
                        'label' => isset(user()->model->profile->profile_picture_media_id)
                                ? user()->renderPicture('user-profile-picture-mini') . user()->name
                                : user()->name,
                        'visible' => !Yii::app()->user->isGuest,
                        'id' => 'accountMenuLink',
                        'items' => array(
                            array(
                                'label' => Yii::t('app', 'Profile'),
                                'url' => array('/profile/edit'),
                                'visible' => !Yii::app()->user->isGuest
                            ),
                            array(
                                'label' => Yii::t('app', 'Manage Accounts'),
                                'url' => array('/admin/manageAccounts'),
                                'visible' => Yii::app()->user->isAdmin(),
                            ),
                            '---',
                            array(
                                'label' => Yii::t('app', 'Logout'),
                                'url' => array('/user/logout'),
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
