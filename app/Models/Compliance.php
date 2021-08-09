<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Compliance extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'office_id',
        'start_date',
        'end_date',
        'project_name',
        'status_id',
    ];

    protected $searchableFields = ['*'];

    protected $table = 'tr_compliances';

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    public function office()
    {
        return $this->belongsTo(Office::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function complianceActions()
    {
        return $this->hasMany(ComplianceAction::class);
    }
}
