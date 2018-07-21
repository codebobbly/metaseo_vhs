<?php

namespace RGU\MetaseoVhs\ViewHelpers;

/**
 * Set meta tag
 *
 * = Examples =
 *
 * <code title="Default">
 * <mvhs:disableMetaTag key="robots"/>
 * </code>
 *
 */
class DisableMetaTagViewHelper extends AbstractViewHelper
{

  /**
   * Arguments initialization
   *
   * @return void
   */
  public function initializeArguments()
  {
      $this->registerArgument('key', 'string', 'Metatag name', TRUE);
  }

  /**
   * Renders the view
   *
   * @return string The rendered view
   */
  public function render()
  {

    $this->metaseoConnector->disableMetaTag($this->arguments['key']);

  }

}
