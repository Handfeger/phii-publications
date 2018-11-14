<?php
/**
 * Created by PhpStorm.
 * User: mvielmetter
 * Date: 23.11.17
 * Time: 17:01
 */

namespace Ph2\Publications\ViewHelpers;


use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;

class PublicationStatusViewHelper extends AbstractViewHelper
{
    /**
     * @param string $status The number of the status
     *
     * @return string the heading of the status
     */
    public function render($status = "1")
    {
        $pubStatus = [
            1 => "Published",
            2 => "Submitted",
            3 => "Accepted",
        ];

        return $pubStatus[$status] ?? "";
    }
}