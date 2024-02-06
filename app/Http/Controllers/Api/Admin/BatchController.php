<?php

namespace App\Http\Controllers\Api\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class BatchController extends Controller
{
    /**
     * Retrieve all batches from the database.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $batches = DB::table('job_batches')->orderBy('created_at', 'desc')->get();

        return response()->json([
            'batches' => $batches,
        ]);
    }
}
