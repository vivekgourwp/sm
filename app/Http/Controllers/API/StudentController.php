<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\Student;
use App\Models\Contact;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get student and their contact info
        $students = Student::with('contact')->get();
        if ($students->isEmpty()) {
            return response()->json(['message' => 'No students found'], 404);
        }
        return response()->json(['students' => $students], 200);
    }

    // /**
    //  * Show the form for creating a new resource.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // public function create()
    // {
    //     return view('students.create');
    // }

    /**
     * Store a newly created student resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name'    => 'required|string|max:255',
            'middle_name'   => 'nullable|string|max:255',
            'last_name'     => 'required|string|max:255',
            'gender'        => 'required|in:Male,Female,Other',
            'date_of_birth' => 'nullable|date',

            'email'         => 'required|email|unique:contacts,email',
            'phone_number'  => 'required|string|max:20',
            'address_line1' => 'required|string|max:255',
            'address_line2' => 'nullable|string|max:255',
            'city'          => 'nullable|string|max:100',
            'state'         => 'nullable|string|max:100',
            'postal_code'   => 'nullable|string|max:20',
            'country'       => 'nullable|string|max:100',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        $validated = $validator->validated();

        // Create contact
        $contact = Contact::create([
            'email'         => $validated['email'],
            'phone_number'  => $validated['phone_number'],
            'address_line1' => $validated['address_line1'],
            'address_line2' => $validated['address_line2'] ?? null,
            'city'          => $validated['city'] ?? null,
            'state'         => $validated['state'] ?? null,
            'postal_code'   => $validated['postal_code'] ?? null,
            'country'       => $validated['country'] ?? null,
        ]);

        // Create student
        $student = Student::create([
            'first_name'    => $validated['first_name'],
            'middle_name'   => $validated['middle_name'] ?? null,
            'last_name'     => $validated['last_name'],
            'gender'        => $validated['gender'],
            'date_of_birth' => $validated['date_of_birth'] ?? null,
            'contact_id'    => $contact->id,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Student successfully registered',
            'student' => $student,
            'contact' => $contact
        ], 201);
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $student = Student::with('contact')->findOrFail($id);
        return response()->json([
            'status' => true,
            'student' => [
                'id'            => $student->id,
                'contact_id'    => $student->contact_id,
                'first_name'    => $student->first_name,
                'middle_name'   => $student->middle_name,
                'last_name'     => $student->last_name,
                'gender'        => $student->gender,
                'date_of_birth' => $student->date_of_birth,
                'created_at'    => $student->created_at,
                'updated_at'    => $student->updated_at,
            ],
            'contact' => $student->contact,
        ]);
    }


    // /**
    //  * Show the form for editing the specified resource.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function edit($id)
    // {
    //     $student = Student::findOrFail($id);
    //     return view('students.edit', compact('student'));
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
//     public function update(Request $request, $id)
//     {
//         $student = Student::findOrFail($id);

//         $validated = $request->validate([
//             'name' => 'required|string|max:255',
//             'email' => 'required|email|unique:students,email,' . $student->id,
//         ]);
// echo $validated;
//         die;

//         $student->update($validated);

//         return redirect()->route('students.index')->with('success', 'Student updated successfully!');
//     }

//     /**
//      * Remove the specified resource from storage.
//      *
//      * @param  int  $id
//      * @return \Illuminate\Http\Response
//      */
//     public function destroy($id)
//     {
//         $student = Student::findOrFail($id);
//         $student->delete();

//         return redirect()->route('students.index')->with('success', 'Student deleted successfully!');
//     }
}
