<?php

namespace RGU\MetaseoVhs\ViewHelpers;

/**
 * Set the sitemap index expiration
 *
 * = Examples =
 *
 * <code title="Default">
 * <mvhs:sitemapIndexExpiration>600</mvhs:sitemapIndexExpiration>
 * </code>
 *
 */
class SitemapIndexExpirationViewHelper extends AbstractViewHelper
{

  /**
   * Renders the view
   *
   * @return string The rendered view
   */
  public function render()
  {

    $this->metaseoConnector->setSitemapIndexExpiration(intval($this->renderChildren()));

  }

}
