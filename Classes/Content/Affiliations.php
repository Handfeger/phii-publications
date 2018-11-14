<?php
/**
 * Created by PhpStorm.
 * User: mvielmetter
 * Date: 16.11.17
 * Time: 13:39
 */

namespace Ph2\Publications\Content;


use Ph2\Publications\Model\AffiliationsModel;

class Affiliations
{
    /**
     * @var \Ph2\Publications\Model\AbstractModel
     */
    protected $db;

    /**
     * Affiliations constructor.
     */
    public function __construct()
    {
        $this->db = new AffiliationsModel();
    }

    /**
     * @return array
     */
    public function affiliationList($config)
    {
        $config['items'] = array_merge($config['items'], $this->db->getAffiliationsNameId());
        return $config;
    }
}