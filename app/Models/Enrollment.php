<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Enrollment extends Model
{
    use HasFactory;

    protected $fillable = ['student_id' ,'course_id'];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function store(Request $request)
{
    $request->validate([
        'student_id' => 'required|exists:students,id',
        'course_id' => 'required|exists:courses,id',
    ]);

    Enrollment::create([
        'student_id' => $request->student_id,
        'course_id' => $request->course_id,
    ]);

    return redirect()->back()->with('success', 'Student enrolled successfully!');
}

}
