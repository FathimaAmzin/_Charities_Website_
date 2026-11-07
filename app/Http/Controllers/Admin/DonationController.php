<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Campaign;
use App\Models\Donation;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

class DonationController extends Controller
{
    public function index(Request $request)
    {
        $campaigns = Campaign::all();
        $query = Donation::with('campaign', 'project', 'user');

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('donor_name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('receipt_code', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        if ($request->filled('campaign_id')) {
            $query->where('campaign_id', $request->input('campaign_id'));
        }

        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->input('date_from'));
        }

        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->input('date_to'));
        }

        $donations = $query->orderBy('created_at', 'desc')->paginate(12)->withQueryString();
        $totalSum = (clone $query)->where('status', 'completed')->sum('amount');

        return view('admin.donations.index', compact('donations', 'campaigns', 'totalSum'));
    }

    public function show($id)
    {
        $donation = Donation::with('campaign', 'project', 'user')->findOrFail($id);
        return view('admin.donations.show', compact('donation'));
    }

    public function verify($id)
    {
        $donation = Donation::findOrFail($id);
        
        if ($donation->status !== 'completed') {
            $donation->update(['status' => 'completed']);

            // Update campaign if linked
            if ($donation->campaign_id) {
                $campaign = Campaign::find($donation->campaign_id);
                if ($campaign) {
                    $campaign->increment('amount_raised', $donation->amount);
                    $campaign->increment('donor_count', 1);
                }
            }

            return back()->with('success', "Donation {$donation->receipt_code} has been verified and marked as Completed.");
        }

        return back()->with('info', 'Donation is already marked as verified.');
    }

    public function exportCsv(Request $request): StreamedResponse
    {
        $query = Donation::with('campaign')->orderBy('created_at', 'desc');

        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        $donations = $query->get();

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="sdc_donations_report_' . date('Y_m_d') . '.csv"',
        ];

        return new StreamedResponse(function () use ($donations) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, ['Receipt Code', 'Donor Name', 'Email', 'Amount (LKR)', 'Program/Campaign', 'Payment Method', 'Status', 'Date']);

            foreach ($donations as $d) {
                fputcsv($handle, [
                    $d->receipt_code,
                    $d->donor_name,
                    $d->email,
                    number_format($d->amount, 2, '.', ''),
                    $d->campaign->title ?? 'General Humanitarian',
                    $d->payment_method,
                    $d->status,
                    $d->created_at->format('Y-m-d H:i:s'),
                ]);
            }
            fclose($handle);
        }, 200, $headers);
    }
}
