<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ClassRoom;
use App\Models\Student;
use App\Models\StudentViolation;
use App\Models\Violation;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display admin dashboard with statistics
     */
    public function index()
    {
        $totalStudents = Student::count();
        $totalClasses = ClassRoom::count();
        $todayViolations = StudentViolation::whereDate('date', today())->count();

        // Student with highest points
        $highestPointsStudent = Student::orderBy('total_points', 'desc')->first();

        // Student with lowest points (eligible for reward)
        $lowestPointsStudent = Student::where('total_points', 0)->first();

        // Recent violations
        $recentViolations = StudentViolation::with(['student.classRoom', 'violation', 'creator'])
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();

        // Statistics by class
        $classesStat = ClassRoom::withCount('students')
            ->get();

        // Statistics by points range
        $pointsStats = [
            'safe' => Student::where('total_points', '>=', 0)->where('total_points', '<', 50)->count(),
            'warning' => Student::where('total_points', '>=', 50)->where('total_points', '<', 100)->count(),
            'danger' => Student::where('total_points', '>=', 100)->where('total_points', '<', 150)->count(),
            'critical' => Student::where('total_points', '>=', 150)->count(),
        ];

        $pageData = $this->setPageData('Dashboard', [
            ['title' => 'Home', 'url' => route('admin.dashboard')],
            ['title' => 'Dashboard']
        ]);

        return view('admin.dashboard', array_merge(compact(
            'totalStudents',
            'totalClasses',
            'todayViolations',
            'highestPointsStudent',
            'lowestPointsStudent',
            'recentViolations',
            'classesStat',
            'pointsStats'
        ), $pageData));
    }

    /**
     * Get violations chart data
     */
    public function getViolationsChartData(Request $request)
    {
        $mode = $request->get('mode', 'weekly'); // weekly, monthly, yearly

        $data = [];
        $categories = [];

        switch ($mode) {
            case 'weekly':
                // Last 7 days
                for ($i = 6; $i >= 0; $i--) {
                    $date = Carbon::today()->subDays($i);
                    $count = StudentViolation::whereDate('date', $date)->count();
                    $categories[] = $date->format('D');
                    $data[] = $count;
                }
                break;

            case 'monthly':
                // Last 12 months
                for ($i = 11; $i >= 0; $i--) {
                    $month = Carbon::now()->subMonths($i);
                    $count = StudentViolation::whereYear('date', $month->year)
                        ->whereMonth('date', $month->month)
                        ->count();
                    $categories[] = $month->format('M Y');
                    $data[] = $count;
                }
                break;

            case 'yearly':
                // Last 5 years
                for ($i = 4; $i >= 0; $i--) {
                    $year = Carbon::now()->subYears($i)->year;
                    $count = StudentViolation::whereYear('date', $year)->count();
                    $categories[] = (string) $year;
                    $data[] = $count;
                }
                break;
        }

        return response()->json([
            'categories' => $categories,
            'data' => $data
        ]);
    }
}
