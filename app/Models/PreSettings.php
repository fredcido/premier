<?php

namespace PremierNewsletter\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class PreSettings extends Eloquent
{
    protected $table = 'pre_settings';
    protected $fillable = array('mailgun_private_key');
    public $timestamps = false;
}
