<?php

namespace App\Models\Tickets;

use App\Models\BaseModel;

class TicketReplyFile extends BaseModel {

	protected $table = 'tickets_replies_files';
	protected $fillable = [];
	protected $guarded = [];


    /* *************************************************************
	 * S C O P E S
	* *************************************************************/
    public function scopeIdentification($query, $identification)
    {
    	return $query->where('identification', 'like', '%'.$identification.'%');
    }
}






