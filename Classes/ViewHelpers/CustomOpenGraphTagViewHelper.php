<?php

namespace RGU\MetaseoVhs\ViewHelpers;

/**
 * Set custom opengraph tag
 *
 * = Examples =
 *
 * <code title="Default">
 * <mvhs:customOpenGraphTag key="og:title">title</mvhs:customOpenGraphTag>
 * </code>
 *
 */
class CustomOpenGraphTagViewHelper extends AbstractViewHelper
{

  /**
   * Arguments initialization
   *
   * @return void
   */
  public function initializeArguments()
  {
      $this->registerArgument('key', 'string', 'OpenGraph name', TRUE);
  }

  /**
   * Renders the view
   *
   * @return string The rendered view
   */
  public function render()
  {

    $this->metaseoConnector->setCustomOpenGraphTag($this->arguments['key'], $this->renderChildren());

  }

}
