

<?php
/**
 * Created by PhpStorm.
 * User: Tine
 * Date: 27/06/14
 * Time: 23:50
 */


class Configuration extends Eloquent {
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'configuration';


    /**
     * returns configuration value for specified $key
     * @param $key
     * @return string value of configuration variable
     */
    public static function getValue($key) {

        $value = self::where('name', $key)->get(array('value'))->first();

        if($value) {
            return $value['value'];
        }

        return '';
    }
}