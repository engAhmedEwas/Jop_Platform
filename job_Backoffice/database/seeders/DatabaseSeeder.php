<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use App\Models\JobCategory;
use App\Models\Company;
use App\Models\JobVacancy;
use App\Models\Resume;
use App\Models\JobApplication;
// use App\Models\JobApplication;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        User::firstOrCreate([
            'email' => 'admin@admin.com',
        ],[
            'name' => 'Admin',
            'password' => Hash::make('123456789'),
            'role' => 'admin',
            'email_verified_at' => now(),
        ]);

        // include data file
        $jobData = json_decode(file_get_contents(database_path('data/job_data.json')), true);
        $Application = json_decode(file_get_contents(database_path('data/job_applications.json')), true);

        // create Job Category seeder
        foreach($jobData['jobCategories'] as $category){
            JobCategory::firstOrCreate([
                'name' => $category,
            ],[
                'name' => $category,
            ]);
        }

        // create Company and Company Owner seeder
        foreach($jobData['companies'] as $company){
            $companyOwner = User::firstOrCreate([
            'email' => fake()->unique()->safeEmail(),
            ],[
                'name' => fake()->name(),
                'password' => Hash::make('123456789'),
                'role' => 'company-owner',
                'email_verified_at' => now(),
            ]);
            Company::firstOrCreate([
                "name" => $company['name'],
            ],[
                "address" => $company['address'],
                "industry" => $company['industry'],
                "website" => $company['website'],
                "owner_id" => $companyOwner->id,
            ]);
        }

        // create Job jobVacancy seeder
        foreach($jobData['jobVacancies'] as $jobv){
            $company = Company::where('name', $jobv['company'])->firstOrFail();
            $category = JobCategory::where('name', $jobv['category'])->firstOrFail();
            JobVacancy::firstOrCreate([
                "title" => $jobv['title'],
                "company_id" => $company->id,
            ],[
                "description" => $jobv['description'],
                "location" => $jobv['location'],
                "type" => $jobv['type'],
                "salary" => $jobv['salary'],
                // "technologies"=> $jobv['technologies'],
                "jobCategory_id" => $category->id,
                "company_id" => $company->id,

            ]);
        }

        foreach($Application['jobApplications'] as $jobApp){
            $jobVacancy = JobVacancy::inRandomOrder()->first();

            $jobSeeker = User::firstOrCreate([
            'email' => fake()->unique()->safeEmail(),
            ],[
                'name' => fake()->name(),
                'password' => Hash::make('123456789'),
                'role' => 'job-seeker',
                'email_verified_at' => now(),
            ]);

            $resume = Resume::create([
                'user_id' => $jobSeeker->id,
                'filename' => $jobApp['resume']['filename'],
                'fileUri' => $jobApp['resume']['fileUri'],
                'contactDetails' => $jobApp['resume']['contactDetails'],
                'summary' => $jobApp['resume']['summary'],
                'experience' => $jobApp['resume']['experience'],
                'education' => $jobApp['resume']['education'],
                'skills' => $jobApp['resume']['skills'],

            ]);

            JobApplication::firstOrCreate([
                "jobVacancy_id" => $jobVacancy->id,
                "resume_id" => $resume->id,
                "user_id" => $jobSeeker->id,
                "status" => $jobApp['status'],
                "aiGeneratedScore" => $jobApp['aiGeneratedScore'],
                "aiGeneratedFeedback" => $jobApp['aiGeneratedFeedback'],

            ]);
        }
    }
}
