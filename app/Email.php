<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    public $timestamps = false; //set time to false
    protected $fillable = [
    	'email'
    ];
    protected $primaryKey = 'id';
 	protected $table = 'tbl_emailsubcribe';

}
