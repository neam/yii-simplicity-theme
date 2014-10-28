<?php

/**
 * Class PageControls.
 *
 * Example:
 *
 * $this->widget(
 *     'application.widgets.PageControls',
 *     array(
 *         'left' => array(
 *             'icon' => TbHtml::ICON_CHEVRON_LEFT,
 *             'label' => Yii::t('app', 'Go Back'),
 *             'url' => array('/controller/action'),
 *             'htmlOptions => array('class' => 'my-custom-item-class'),
 *         ),
 *         'right' => array(
 *             'icon' => false, // no icon
 *             'label' => Yii::t('app', 'Next Step'),
 *             'url' => array('/controller/action'),
 *         ),
 *     )
 * );
 */
class PageControls extends CWidget
{
    public $left;
    public $center;
    public $right;

    protected $visibleItemCount = 0;

    /**
     * @inheritDoc
     */
    public function init()
    {
        parent::init();
        $this->initItems();
    }

    /**
     * @inheritDoc
     */
    public function run()
    {
        if ($this->visibleItemCount > 0) {
            $this->render('application.widgets.views.PageControls.view');
        }
    }

    /**
     * Normalizes an item.
     * @param array $item
     * @return array|null
     * @throws CException
     */
    public function normalizeItem($item)
    {
        if (is_array($item)) {
            // Items are visible by default
            if (!isset($item['visible'])) {
                $item['visible'] = true;
            }

            // Enforce boolean value for visibility
            if (!is_bool($item['visible'])) {
                throw new CException(Yii::t('app', 'Page control visibility must be a boolean.'));
            }

            // Increment total number of visible items
            if ($item['visible']) {
                $this->visibleItemCount += 1;
            }

            // Set default icon
            if (!isset($item['icon'])) {
                if ($item === $this->left) {
                    $item['icon'] = TbHtml::ICON_CHEVRON_LEFT;
                } else if ($item === $this->right) {
                    $item['icon'] = TbHtml::ICON_CHEVRON_RIGHT;
                }
            }

            return $item;
        } else {
            return null;
        }
    }

    /**
     * Initializes the items.
     */
    public function initItems()
    {
        $this->countVisibleItems();

        $this->left = $this->normalizeItem($this->left);
        $this->center = $this->normalizeItem($this->center);
        $this->right = $this->normalizeItem($this->right);
    }

    /**
     * Counts the total number of visible items.
     */
    public function countVisibleItems()
    {
        if (is_array($this->left) && $this->left['visible']) {
            $this->visibleItemCount++;
        }

        if (is_array($this->center) && $this->center['visible']) {
            $this->visibleItemCount++;
        }

        if (is_array($this->right) && $this->right['visible']) {
            $this->visibleItemCount++;
        }
    }

    /**
     * Renders an item.
     * @param array $item
     * @return string
     */
    public function renderItem($item)
    {
        // Set URL
        $url = isset($item['url'])
            ? $item['url']
            : array('#');

        // Set label and position icon
        $label = $item['label'];
        if (isset($item['icon'])) {
            if ($item === $this->left) {
                $label = TbHtml::icon($item['icon']) . ' ' . $item['label'];
            } else if ($item === $this->right) {
                $label = $item['label'] . ' ' . TbHtml::icon($item['icon']);
            }
        }

        // Get htmlOptions
        $htmlOptions = isset($item['htmlOptions'])
            ? $item['htmlOptions']
            : array();

        return TbHtml::link($label, $url, $htmlOptions);
    }
}
