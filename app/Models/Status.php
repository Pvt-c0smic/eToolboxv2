<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Status extends Model
{
    use SoftDeletes;
    use HasFactory;
    use Searchable;

    protected $fillable = ['name', 'description'];

    protected $searchableFields = ['*'];

    protected $table = 'rf_statuses';

    public function compliances()
    {
        return $this->hasMany(Compliance::class);
    }
}
