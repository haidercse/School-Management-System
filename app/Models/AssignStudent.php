<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignStudent extends Model
{
    use HasFactory;
    protected $fillable = [
        'student_id', //student_id means student_id.
        'class_id',
        'year_id',
        'group_id',
        'shift_id',
    ];
     
    /**
     * Get the class that owns the AssignStudent
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function student()
    {
        return $this->belongsTo(User::class, 'student_id', 'id');
    }
    /**
     * Get the class that owns the AssignStudent
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function class()
    {
        return $this->belongsTo(StudentClass::class, 'class_id', 'id');
    }
    /**
     * Get the class that owns the AssignStudent
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function year()
    {
        return $this->belongsTo(StudentYear::class, 'year_id', 'id');
    }
    /**
     * Get the class that owns the AssignStudent
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function group()
    {
        return $this->belongsTo(StudentGroup::class, 'group_id', 'id');
    }
    /**
     * Get the class that owns the AssignStudent
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function shift()
    {
        return $this->belongsTo(StudentShift::class, 'shift_id', 'id');
    }

    /**
     * Get the discount that owns the AssignStudent
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function discount()
    {
        return $this->belongsTo(DiscountStudent::class, 'id', 'assign_student_id');
    }
}
