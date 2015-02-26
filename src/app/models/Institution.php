<?php
/**
 * Created by PhpStorm.
 * User: Tine
 * Date: 27/06/14
 * Time: 23:50
 */


class Institution extends Eloquent {

    protected $table = 'institution';

    public function subdivisions() {

        return $this->hasMany('InstitutionSubdivision', 'institution_id');
    }

    public static function findByName($name) {
        return self::where('name', '=', $name)->first();
    }

    /**
     * overrides parent function to delete the related subdivision as well
     */
    public function delete() {

        $this->subdivisions()->delete();

        return parent::delete();
    }

    public function updateDocumentCount() {

        $solrDocument = new Document();
        $documentCount = $solrDocument->getInstitutionCount($this->name);

        $this->document_count = $documentCount;
        $this->save();
    }
}