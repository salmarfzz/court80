<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coach extends Model
{
    use HasFactory;

    // Nama tabel di database
    protected $table = 'coaches';

    // Bolehkan semua kolom diisi
    protected $guarded = [];

    // Matikan timestamp default Laravel
    public $timestamps = false;
}