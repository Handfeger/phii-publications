<?php
/**
 * Created by PhpStorm.
 * User: mvielmetter
 * Date: 23.11.17
 * Time: 16:12
 */

namespace Ph2\Publications\ViewHelpers;


use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;

class PublicationTypeViewHelper extends AbstractViewHelper
{
    /**
     * @param string $pubType The publication type to translate
     * @param string $thesisType The thesis type to translate
     * @return string the Title to be displayed
     */
    public function render($pubType = "1", $thesisType = "1")
    {
        $pubTypes = Array(
            1 => "Articles",
            2 => "Theses",
            3 => "Proceedings",
            4 => "In Proceedings",
            5 => "Books",
            6 => "Articles in a book",
            7 => "In a collection",
            8 => "Manuals",
            9 => "Techreports",
            10 => "Booklets",
            11 => "Unpublished",
            12 => "Miscellaneous",
        );
        $thesisTypes = Array(
            1 => "PhD thesis",
            2 => "Diploma thesis",
            3 => "Master thesis",
            4 => "Bachelor thesis",
            5 => "Staatsexamens thesis",
        );
        return $pubType == 2 ? $thesisTypes[$thesisType] : $pubTypes[$pubType];
    }
}