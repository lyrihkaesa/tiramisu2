<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class barang extends Model
{
    protected $fillable = [
    	'nama', 'slug',
      	'type', 'typeslug',
      	'pics', 'stats',
      	'drop', 'quest',
      	'blacksmith', 'resep',
      	'proc', 'prod'
    ];
}