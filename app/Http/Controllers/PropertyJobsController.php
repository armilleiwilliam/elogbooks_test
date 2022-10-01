<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Property;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Traits\ApiResponse;
use Illuminate\View\View;

class PropertyJobsController extends Controller
{
    use ApiResponse;

    /**
     * @return Illuminate\View\View
     */
    function index(): View
    {
        return view("front.list_jobs");
    }

    /**
     * @return JsonResponse
     */
    function jobsList(): JsonResponse
    {
        $allJobs = Job::sanitizeJobList();
        return $this->success('success', ['jobs' => $allJobs]);
    }


    /**
     * @return JsonResponse
     */
    function propertyList(): JsonResponse
    {
        $allProperties = Property::sanitizePropertyList();
        return $this->success('success', ['properties' => $allProperties]);
    }

    /**
     * Add job form
     * @return View
     */
    function addJob(): View
    {
        return view("front.add_job");
    }

    /**
     * Store a job
     */
    function store(Request $request): JsonResponse
    {
        $request->validate([
             "summary" => "required|max:150",
            "description" => "required|max:500",
            "property" => "required|exists:properties,id",
            "user" => "required|exists:users,id"
        ]);

        $addJob = Job::create([
            "summary" => $request->summary,
            "description" => $request->description,
            "property_id" => $request->property,
            "user_id" => $request->user
        ]);

        return $this->success('success');
    }
}
