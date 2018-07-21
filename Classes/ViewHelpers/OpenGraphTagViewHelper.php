<?php

namespace RGU\MetaseoVhs\ViewHelpers;

/**
 * Set opengraph tag
 *
 * = Examples =
 *
 * <code title="Default">
 * <mvhs:openGraphTag key="og:title">title</mvhs:openGraphTag>
 * </code>
 *
 */
class OpenGraphTagViewHelper extends AbstractViewHelper
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

    $this->metaseoConnector->setOpenGraphTag($this->arguments['key'], $this->renderChildren());

  }

}
