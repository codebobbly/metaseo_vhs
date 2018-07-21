<?php

namespace RGU\MetaseoVhs\ViewHelpers;

/**
 * Set meta tag
 *
 * = Examples =
 *
 * <code title="Default">
 * <mvhs:canonical>/test/123</mvhs:canonical>
 * </code>
 *
 */
class CanonicalViewHelper extends AbstractViewHelper
{

  /**
   * Renders the view
   *
   * @return string The rendered view
   */
  public function render()
  {

    if (!empty($GLOBALS['TSFE'])) {
        $GLOBALS['TSFE']->page['tx_metaseo_canonicalurl'] = $this->renderChildren();
    }

  }

}
