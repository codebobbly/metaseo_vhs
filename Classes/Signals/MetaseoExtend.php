<?php

namespace RGU\MetaseoVhs\Signals;

class MetaseoExtend {
    /**
     * Metaseo Signal for page metadata
     * see -> \Metaseo\Metaseo\Page\Part\MetatagPart->processMetaTags
     *
     * @param $args
     * @param $obj
     * @return array
     */
    public function metatagOutput($args, $obj) {
      // Modify the parameter $args here

      // There is a Issue in the mateseo extension. If the pageTitle is replaced, then the meta.title is wrong
      $rawTitle = !empty($GLOBALS['TSFE']->altPageTitle) ? $GLOBALS['TSFE']->altPageTitle : $GLOBALS['TSFE']->page['title'];

      if($args["meta.title"] && $args["meta.title"]["attributes"]["content"] !== $rawTitle) {
        $args["meta.title"]["attributes"]["content"] = $rawTitle;
      }

       return array($args, $obj);

    }

}
