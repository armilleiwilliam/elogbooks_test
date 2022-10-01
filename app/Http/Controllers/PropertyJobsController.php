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
     * List of jobs
     * @return Illuminate\View\View
     */
    public function index(): View
    {
        return view("front.list");
    }

    /**
     * Return a list of jobs
     * @return JsonResponse
     */
    public function jobsList(): JsonResponse
    {
        $allJobs = Job::sanitizeJobList();
        return $this->success('success', ['jobs' => $allJobs]);
    }


    /**
     * Return a list of properties
     * @return JsonResponse
     */
    public function propertyList(): JsonResponse
    {
        $allProperties = Property::sanitizePropertyList();
        return $this->success('success', ['properties' => $allProperties]);
    }

    /**
     * Create a job form
     * @return View
     */
    public function create(): View
    {
        return view("front.create");
    }

    /**
     * Edit job
     * @param $id
     * @return View
     */
    public function edit($id): View
    {
        $job = Job::findOrFail($id);
        $propertyList = Property::all()->sortBy("name");

        return view("front.edit")->with(["job" => $job, "propertyList" => $propertyList]);
    }

    /**
     * Update a job
     * @param Request $request
     * @return View
     */
    public function update(Request $request, Job $id)
    {
        $request->validate([
            "summary" => "required|max:150",
            "description" => "required|max:500",
            "property" => "required|exists:properties,id",
            "user" => "required|exists:users,id"
        ]);

        $job = Job::findOrFail($id->id);
        $job->summary = $request->summary;
        $job->description = $request->description;
        $job->property_id = $request->property;
        $job->user_id = $request->user;
        $job->save();

        return redirect("/property-jobs/edit/$id->id")->with('success', 'Job has been updated successfully');;
    }

    /**
     * Store a job
     */
    public function store(Request $request): JsonResponse
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
