<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class StudentAssignSubject extends Model
{
    use HasFactory;
    protected $fillable = [
        'class_id',
        'subject_id',
        'full_mark',
        'pass_mark',
        'get_mark'
    ];

    /**
     * Get the user that owns the StudentAssignSubject
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function Class()
    {
        return $this->belongsTo(StudentClass::class, 'class_id', 'id');
    }
     /**
     * Get the user that owns the StudentAssignSubject
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function Subject()
    {
        return $this->belongsTo(StudentSubject::class, 'subject_id', 'id');
    }
}
