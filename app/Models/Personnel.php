<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Personnel extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'last_name',
        'first_name',
        'middle_name',
        'email',
        'phone_number',
        'afpsn',
        'address',
        'rank_id',
        'bos_id',
        'office_id',
        'designation',
    ];

    protected $searchableFields = ['*'];

    protected $table = 'rf_personnel';

    public function bos()
    {
        return $this->belongsTo(Bos::class);
    }

    public function rank()
    {
        return $this->belongsTo(Rank::class);
    }

    public function office()
    {
        return $this->belongsTo(Office::class);
    }
}
