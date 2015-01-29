<?php
/**
 * Description of usersTrack
 *
 * @author programador1
 */
class CityData extends Eloquent {
    //put your code here
    /**
    * The database table used by the model.
    *
    * @var string
    */
    protected $table = 'params_cities';
    public $timestamps = false;
    
    // Put this in any model and use
    // Modelname::findOrCreate($id);
    
    public static function findOrCreate($column,$id)
    {
        $obj = static::where($column , '=', $id)->first();
        //$obj = static::find($id);
        return $obj ?: new static;
    }
}
