<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Rank extends Model
{
    use SoftDeletes;
    use HasFactory;
    use Searchable;

    protected $fillable = ['code', 'description', 'personnel_type_id'];

    protected $searchableFields = ['*'];

    protected $table = 'rf_ranks';

    public function personnelTypes()
    {
        return $this->belongsTo(PersonnelType::class);
    }

    public function allPersonnel()
    {
        return $this->hasMany(Personnel::class);
    }
}
