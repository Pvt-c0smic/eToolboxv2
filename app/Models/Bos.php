<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Bos extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['code', 'description'];

    protected $searchableFields = ['*'];

    protected $table = 'rf_bos';

    public function allPersonnel()
    {
        return $this->hasMany(Personnel::class);
    }
}
