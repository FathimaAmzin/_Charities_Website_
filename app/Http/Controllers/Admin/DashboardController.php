<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Beneficiary;
use App\Models\Campaign;
use App\Models\CourseRequest;
use App\Models\Donation;
use App\Models\Project;
use App\Models\Service;
use App\Models\TeamMember;
use App\Models\User;
use App\Models\VolunteerApplication;
use App\Models\MemberApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Real database statistics
        $totalProjects = Project::count();
        $activeCampaigns = Campaign::where('status', 'active')->count();
        $totalDonors = User::where('role', 'donor')->count() + Donation::whereNull('user_id')->distinct('email')->count('email');
        $verifiedDonationsTotal = Donation::where('status', 'completed')->sum('amount');
        $registeredVolunteers = VolunteerApplication::count();
        $registeredMembers = MemberApplication::count();
        $pendingBeneficiaries = Beneficiary::where('status', 'pending')->count();
        $pendingVolunteers = VolunteerApplication::where('status', 'pending')->count();
        $pendingMembers = MemberApplication::where('status', 'pending')->count();
        $pendingCourseRequests = CourseRequest::where('status', 'pending')->count();
        $totalUsers = User::count();
        $totalServices = Service::count();
        $totalTeamMembers = TeamMember::count();

        // Recent Donations
        $recentDonations = Donation::with('campaign', 'project')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // Pending Tasks
        $pendingTasks = [
            'volunteers' => $pendingVolunteers,
            'members' => $pendingMembers,
            'beneficiaries' => $pendingBeneficiaries,
            'course_requests' => $pendingCourseRequests,
            'pending_donations' => Donation::where('status', 'pending')->count(),
            'active_campaigns' => $activeCampaigns,
        ];

        // Monthly Donation Aggregations for Chart (Continuous 6-Month Timeline)
        $months = collect();
        for ($i = 5; $i >= 0; $i--) {
            $carbon = \Carbon\Carbon::now()->subMonths($i);
            $ymKey = $carbon->format('Y-m');
            $months->put($ymKey, [
                'month_label' => $carbon->format('M Y'),
                'total' => 0.0,
                'count' => 0
            ]);
        }

        $startDate = \Carbon\Carbon::now()->subMonths(5)->startOfMonth();
        $dbDonations = Donation::where('status', 'completed')
            ->where('created_at', '>=', $startDate)
            ->selectRaw("DATE_FORMAT(created_at, '%Y-%m') as ym, DATE_FORMAT(created_at, '%b %Y') as month_label, SUM(amount) as total, COUNT(*) as count")
            ->groupBy('ym', 'month_label')
            ->get();

        foreach ($dbDonations as $d) {
            if ($months->has($d->ym)) {
                $months->put($d->ym, [
                    'month_label' => $d->month_label,
                    'total' => (float)$d->total,
                    'count' => (int)$d->count
                ]);
            }
        }

        $monthlyDonations = $months->values();

        // Project Status Distribution
        $projectStatuses = Project::select('status', DB::raw('count(*) as count'))
            ->groupBy('status')
            ->pluck('count', 'status')
            ->toArray();

        // Campaign Performance
        $topCampaigns = Campaign::orderBy('amount_raised', 'desc')
            ->take(4)
            ->get();

        return view('admin.dashboard', compact(
            'totalProjects',
            'activeCampaigns',
            'totalDonors',
            'verifiedDonationsTotal',
            'registeredVolunteers',
            'registeredMembers',
            'pendingBeneficiaries',
            'totalUsers',
            'totalServices',
            'recentDonations',
            'pendingTasks',
            'monthlyDonations',
            'projectStatuses',
            'topCampaigns'
        ));
    }
}
