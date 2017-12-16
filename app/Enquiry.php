<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Enquiry extends Model
{
    protected $guarded = [];

    public function getWebsitePageAttribute($value)
    {
        // this is a bad idea and will get extracted somewhere else at some point
        $tld = config('app.env') === "production" ? '.co.uk' : '.dev';
        return str_after($value, $tld);
    }
}
