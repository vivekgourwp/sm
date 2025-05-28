<?php

namespace App\Http\Controllers;
use App\Models\Course;
use App\Models\Teacher;
use Illuminate\Http\Request;  
class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::with('teacher')->get(); // eager load the teacher
        return view('courses.index', compact('courses'));
    }

        public function create()
    {
        $teachers = Teacher::all();
         return view('courses.create', compact('teachers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'teacher_id' => 'required|exists:teachers,id',
        ]);

        Course::create([
            'name' => $request->name,
            'teacher_id' => $request->teacher_id,
        ]);

        return redirect()->route('courses.index')->with('success', 'Course created successfully!');
    }


}
