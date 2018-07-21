<?php

namespace RGU\MetaseoVhs\ViewHelpers;

/**
 * Set the page title Prefix
 *
 * = Examples =
 *
 * <code title="Default">
 * <mvhs:pageTitlePrefix>page title Prefix</mvhs:pageTitle>
 * </code>
 *
 */
class PageTitlePrefixViewHelper extends AbstractViewHelper
{

  /**
   * Renders the view
   *
   * @return string The rendered view
   */
  public function render()
  {

    $this->metaseoConnector->setPageTitlePrefix($this->renderChildren());

  }

}
