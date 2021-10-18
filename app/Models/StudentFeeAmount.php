<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



class StudentFeeAmount extends Model
{
    use HasFactory;
    protected $fillable = [
        'amount',
        'class_id',
        'fee_category_id',
    ];

    /**
     * Get the user that owns the StudentFeeAmount
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function Class()
    {
        return $this->belongsTo(StudentClass::class,'class_id','id');
    }

    /**
     * Get the user that owns the StudentFeeAmount
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function feeCategory()
    {
        return $this->belongsTo(StudentFeeCategory::class,'fee_category_id', 'id');
    }
}
