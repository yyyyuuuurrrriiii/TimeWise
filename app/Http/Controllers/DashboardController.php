<?php

namespace App\Http\Controllers;

class DashboardController extends Controller
{
    public function index()
    {
        $now = now();

        // Greeting depends on the server's current hour.
        $hour = (int) $now->format('G');
        $greeting = $hour < 12 ? 'Good morning' : ($hour < 18 ? 'Good afternoon' : 'Good evening');

        // ---------------------------------------------------------------
        // SAMPLE DATA ONLY. Nothing below comes from the database.
        // Later: replace each block with Eloquent queries (tasks,
        // class_schedules, focus_sessions) and auth()->user()->name.
        // ---------------------------------------------------------------
        $sample = [
            'userName' => 'Jamie',
            'streak' => ['current' => 7, 'best' => 12],
            'tasks' => ['done' => 6, 'total' => 12, 'change' => '+12%'],
            'focus' => [
                'total' => '3h 42m',
                'week' => [
                    ['day' => 'Mon', 'height' => 35],
                    ['day' => 'Tue', 'height' => 55],
                    ['day' => 'Wed', 'height' => 45],
                    ['day' => 'Thu', 'height' => 85],
                    ['day' => 'Fri', 'height' => 50],
                    ['day' => 'Sat', 'height' => 40],
                    ['day' => 'Sun', 'height' => 28],
                ],
                'highlight' => 'Thu',
            ],
            'score' => ['value' => 86, 'label' => 'Excellent'],
            'todayTasks' => [
                ['title' => 'Finish literature essay outline', 'subject' => 'English Literature', 'priority' => 'Moderate', 'time' => '10:30 AM', 'done' => true],
                ['title' => 'Review calculus problem set', 'subject' => 'Mathematics', 'priority' => 'Hard', 'time' => '1:00 PM', 'done' => false],
                ['title' => 'Create biology flashcards', 'subject' => 'AP Biology', 'priority' => 'Easy', 'time' => '4:30 PM', 'done' => false],
                ['title' => 'Research history presentation', 'subject' => 'World History', 'priority' => 'Moderate', 'time' => '6:30 PM', 'done' => false],
            ],
            'nextClass' => [
                'title' => 'Advanced Calculus',
                'room' => 'Room 204',
                'detail' => 'Limits, continuity and derivatives',
                // The countdown starts from this many seconds on every page load.
                'sampleSecondsUntilStart' => 24 * 60 + 16,
                // Progress bar fills over this window before class (minutes).
                'windowMinutes' => 60,
            ],
            'laterToday' => [
                ['title' => 'AP Biology', 'time' => '2:00 PM', 'room' => 'Lab 3', 'length' => '90 min'],
            ],
        ];

        return view('dashboard.index', [
            'dateLabel' => $now->format('l, F j'),
            'greeting' => $greeting,
            'd' => $sample,
        ]);
    }
}
