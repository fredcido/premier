<?php

namespace PremierNewsletter\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class PreSettings extends Eloquent
{
    protected $table = 'pre_settings';
    protected $guarded = array('id');
    public $timestamps = false;
}
