<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Post extends Model
{
	use SoftDeletes;
    //if we have class name differrent than table name we must clearify it 
    //protected $table='posts'
    //protected $primaryKey='post_id'
   
    protected $dates =['deleted_at'];
    protected $fillable =[
    	'title',
    	'content'
    ];
    #abovee code is done to create db usning mass assignment technique used in line 114 114 116 117

    public function user(){
    	return $this -> belongsTo('App\User');
    }

}
