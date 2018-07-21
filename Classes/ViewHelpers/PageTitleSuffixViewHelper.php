<?php

namespace RGU\MetaseoVhs\ViewHelpers;

/**
 * Set the page title suffix
 *
 * = Examples =
 *
 * <code title="Default">
 * <mvhs:pageTitleSuffix>page title suffix</mvhs:pageTitle>
 * </code>
 *
 */
class PageTitleSuffixViewHelper extends AbstractViewHelper
{

  /**
   * Renders the view
   *
   * @return string The rendered view
   */
  public function render()
  {

    $this->metaseoConnector->setPageTitleSuffix($this->renderChildren());

  }

}
