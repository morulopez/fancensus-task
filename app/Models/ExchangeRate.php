<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExchangeRate extends Model
{
    use HasFactory;
    protected $fillable = [
        'country_name', 
        'country_code', 
        'currency_name', 
        'currency_code', 
        'rate_new'
    ];

    /**
     * Scope function for search data by country_code or country_name
     *
     * @param [type] $query
     * @param [type] $valueName
     * @return void
     */
    public function scopeSearch($query,$valueName){
        return $query->select('*')->where('country_code','like',"%$valueName%")->orWhere('country_name','like',"%$valueName%");
    }
}
