<?php
/**
 * Created by PhpStorm.
 * User: Tine
 * Date: 27/06/14
 * Time: 23:50
 */


class InstitutionSubdivision extends Eloquent {

    protected $table = 'institution_subdivision';

    public function institution() {

        return $this->belongsTo('Institution', 'institution_id');
    }

    public static function findByName($name) {
        return self::where('name', '=', $name)->first();
    }

} 