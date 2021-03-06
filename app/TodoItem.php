<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use \Carbon\Carbon;
class TodoItem extends Model
{
    public function toggle(){
        if($this->completed_at){
            $this->completed_at = null;
        }
        else{
            $this->completed_at = Carbon::now()->toDateTimeString();
        }
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
