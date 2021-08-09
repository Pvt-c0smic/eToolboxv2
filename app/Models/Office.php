<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Office extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['code', 'description'];

    protected $searchableFields = ['*'];

    protected $table = 'rf_offices';

    public function compliances()
    {
        return $this->hasMany(Compliance::class);
    }

    public function allPersonnel()
    {
        return $this->hasMany(Personnel::class);
    }
}
