<?php

namespace IXOSoftware\PlanManagement\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Plan extends Model
{
     use SoftDeletes;

    protected $table = 'plans';

    protected $guarded  = [];

    public function options()
    {
        return $this->hasMany('IXOSoftware\PlanManagement\Models\PlanOption', 'plan_id', 'id');
    }
}
