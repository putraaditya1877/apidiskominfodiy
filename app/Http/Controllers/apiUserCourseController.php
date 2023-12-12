<?php

namespace App\Http\Controllers;

use App\Models\userCourse;
use Illuminate\Http\Request;

class apiUserCourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userCourse = userCourse::all();

        return response()->json([
            'userCourse' => $userCourse
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
        $userCourse= userCourse::create([
            'id_user' => $request->id_user,
            'id_course' => $request->id_course,
        ]);

        return response()->json([
            'userCourse' => $userCourse
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\userCourse  $userCourse
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $userCourse = userCourse::find($id);

        if (!$userCourse) {
            return response()->json([
                'message' => 'userCourse tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'userCourse' => $userCourse
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\userCourse  $userCourse
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $userCourse = userCourse::find($id);

        if (!$userCourse) {
            return response()->json([
                'message' => 'userCourse tidak ditemukan'
            ], 404);
        }

        $userCourse->id_user = $request->input('id_user', $userCourse->id_user);
        $userCourse->id_course = $request->input('id_course', $userCourse->id_course);
        $userCourse->save();

        return response()->json([
            'userCourse' => $userCourse
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\userCourse  $userCourse
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $userCourse = userCourse::find($id);

        if (!$userCourse) {
            return response()->json([
                'message' => 'userCourse tidak ditemukan'
            ], 404);
        }

        $userCourse->delete();

        return response()->json([
            'message' => 'userCourse berhasil dihapus'
        ], 200);
    }
}
