<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Beneficiary;
use App\Models\Campaign;
use App\Models\Donation;
use App\Models\Project;
use App\Models\VolunteerApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $dateFrom = $request->input('date_from', now()->subMonths(6)->toDateString());
        $dateTo = $request->input('date_to', now()->toDateString());

        // 1. Monthly Donations
        $monthlyDonations = Donation::where('status', 'completed')
            ->whereDate('created_at', '>=', $dateFrom)
            ->whereDate('created_at', '<=', $dateTo)
            ->selectRaw("DATE_FORMAT(created_at, '%Y-%m') as ym, DATE_FORMAT(created_at, '%b %Y') as month_name, SUM(amount) as total, COUNT(*) as count")
            ->groupBy('ym', 'month_name')
            ->orderBy('ym', 'asc')
            ->get();

        // 2. Campaign Fundraising Performance
        $campaignReports = Campaign::withCount('donations')
            ->get()
            ->map(function ($camp) {
                return [
                    'title' => $camp->title,
                    'target' => $camp->target_amount,
                    'raised' => $camp->amount_raised,
                    'percent' => $camp->progress_percent,
                    'donors' => $camp->donor_count,
                    'status' => $camp->status,
                ];
            });

        // 3. Projects Report
        $projectsReport = Project::select('status', DB::raw('count(*) as count'), DB::raw('SUM(target_amount) as total_target'), DB::raw('SUM(amount_raised) as total_raised'))
            ->groupBy('status')
            ->get();

        // 4. Volunteer Applications Status
        $volunteerStats = VolunteerApplication::select('status', DB::raw('count(*) as count'))
            ->groupBy('status')
            ->pluck('count', 'status')
            ->toArray();

        // 5. Beneficiary Applications Status
        $beneficiaryStats = Beneficiary::select('status', DB::raw('count(*) as count'))
            ->groupBy('status')
            ->pluck('count', 'status')
            ->toArray();

        $totalRaisedPeriod = Donation::where('status', 'completed')
            ->whereDate('created_at', '>=', $dateFrom)
            ->whereDate('created_at', '<=', $dateTo)
            ->sum('amount');

        return view('admin.reports.index', compact(
            'dateFrom',
            'dateTo',
            'monthlyDonations',
            'campaignReports',
            'projectsReport',
            'volunteerStats',
            'beneficiaryStats',
            'totalRaisedPeriod'
        ));
    }

    public function export(Request $request): StreamedResponse
    {
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="sdc_executive_financial_report_' . date('Y_m_d') . '.csv"',
        ];

        $campaigns = Campaign::all();

        return new StreamedResponse(function () use ($campaigns) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, ['Campaign Appeal', 'Category', 'Target Amount (LKR)', 'Verified Raised (LKR)', 'Completion %', 'Total Donors', 'Status']);

            foreach ($campaigns as $c) {
                fputcsv($handle, [
                    $c->title,
                    $c->category->name ?? 'General',
                    number_format($c->target_amount, 2, '.', ''),
                    number_format($c->amount_raised, 2, '.', ''),
                    $c->progress_percent . '%',
                    $c->donor_count,
                    $c->status,
                ]);
            }
            fclose($handle);
        }, 200, $headers);
    }
}
