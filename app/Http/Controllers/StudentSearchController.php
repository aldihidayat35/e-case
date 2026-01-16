<?php

namespace App\Http\Controllers;

use App\Models\AppData;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentSearchController extends Controller
{
    /**
     * Show student search form
     */
    public function index()
    {
        $appData = AppData::first();
        return view('student-search', compact('appData'));
    }

    /**
     * Search student by NIS and display their data
     */
    public function search(Request $request)
    {
        $validated = $request->validate([
            'nis' => 'required|string',
        ]);

        $student = Student::with(['classRoom', 'violations.violation', 'rewards'])
            ->where('nis', $validated['nis'])
            ->first();

        if (!$student) {
            return back()->with('error', 'Siswa dengan NIS tersebut tidak ditemukan.');
        }

        $appData = AppData::first();
        return view('student-detail', compact('student', 'appData'));
    }
}
