<?php

namespace RGU\MetaseoVhs\ViewHelpers;

/**
 * Set the page title
 *
 * = Examples =
 *
 * <code title="Default">
 * <mvhs:pageTitle updateTsfe="1">page title</mvhs:pageTitle>
 * </code>
 *
 */
class PageTitleViewHelper extends AbstractViewHelper
{

  /**
   * Arguments initialization
   *
   * @return void
   */
    public function initializeArguments()
    {
        $this->registerArgument('updateTsfe', 'boolean', 'Update TSFE values', false, '1');
    }

    /**
     * Renders the view
     *
     * @return string The rendered view
     */
    public function render()
    {
        $this->metaseoConnector->setPageTitle($this->renderChildren(), $this->arguments['updateTsfe']);
    }
}
