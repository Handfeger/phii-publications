<?php
/**
 * Created by PhpStorm.
 * User: mvielmetter
 * Date: 17.11.17
 * Time: 17:53
 */

namespace Ph2\Publications\Model;

class PublicationsModel extends AbstractModel
{
    /**
     * @var PublicationsModel
     */
    static private $model;

    public static function getInstance()
    {
        if (empty(self::$model)) {
            self::$model = new PublicationsModel();
        }

        return self::$model;
    }

    /**
     * @var \Countable
     */
    protected $publications;

    /**
     * @var array
     */
    protected $config = [
        //        'fields' => '*',
        'pubTypeFilter'      => NULL,
        'thesisTypeFilter'   => NULL,
        'affiliationsFilter' => NULL,
        'authorFilter'       => '',
        'titleFilter'        => '',
        'keywordFilter'      => '',
        'splitType'          => false,
        'orderBy'            => 'publications.year DESC, publications.month DESC',
    ];

    /**
     *
     */
    protected function queryPublications()
    {
        $pubTypeFilter    = $this->quoteCommaString($this->config['pubTypeFilter']);
        $thesisTypeFilter = $this->quoteCommaString($this->config['thesisTypeFilter']);
        //Create SQL Query
        $sql = "SELECT 
                    publications.id,
                    publications.thesistype,
                    publications.type,
                    publications.year,
                    publications.author,
                    publications.title,
                    publications.pubstatus,
                    publications.doi,
                    publications.url,
                    publications.oai,
                    publications.filesize,
                    publications.journal,
                    publications.volume,
                    publications.number,
                    publications.pages,
                    publications.editor,
                    publications.booktitle,
                    publications.series,
                    publications.publisher,
                    publications.school,
                    publications.address,
                    publications.howpublished,
                    journals.title as journal_title,
                    journals.short_title
                FROM publications
                  LEFT JOIN journals ON publications.journal=journals.journal_id
                  LEFT JOIN pub_affil ON pub_affil.pubid=publications.id
                WHERE (publications.type IN ($pubTypeFilter)
                  OR publications.thesistype IN ($thesisTypeFilter)) ";

        $affiliationsFilter = $this->quoteCommaString($this->config['affiliationsFilter']);
        if (!empty($affiliationsFilter)) {
            $sql .= "AND pub_affil.affilid IN ($affiliationsFilter) ";
        }
        if (!empty($this->config['authorFilter'])) {
            $sql .= 'AND ' . $this->likePrepareSql($this->config['authorFilter'], 'publications.author') . ' ';
        }
        if (!empty($this->config['titleFilter'])) {
            $sql .= 'AND ' . $this->likePrepareSql($this->config['titleFilter'], 'publications.title') . ' ';
        }
        if (!empty($this->config['keywordFilter'])) {
            $sql .= 'AND ' . $this->likePrepareSql($this->config['keywordFilter'], 'publications.keywords') . ' ';
        }
        $sql .= 'GROUP BY publications.id ORDER BY ';
        if ($this->config['splitType']) {
            $sql .= 'publications.type ASC, ';
        }
        $sql .= $this->config['orderBy'];

        $query = $this->db->query($sql);

        $this->publications = $query->fetchAll(\PDO::FETCH_OBJ);
    }

    protected function lazyQuery()
    {
        if (empty($this->publications)) {
            $this->queryPublications();
        }
    }

    public function getPublications()
    {
        $this->lazyQuery();

        return $this->publications;
    }

    public function countRows()
    {
        return count($this->getPublications());
    }

    public function setConfigParam($param, $value)
    {
        $this->config[$param] = $value;
    }
}