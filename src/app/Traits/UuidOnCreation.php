<?php

namespace App\Traits;

trait UuidOnCreation
{
    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->id = uuid();
        });
    }
}
