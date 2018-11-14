<?php
/**
 * Created by PhpStorm.
 * User: mvielmetter
 * Date: 20.11.17
 * Time: 13:38
 */

namespace Ph2\Publications\ViewHelpers;


use Ph2\Publications\Model\PublicationsModel;
use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;

class PublicationRowsViewHelper extends AbstractViewHelper
{
    public function render()
    {
        return PublicationsModel::getInstance()->countRows();
    }
}