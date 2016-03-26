<?php

namespace PremierNewsletter\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;
class ListEmail extends Eloquent
{
    protected $table = 'list_email';
    protected $guarded = array('id');
    public $timestamps = false;
}
