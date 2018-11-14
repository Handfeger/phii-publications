<?php
/**
 * Created by PhpStorm.
 * User: mvielmetter
 * Date: 17.11.17
 * Time: 16:17
 */

namespace Ph2\Publications\ViewHelpers;


use Ph2\Publications\Model\PublicationsModel;
use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;

class PublicationViewHelper extends AbstractViewHelper
{
    /**
     * @return object
     */
    public function render()
    {
        return PublicationsModel::getInstance()->getPublications();
    }
}