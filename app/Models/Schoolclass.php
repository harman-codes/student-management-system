<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Schoolclass extends Model
{
    use HasFactory;

    public function students(): HasMany
    {
        return $this->hasMany(Studentdetail::class);
    }


    public function subjects(): BelongsToMany
    {
        return $this->belongsToMany(Subject::class);
    }


    public function exams(): HasMany
    {
        return $this->hasMany(Exam::class);
    }

    public function announcements(): BelongsToMany
    {
        return $this->belongsToMany(Announcement::class);
    }

    public function feeStructures(): BelongsToMany
    {
        return $this->belongsToMany(FeeStructure::class)
            ->withPivot('sessionyear');
    }

    /*with timetable*/
    public function timetables(): HasMany
    {
        return $this->hasMany(TimeTable::class);
    }
    /*has many TimeTableSlot*/
    public function timetableslots(): HasMany
    {
        return $this->hasMany(TimeTableSlot::class);
    }

    public function books(): BelongsToMany
    {
        return $this->belongsToMany(Book::class);
    }


//    public function classtests()
//    {
//        return $this->hasMany(Classtest::class);
//    }
}
