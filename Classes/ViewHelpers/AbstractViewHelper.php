<?php

namespace RGU\MetaseoVhs\ViewHelpers;

class AbstractViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractTagBasedViewHelper
{

    /**
     * Connector from Metaseo
     * @var \Metaseo\Metaseo\Connector
     */
    protected $metaseoConnector;

    /**
     * @param \Metaseo\Metaseo\Connector $metaseoConnector
     * @return void
     */
    public function injectMetaseoConnector(\Metaseo\Metaseo\Connector $metaseoConnector)
    {
        $this->metaseoConnector = $metaseoConnector;
    }

}
