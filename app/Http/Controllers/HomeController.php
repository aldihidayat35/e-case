<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\StudentViolation;
use App\Models\ClassRoom;
use App\Models\Violation;
use App\Models\Reward;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Display public home page with leaderboard
     */
   public function index()
    {
        // Recent violations for transparency
        $recentViolations = StudentViolation::with(['student.classRoom', 'violation'])
            ->orderBy('date', 'desc')
            ->take(5)
            ->get();

        // Recent rewards
        $recentRewards = Reward::with('student')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // Statistics
        $totalStudents   = Student::count();
        $totalViolations = StudentViolation::count();
        $totalRewards    = Reward::count();
        $totalClasses    = ClassRoom::count();

        // Student status by points
        $goodStudents    = Student::where('total_points', 0)->count();
        $warningStudents = Student::where('total_points', '>', 0)
                                  ->where('total_points', '<', 20)
                                  ->count();
        $dangerStudents  = Student::where('total_points', '>=', 20)->count();

        // ✅ Top 10 most disciplined students (INCLUDING point = 0)
        $topStudents = Student::with('classRoom')
            ->orderBy('total_points', 'asc')
            ->orderBy('name', 'asc')
            ->take(10)
            ->get();

        // Monthly violations data (last 6 months)
        $monthlyData = [
            'labels' => [],
            'data'   => []
        ];

        for ($i = 5; $i >= 0; $i--) {
            $month = Carbon::now()->subMonths($i);
            $monthlyData['labels'][] = $month->format('M Y');
            $monthlyData['data'][]   = StudentViolation::whereYear('date', $month->year)
                ->whereMonth('date', $month->month)
                ->count();
        }

        // Top 5 violations
        $topViolations = Violation::withCount('studentViolations')
            ->orderBy('student_violations_count', 'desc')
            ->take(5)
            ->get();

        // Violations per class
        $classData = [
            'labels' => [],
            'data'   => []
        ];

        $classViolations = ClassRoom::all();
        foreach ($classViolations as $class) {
            $classData['labels'][] = $class->name;
            $classData['data'][] = StudentViolation::whereHas('student', function ($q) use ($class) {
                $q->where('class_id', $class->id);
            })->count();
        }

        // App Data
        $appData = \App\Models\AppData::getAppData();

        return view('home', compact(
            'recentViolations',
            'recentRewards',
            'topStudents',
            'totalStudents',
            'totalViolations',
            'totalRewards',
            'totalClasses',
            'goodStudents',
            'warningStudents',
            'dangerStudents',
            'monthlyData',
            'topViolations',
            'classData',
            'appData'
        ));
    }
}
