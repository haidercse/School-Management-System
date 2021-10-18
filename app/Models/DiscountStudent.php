<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiscountStudent extends Model
{
    use HasFactory;
    protected $fillable = [
        'assign_student_id',
        'fee_category_id',
        'discount'

    ];

    /**
     * Get the assignStudent that owns the DiscountStudent
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function assignStudent()
    {
        return $this->belongsTo(AssignStudent::class, 'assign_student_id', 'id');
    }

    /**
     * Get the studentFeeCategory that owns the DiscountStudent
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function studentFeeCategory()
    {
        return $this->belongsTo(StudentFeeCategory::class, 'fee_category_id', 'id');
    }
   
}
