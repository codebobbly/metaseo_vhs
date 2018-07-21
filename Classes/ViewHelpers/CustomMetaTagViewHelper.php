<?php

namespace RGU\MetaseoVhs\ViewHelpers;

/**
 * Set custom meta tag
 *
 * = Examples =
 *
 * <code title="Default">
 * <mvhs:customMetaTag key="myTag">the value</mvhs:customMetaTag>
 * </code>
 *
 */
class CustomMetaTagViewHelper extends AbstractViewHelper
{

  /**
   * Arguments initialization
   *
   * @return void
   */
    public function initializeArguments()
    {
        $this->registerArgument('key', 'string', 'Metatag name', true);
    }

    /**
     * Renders the view
     *
     * @return string The rendered view
     */
    public function render()
    {
        $this->metaseoConnector->setCustomMetaTag($this->arguments['key'], $this->renderChildren());
    }
}
