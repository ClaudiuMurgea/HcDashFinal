<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyAdmin extends Model
{
    protected $fillable = [
        'company_id',
        'user_id',
    ];

    public function Company ()
    {
        return $this->hasOne(Company::class, 'id', 'company_id');
    }
}
