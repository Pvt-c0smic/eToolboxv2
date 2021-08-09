<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ComplianceAction extends Model
{
    use SoftDeletes;
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'compliance_id',
        'action_taken',
        'commander_comment',
        'percentage',
        'updated_date',
    ];

    protected $searchableFields = ['*'];

    protected $table = 'tr_compliance_actions';

    protected $casts = [
        'updated_date' => 'date',
    ];

    public function compliance()
    {
        return $this->belongsTo(Compliance::class);
    }
}
