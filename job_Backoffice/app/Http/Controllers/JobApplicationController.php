<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JobApplication;
use App\Http\Requests\JobApplicationUpdateRequest;
class JobApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = JobApplication::latest();

        if($request->input("archived") == 'true'){
            $query->onlyTrashed();
        }

        $jobApplications = $query->paginate(10)->onEachSide(1);
        return view('jobApplication.index', compact('jobApplications'));
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $jobApplications = JobApplication::findOrFail($id);
        return view('jobApplication.show', compact('jobApplications'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $jobApplications = JobApplication::findOrFail($id);
        return view('jobApplication.edit', compact('jobApplications'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(JobApplicationUpdateRequest $request, string $id)
    {
        $application = JobApplication::findOrFail($id);
        $application->update([
            'status' => $request->input('status')
        ]);


        if($request->query('redirectToList') == 'false'){
            return redirect()->route('job-applications.show', $id )->with("success", "Job Application Updated Successfully");
        }
        return redirect()->route('job-applications.index')->with("success", "Job Application Updated Successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $jobApplications = JobApplication::findOrFail($id);
        $jobApplications->delete();
        return redirect()->route('job-applications.index')->with("success", "Job Application Archived Successfully");
    }

    /**
     * Restore the specified resource from storage.
     */
    public function restore(string $id)
    {
        $jobApplications = JobApplication::withTrashed()->findOrFail($id);

        $jobApplications->restore();
        return redirect()->route('job-applications.index', ['archived' => 'true'])->with("success", "Job Application Restored Successfully");
    }
}
