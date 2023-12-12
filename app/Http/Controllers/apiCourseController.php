<?php

namespace App\Http\Controllers;

use App\Models\Courses;
use Illuminate\Http\Request;

class apiCourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses = Courses::all();

        return response()->json([
            'courses' => $courses
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $course = Courses::create([
            'course' => $request->course,
            'mentor' => $request->mentor,
            'title' => $request->title
        ]);

        return response()->json([
            'course' => $course
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Courses  $courses
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $course = courses::find($id);

        if (!$course) {
            return response()->json([
                'message' => 'course tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'course' => $course
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Courses  $courses
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $course = courses::find($id);

        if (!$course) {
            return response()->json([
                'message' => 'course tidak ditemukan'
            ], 404);
        }

        $course->course = $request->input('course', $course->course);
        $course->mentor = $request->input('mentor', $course->mentor);
        $course->title = $request->input('title', $course->title);

        $course->save();

        return response()->json([
            'course' => $course
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Courses  $courses
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $course = courses::find($id);

        if (!$course) {
            return response()->json([
                'message' => 'course tidak ditemukan'
            ], 404);
        }

        $course->delete();

        return response()->json([
            'message' => 'course berhasil dihapus'
        ], 200);
    }
}
