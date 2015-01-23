<?php
/**
 * Description of TmpCotizador
 *
 * @author Andres
 */
class TmpCotizador extends Eloquent {

    protected $table = 'tmp_cotizador';

    // Put this in any model and use
    // Modelname::findOrCreate($id);
    public static function findOrCreate($column, $id) {
        $obj = static::where($column, '=', $id)->first();
        //$obj = static::find($id);
        return $obj ? : new static;
    }

}
