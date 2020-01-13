<?php

namespace App\Http\Controllers;

use App\Jobs\ImportLead;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LeadController extends Controller
{
    public function importLeads(Request $request)
    {
        $leads = $request->get('csv');
        $user_id = Auth::user()->id;
        foreach ($leads as $key => $lead) {
            if ($key == count($leads) - 1) {
                ImportLead::dispatch($lead, $user_id, $key, true);
            } else {
                ImportLead::dispatch($lead, $user_id, $key);
            }
        }
    }
}
