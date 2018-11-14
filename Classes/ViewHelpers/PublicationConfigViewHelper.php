<?php
/**
 * Created by PhpStorm.
 * User: mvielmetter
 * Date: 20.11.17
 * Time: 14:12
 */

namespace Ph2\Publications\ViewHelpers;


use Ph2\Publications\Model\PublicationsModel;
use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;

class PublicationConfigViewHelper extends AbstractViewHelper
{
    /**
     * Initalize the Arguments for this ViewHelper
     */
    public function initializeArguments()
    {
        parent::initializeArguments();

        $this->registerArgument('pubTypeFilter', 'string', 'A list of Pubtypes to show', false, '2');
        $this->registerArgument('thesisTypeFilter', 'string', 'A list of Thesistypes to show', false, '2');
        $this->registerArgument('affiliationsFilter', 'string', 'The list of affiliations to show', false, '');
        $this->registerArgument('authorFilter', 'string', 'The Authors to filter', false, '');
        $this->registerArgument('titleFilter', 'string', 'The Title to filter', false, '');
        $this->registerArgument('keywordFilter', 'string', 'The keywords to filter', false, '');
        $this->registerArgument('orderBy', 'integer', '0: Sort by year, month, 1: sort by Year, PubStatus, Month', false, 0);
        $this->registerArgument('splitType', 'boolean', 'Split Type', false, false);
        $this->registerArgument('splitYears', 'boolean', 'Split Years', false, false);
    }

    /**
     * @return string
     */
    public function render()
    {
        $pubs = PublicationsModel::getInstance();

        foreach ([
                     'pubTypeFilter',
                     'thesisTypeFilter',
                     'affiliationsFilter',
                     'authorFilter',
                     'titleFilter',
                     'keywordFilter',
                     'splitType',
                 ] as $arg) {
            $pubs->setConfigParam($arg, $this->arguments[$arg]);
        }

        switch ($this->arguments['orderBy']) {
            case 1:
                $pubs->setConfigParam('orderBy', 'publications.year DESC, publications.month DESC');
                break;
            case 2:
                $pubs->setConfigParam('orderBy', 'publications.year DESC, Field(pubstatus,2,3,1), publications.month DESC');
                break;
        }

        return '';
    }
}