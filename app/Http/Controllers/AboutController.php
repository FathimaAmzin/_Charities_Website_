<?php

namespace App\Http\Controllers;

use App\Models\Partner;
use App\Models\TeamMember;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        $partners = Partner::all();
        $testimonials = Testimonial::all();
        $boardMembers = TeamMember::boardOfDirectors()->active()->orderBy('order', 'asc')->get();

        return view('about', compact('partners', 'testimonials', 'boardMembers'));
    }
}
