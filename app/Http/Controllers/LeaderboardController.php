<?php

namespace App\Http\Controllers;

use App\Models\AppData;
use App\Models\ClassRoom;
use App\Models\Student;
use Illuminate\Http\Request;

class LeaderboardController extends Controller
{
    /**
     * Display leaderboard of student discipline
     */
    public function index(Request $request)
    {
        $query = Student::with('classRoom');

        // Filter by class
        if ($request->filled('class_id')) {
            $query->where('class_id', $request->class_id);
        }

        // Search by name or NIS
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                  ->orWhere('nis', 'like', '%' . $search . '%');
            });
        }

        // Order by total points ascending (lowest = most disciplined)
        // Get all students for DataTables to handle pagination
        $students = $query->orderBy('total_points', 'asc')
            ->orderBy('name', 'asc')
            ->get();

        $classes = ClassRoom::all();
        $appData = AppData::first();

        return view('leaderboard', compact('students', 'classes', 'appData'));
    }
}
