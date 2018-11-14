<?php
/**
 * Created by PhpStorm.
 * User: mvielmetter
 * Date: 17.11.17
 * Time: 15:20
 */

namespace Ph2\Publications\Model;


class AffiliationsModel extends AbstractModel
{
    protected $affiliations;

    /**
     * queries for affiliations and stores them in $this->affiliations
     */
    protected function queryAffiliations()
    {
        $query = $this->db->query('SELECT id,title FROM affiliation ORDER BY id ASC');
        $this->affiliations = $query->fetchAll(\PDO::FETCH_OBJ);
    }

    /**
     * @return mixed
     */
    public function getAffiliations()
    {
        if ($this->affiliations == null) {
            $this->queryAffiliations();
        }

        return $this->affiliations;
    }

    public function getAffiliationsNameId()
    {
        $ret = array();
        foreach ($this->getAffiliations() as $aff) {
            $ret[] = [$aff->title, $aff->id];
        }
        return $ret;
    }
}