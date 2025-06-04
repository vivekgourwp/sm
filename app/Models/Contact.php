<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'phone_number', 'address_line1', 'email', 'phone_number', 'address_line2', 'city', 'state',
        'postal_code', 'country',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function students()
    {
        return $this->hasMany(Student::class); // if reused for multiple students
        // or ->hasOne(Student::class); if truly one-to-one
    }

}
