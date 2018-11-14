<?php
/**
 * Created by PhpStorm.
 * User: mvielmetter
 * Date: 29.11.17
 * Time: 11:10
 */

namespace Ph2\Publications\ViewHelpers;


use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;

class PublicationSeparatorViewHelper extends AbstractViewHelper
{
    /**
     * @param bool $compact Define whether the compact or the full version is shown
     * @return string
     */
    public function render($compact = true)
    {
        if ($compact) {
            return '<span>; </span>';
        } else {
            return '<br/>';
        }
    }
}