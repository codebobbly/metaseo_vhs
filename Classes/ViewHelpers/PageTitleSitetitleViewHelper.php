<?php

namespace RGU\MetaseoVhs\ViewHelpers;

/**
 * Set the page title sitetitle
 *
 * = Examples =
 *
 * <code title="Default">
 * <mvhs:pageTitleSitetitle>sitetitle</mvhs:pageTitleSitetitle>
 * </code>
 *
 */
class PageTitleSitetitleViewHelper extends AbstractViewHelper
{

  /**
   * Renders the view
   *
   * @return string The rendered view
   */
    public function render()
    {
        $this->metaseoConnector->setPageTitleSitetitle($this->renderChildren());
    }
}
