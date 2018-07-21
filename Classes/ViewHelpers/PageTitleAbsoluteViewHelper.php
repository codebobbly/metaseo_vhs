<?php

namespace RGU\MetaseoVhs\ViewHelpers;

/**
 * Set the page title (absolute)
 *
 * = Examples =
 *
 * <code title="Default">
 * <mvhs:pageTitleAbsolute updateTsfe="1">page title absolute</mvhs:pageTitleAbsolute>
 * </code>
 *
 */
class PageTitleAbsoluteViewHelper extends AbstractViewHelper
{

  /**
   * Arguments initialization
   *
   * @return void
   */
    public function initializeArguments()
    {
        $this->registerArgument('updateTsfe', 'boolean', 'Update TSFE values', false);
    }

    /**
     * Renders the view
     *
     * @return string The rendered view
     */
    public function render()
    {
        $this->metaseoConnector->setPageTitleAbsolute($this->renderChildren(), $this->arguments['updateTsfe']);
    }
}
