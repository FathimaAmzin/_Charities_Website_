<?php

namespace App\Http\Controllers;

use App\Models\TeamMember;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    /**
     * Display the leadership and organizational teams.
     */
    public function index()
    {
        $boardOfDirectors = TeamMember::boardOfDirectors()->active()->orderBy('order', 'asc')->get();
        $executiveMembers = TeamMember::managingExecutives()->active()->orderBy('order', 'asc')->get();

        return view('teams.index', compact('boardOfDirectors', 'executiveMembers'));
    }
}
