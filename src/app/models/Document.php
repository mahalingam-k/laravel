<?php

class Document {

    private $client;
    private $doc;

    const DATE_FORMAT_NICE = 'd F Y';

    public function __construct() {
        $this->client = new \Solarium\Client(Config::get('solr'));
    }

    public static function getPermalink($id) {
        return '/document/' . $id;
    }

    public static function convertDateToSolrFormat($dateString) {
        return gmDate('Y-m-d\TH:i:s.z\Z', strtotime($dateString));
    }

    public static function convertDateFromSolrFormat($solrDate, $format = 'Y-m-d') {
        return date($format, strtotime($solrDate));
    }

    /**
     * Returns total number of found documents in solr index that match given institution name
     * @param string $institutionName
     * @return int number of found documents in solr index
     */
    public function getInstitutionCount($institutionName) {
        $query = $this->client->createSelect();
        $query->setRows(0);
        $query->setQuery(sprintf('institution_s:"%s"', $institutionName));
        $resultset = $this->client->select($query);

        if($resultset) {
            return $resultset->getNumFound();
        }
        return 0;
    }

    public function getNextSerialForYear($type, $year) {

        if($year != intval($year)) {
            Log::error('Invalid parameter specified for variable "year": ' . $year);
            return 1;
        }

        $serial = 0;

        $date = sprintf(
            'date:[%s TO %s]',
            self::convertDateToSolrFormat($year . '-01-01'),
            self::convertDateToSolrFormat(($year + 1) . '-01-01')
        );

        $query = $this->client->createSelect();
        $query->setRows(1);
        $query->setQuery(sprintf('type:%s AND %s', $type, $date));
        $query->setSorts(array('serial' => 'DESC'));
        $resultset = $this->client->select($query);
        //var_dump($query);

        if($resultset && $resultset->getNumFound()) {
            $serial = $document = $resultset->getDocuments()[0]->serial;
        }

        // increase serial by one
        $serial++;

        return $serial;
    }

}