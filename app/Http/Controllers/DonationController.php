<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\Donation;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class DonationController extends Controller
{
    public function create(Request $request)
    {
        $campaigns = Campaign::where('status', 'active')->get();
        $projects = Project::where('status', 'active')->get();

        $selectedCampaignId = $request->query('campaign_id');
        $selectedProjectId = $request->query('project_id');
        $prefillAmount = $request->query('amount', 2500);

        return view('donate', compact(
            'campaigns',
            'projects',
            'selectedCampaignId',
            'selectedProjectId',
            'prefillAmount'
        ));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'amount_option' => 'nullable|string',
            'amount_custom' => 'nullable|numeric|min:1',
            'campaign_id' => 'nullable|exists:campaigns,id',
            'project_id' => 'nullable|exists:projects,id',
            'donor_name' => 'required|string|max:150',
            'email' => 'required|email|max:150',
            'phone' => 'nullable|string|max:40',
            'anonymous' => 'nullable|boolean',
            'payment_method' => 'required|string|in:test_gateway,bank_transfer,stripe_sandbox',
            'message' => 'nullable|string|max:1000',
        ]);

        // Calculate final amount
        $amount = null;
        if ($request->filled('amount_custom') && (float)$request->input('amount_custom') > 0) {
            $amount = (float)$request->input('amount_custom');
        } elseif ($request->filled('amount_option') && (float)$request->input('amount_option') > 0) {
            $amount = (float)$request->input('amount_option');
        }

        if (!$amount || $amount < 1) {
            return back()->withInput()->withErrors(['amount_custom' => 'Please select or enter a valid donation amount (minimum Rs. 100.00).']);
        }

        // Generate unique receipt tracking code
        $receiptCode = 'SDC-' . date('Y') . '-' . strtoupper(Str::random(6));

        // Create verified test donation
        $donation = Donation::create([
            'user_id' => Auth::id() ?? null,
            'campaign_id' => $validated['campaign_id'] ?? null,
            'project_id' => $validated['project_id'] ?? null,
            'donor_name' => $validated['anonymous'] ?? false ? 'Generous Donor (Anonymous)' : $validated['donor_name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? null,
            'amount' => $amount,
            'payment_method' => $validated['payment_method'],
            'anonymous' => $validated['anonymous'] ?? false,
            'message' => $validated['message'] ?? null,
            'status' => 'completed', // Processed through verified test sandbox workflow
            'receipt_code' => $receiptCode,
        ]);

        // Update campaign totals if linked
        if ($donation->campaign_id) {
            $campaign = Campaign::find($donation->campaign_id);
            if ($campaign) {
                $campaign->increment('amount_raised', $amount);
                $campaign->increment('donor_count', 1);
            }
        }

        // Update project totals if linked
        if ($donation->project_id) {
            $project = Project::find($donation->project_id);
            if ($project) {
                $project->increment('amount_raised', $amount);
            }
        }

        return redirect()->route('donate.confirmation', ['receipt_code' => $receiptCode])
            ->with('success', 'Your generous donation has been successfully processed in Test Mode!');
    }

    public function confirmation($receiptCode)
    {
        $donation = Donation::with('campaign', 'project')
            ->where('receipt_code', $receiptCode)
            ->firstOrFail();

        return view('donate.confirmation', compact('donation'));
    }
}
