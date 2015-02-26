

<?php
/**
 * Created by PhpStorm.
 * User: Tine
 * Date: 27/06/14
 * Time: 23:50
 */


class SearchedTerms extends Eloquent {
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'searched_terms';
	
	 public function user() {

        return $this->belongsTo('User', 'user_id');
    }
}