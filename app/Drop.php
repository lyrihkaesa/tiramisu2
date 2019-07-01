<?php

namespace App;

use Watson\Rememberable\Rememberable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Drop extends Model
{
  	use Rememberable;

    protected $fillable = [
    	'name', 'sell', 'proses', 'note', 'picture'
    ];
  	public $timestamps = false;

  	public function dropType()
    {
      return $this->belongsTo(DropType::class);
    }

  	public function monsters()
    {
      return $this->belongsToMany(Monster::class, 'monster_drop');
    }

  	public function resep()
    {
      return $this->hasMany(Resep::class);
    }

  	public function fromQuest()
    {
      return $this->hasMany(NpcReward::class);
    }

  	public function dropDone()
    {
      return $this->hasOne(DropDone::class, 'drop_id');
    }

  	// get status by monster
  	public function getStatusMonsterAttribute()
    {
      $description = explode('[', trim($this->attributes['note']));

      return ! blank($description[0]) ?
        $description[0] : null;
    }

  	public function getStatusNpcAttribute()
    {
      if(Str::contains($this->attributes['note'], '[NPC: Pandai Besi]')) {
        $description = explode('[NPC: Pandai Besi]', trim($this->attributes['note']));

        $description = explode('[/NPC]', $description[1]);

        return head($description);
      }
    }
}