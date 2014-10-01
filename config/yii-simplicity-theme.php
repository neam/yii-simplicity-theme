<?php

$config['theme'] = 'yii-simplicity-theme';
$config['components']['themeManager']['basePath'] = $applicationDirectory . '/../vendor/neam';

$config['aliases']['yii-simplicity-theme'] = 'vendor.neam.yii-simplicity-theme';

$config['import'][] = 'vendor.neam.yii-simplicity-theme.traits.SimplicityControllerTrait';

// Meant to be overridden in app config
$config['aliases']['simplicity-theme.app-views.layout-elements._menu'] = 'vendor.neam.yii-simplicity-theme.app-views.layout-elements._menu';
$config['aliases']['simplicity-theme.app-views.layout-elements._footer'] = 'vendor.neam.yii-simplicity-theme.app-views.layout-elements._footer';
