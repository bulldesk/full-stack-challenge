<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LeadController extends Controller
{
    private $lead;

    /**
     * LeadController constructor.
     * @param $lead
     */
    public function __construct(Lead $lead)
    {
        $this->lead = $lead;
    }

    public function store(Request $request): JsonResponse
    {
        try {
            $this->lead->create($request->all());

            $return = ['msg' => 'O registro foi salvo.'];
            return response()->json($return, 201);
        } catch (\Exception $e) {
            if(config('app.debug')) {
                return response()->json($e->getMessage(), 500);
            }
            $return = ['msg' => 'Error ao salvar registro.'];
            return response()->json($return, 500);
        }
    }
}
