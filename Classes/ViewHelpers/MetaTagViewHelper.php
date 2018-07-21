<?php

namespace RGU\MetaseoVhs\ViewHelpers;

/**
 * Set meta tag
 *
 * = Examples =
 *
 * <code title="Default">
 * <mvhs:metaTag key="robots">noindex,follow</mvhs:metaTag>
 * </code>
 *
 */
class MetaTagViewHelper extends AbstractViewHelper
{

  /**
   * Arguments initialization
   *
   * @return void
   */
    public function initializeArguments()
    {
        $this->registerArgument('key', 'string', 'Metatag name', true);
    }

    /**
     * Renders the view
     *
     * @return string The rendered view
     */
    public function render()
    {
        $this->metaseoConnector->setMetaTag($this->arguments['key'], $this->renderChildren());
    }
}
