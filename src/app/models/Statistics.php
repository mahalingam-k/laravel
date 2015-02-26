

<?php
/**
 * Created by PhpStorm.
 * User: Tine
 * Date: 27/06/14
 * Time: 23:50
 */


class Statistics extends Eloquent {
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'statistics';
	
	 public function user() {

        return $this->belongsTo('User', 'user_id');
    }
}