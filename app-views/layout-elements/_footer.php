<footer class="footer">
    <div class="container">
        <div class="footer-top">
            <?php echo TbHtml::link(TbHtml::image(Yii::app()->baseUrl . '/images/logo-small.png'), Yii::app()->baseUrl); ?>
        </div>
        <div class="row">
            <div class="footer-column">
                <div class="row">
                    <div class="link-column">
                        <ul class="footer-links">
                            <li><?php echo Yii::app()->workflowUi->renderFooterLink('Terms', 'terms'); ?></li>
                            <li><?php echo Yii::app()->workflowUi->renderFooterLink('About', 'about'); ?></li>
                            <li><?php echo Yii::app()->workflowUi->renderFooterLink('CC', 'cc'); ?></li>
                            <li><?php echo Yii::app()->workflowUi->renderFooterLink('Privacy Policy', 'privacyPolicy'); ?></li>
                        </ul>
                    </div>
                    <?php /*
                            <div class="link-column">
                                <ul class="footer-links">
                                    <li><a href="#">Footer Link</a></li>
                                    <li><a href="#">Lorem</a></li>
                                    <li><a href="#">Ipsum Dolor</a></li>
                                    <li><a href="#">Sit Amet</a></li>
                                </ul>
                            </div>
                            <div class="link-column">
                                <ul class="footer-links">
                                    <li><a href="#">Footer Link</a></li>
                                    <li><a href="#">Lorem</a></li>
                                    <li><a href="#">Ipsum Dolor</a></li>
                                    <li><a href="#">Sit Amet</a></li>
                                </ul>
                            </div>
                            */ ?>
                </div>
                <div class="row">
                    <div class="copyright-column">
                        <p class="lead"><?php echo Yii::t('app', 'Copyright {year}', array('{year}' => date('Y'))); ?></p>
                        <?php /*
                                <p><?php echo Yii::t('app', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut dui est, gravida ac nisi et, porta tristique orci. In mollis nunc in nulla vehicula, in feugiat tellus lobortis. Curabitur sed leo imperdiet, mollis mauris in, consequat massa. Aenean arcu odio, molestie nec sem imperdiet, vehicula dignissim massa.'); ?></p>
                                */ ?>
                    </div>
                </div>
            </div>
            <div class="footer-column"></div>
        </div>
        <div class="footer-bottom">
        </div>
    </div>
</footer>
