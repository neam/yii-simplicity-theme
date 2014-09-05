<?php

trait SimplicityControllerTrait
{

    /**
     * @var string the default layout for the controller view. Defaults to '//layouts/column1',
     * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
     */
    public function getLayout()
    {
        return WorkflowUi::LAYOUT_REGULAR;
    }

    /**
     * @var array context menu items. This property will be assigned to {@link CMenu::items}.
     */
    public $_menu = array();

    public function getMenu()
    {
        return $this->_menu;
    }

    /**
     * @var array the breadcrumbs of the current page. The value of this property will
     * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
     * for more details on how to specify this property.
     */
    public $_breadcrumbs = array();

    public function getBreadcrumbs()
    {
        return $this->_breadcrumbs;
    }

    public function setBreadcrumbs($v)
    {
        $this->_breadcrumbs = $v;
    }

    /**
     * Builds and sets the breadcrumbs.
     * @param array $items the list of breadcrumb items as label => URL
     * @param array $rootItem override the root breadcrumb item.
     */
    public function buildBreadcrumbs(array $items, array $rootItem = array())
    {
        $breadcrumbs = array();

        !empty($rootItem)
            ? $breadcrumbs[$rootItem[0]] = $rootItem[1] // override breadcrumb root
            : $breadcrumbs[Yii::app()->breadcrumbRootLabel] = Yii::app()->homeUrl;

        foreach ($items as $label => $url) {
            // Disable links to browse pages
            if ($url[0] === 'browse') {
                $url = array();
            }

            if (!isset($breadcrumbs[$label])) {
                $breadcrumbs[$label] = $url;
            }
        }

        $this->breadcrumbs = $breadcrumbs;
    }

    /**
     * Renders the breadcrumbs.
     * The rendering logic is based on TbBreadcrumbs::run().
     */
    public function renderBreadcrumbs()
    {
        $breadcrumbs = $this->breadcrumbs;

        if (count($this->breadcrumbs) > 0) {
            ob_start();

            echo '<div class="row">';

            echo CHtml::openTag('ul', array('class' => 'breadcrumbs'));

            end($breadcrumbs);
            $lastLink = key($breadcrumbs);

            foreach ($breadcrumbs as $label => $url) {
                if (is_string($label) || is_array($url)) {
                    echo '<li>';
                    echo strtr('<a href="{url}">{label}</a>', array(
                        '{url}' => CHtml::normalizeUrl($url),
                        '{label}' => CHtml::encode($label),
                    ));
                } else {
                    echo '<li class="active">';
                    echo str_replace('{label}', CHtml::encode($url), '{label}');
                }

                if ($lastLink !== $label) {
                    echo '';
                }

                echo '</li>';
            }

            echo CHtml::closeTag('ul');

            echo '</div>';

            return ob_get_clean();
        } else {
            return '';
        }
    }

    /**
     * Sets the page title.
     * @param string|array $title the full title or an array of title fragments.
     * @param boolean $includeAppName whether to include the app name in the page title. Defaults to false.
     * @param string $separator the separator character (and whitespace) between fragments.
     * @override CController::setPageTitle()
     */
    public function setPageTitle($title, $includeAppName = false, $separator = ' - ')
    {
        if (is_array($title)) {
            $value = implode($separator, $title);
        } else {
            $value = $title;
        }

        if ($includeAppName) {
            $value .= $separator . Yii::app()->name;
        }

        parent::setPageTitle($value);
    }

} 