<?php

namespace App\Http\Controllers;

use App\Enums\JobStatus;
use App\Http\Requests\JobStoreRequest;
use App\Http\Resources\CompanyResource;
use App\Http\Resources\JobResource;
use App\Http\Traits\CrudTrait;
use App\Models\Company;
use App\Models\Job;
use Illuminate\Http\Request;


class JobController extends Controller
{
    /**
    * I used a trait to reuse a set of methods freely in several classes. 
    * In addition, they can help improve maintainability and the cleanliness of your code.
    */
    use CrudTrait;

    protected $model;
    protected $status;
    protected $enum;
    
    public function __construct()
    {
        // Instantiate the model class
        $this->model = new Job();

        // Optional params in other classes
        $this->enum = JobStatus::class;
        $this->status = JobStatus::Open;
    }

    public function resources($data)
    {
        return new JobResource($data);
    }
}
