<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JobVacancy;
use App\Models\User;
use App\Models\JobCategory;
use App\Models\Company;
use App\Http\Requests\JobVacancyCreateRequest;
use App\Http\Requests\JobVacancyUpdateRequest;
use Illuminate\Support\Facades\Hash;


class JobVacancyController extends Controller
{
    // public $jobVacancies = ['Technology', 'Finance', 'Healthcare', 'Education', 'Manufacturing', 'Retail', 'Other'];

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = JobVacancy::latest();

        if($request->input("archived") == 'true'){
            $query->onlyTrashed();
        }

        $jobVacancies = $query->paginate(10)->onEachSide(1);
        return view('jobVacancy.index', compact('jobVacancies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = JobCategory::all();
        $companies = Company::all();
        return view('jobVacancy.create', compact('categories', 'companies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(JobVacancyCreateRequest $request)
    {
        $validated = $request->validated();
        JobVacancy::create($validated);
        return redirect()->route('job-vacancies.index')->with("success", "Job Vacancy Created Successfully");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $jobVacancy = JobVacancy::findOrFail($id);

        return view('jobVacancy.show', compact('jobVacancy'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $jobVacancy = JobVacancy::findOrFail($id);
        $categories = JobCategory::all();
        $companies = Company::all();
        return view('jobVacancy.edit', compact('jobVacancy', 'categories', 'companies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(JobVacancyUpdateRequest $request, string $id)
    {
        $validated = $request->validated();
        $jobVacancy = JobVacancy::findOrFail($id);
        $jobVacancy->update($validated);


        if($request->query('redirectToList') == 'false'){
            return redirect()->route('job-vacancies.show', $id )->with("success", "Job Vacancy Updated Successfully");
        }
        return redirect()->route('job-vacancies.index')->with("success", "Job Vacancy Updated Successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $jobVacancy = JobVacancy::findOrFail($id);
        $jobVacancy->delete();
        return redirect()->route('job-vacancies.index')->with("success", "Job Vacancy Archived Successfully");
    }

    /**
     * Restore the specified resource from storage.
     */
    public function restore(string $id)
    {
        $jobVacancy = JobVacancy::withTrashed()->findOrFail($id);

        $jobVacancy->restore();
        return redirect()->route('job-vacancies.index', ['archived' => 'true'])->with("success", "Job Vacancy Restored Successfully");
    }
}
