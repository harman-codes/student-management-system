<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Classtest extends Model
{
    use HasFactory;


//    public function schoolclass(): BelongsTo
//    {
//        return $this->belongsTo(Schoolclass::class);
//    }

    protected function casts()
    {
        return [
            'marksobtained' => 'array',
        ];
    }

    /*Accessors*/
    protected function subject(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => ucwords($value),
        );
    }


    protected function percentage(): Attribute
    {
        return Attribute::make(
            get: function(mixed $value, array $attributes){
                $maxMarks = (int)$attributes['maxmarks'];
                $marksObtainedCell = (array)$this->jsonSerialize()['marksobtained'];

//                $marksObtainedByCurrentStudent = array_filter($marksObtainedCell, function($key){
//                    return $key==2;
//                }, ARRAY_FILTER_USE_KEY);

                foreach ($marksObtainedCell as $studentId => $mo){
                    if($studentId==2){
                        if(!empty($maxMarks)&&!empty($mo)){
                            return round(($mo/$maxMarks)*100,2);
                        }
                    }else{
                        return '';
                    }
                }
            }
        );
    }

}
