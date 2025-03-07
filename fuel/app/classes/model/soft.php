<?php

namespace Orm;

class Model_Soft extends Model
{
    protected static $_soft_delete = true;
    protected static $_soft_delete_field = 'deleted_at';

    public static function delete($id = null)
    {
        if (isset(static::$_soft_delete) && static::$_soft_delete === true) {
            $model = static::find($id);
            if ($model) {
                $model->deleted_at = date('Y-m-d H:i:s');
                return $model->save();
            }
            return false;
        } else {
            return parent::delete($id);
        }
    }
}