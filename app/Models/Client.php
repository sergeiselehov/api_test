<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    /**
     * Set the client phone.
     *
     * @param mixed $value
     * @return void
     */
    public function setPhoneAttribute($value)
    {
        $this->attributes['phone'] = (int) substr($value, -10);
    }
}
