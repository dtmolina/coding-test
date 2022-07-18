<?php
/**
 * This trait is composed of CRUD methods that can be used in multiple classes.
 * (c) 2022 Dhan Jason Molina
 *
 * @author Dhan Jason Molina <dhanjasonmolina@gmail.com>
 */
namespace App\Http\Traits;

use App\Http\Requests\GeneralFormRequest;
use Illuminate\Http\Request;

trait CrudTrait
{
     /**
     * Get a list of opening jobs to applicants.
     *
     * @param Request $request
     * @return void
     */

    public function view(Request $request)
    {
        $model = $this->model;
        if (isset($this->status)) {
            $model = $model->where('status', $this->status);
        }
        $model = $model->paginate($request->per_page);
        $resource = $this->resources($model);
        return $resource::collection($model);
    }


     /**
     * Show a opening job to applicants.
     *
     * @param integer $id
     * @return void
     */
    public function show(int $id)
    {
        $model = $this->model;
        
        if(isset($this->status)) {
           $model = $model->where('status', $this->status);
        }

        $model = $model->find($id);
        if(is_null($model)) {
            return response()->noContent(404);
        }
        return $this->resources($model);
    }

    /**
     * Get a list of opening jobs to applicants by admin.
     *
     * @param Request $request
     * @return void
     */
    public function viewByAdmin(Request $request)
    {
        $model = $this->model::paginate($request->per_page);
        $resource = $this->resources($model);
        return $resource::collection($model);
    }

     /**
     * Show a opening job to applicants by admin.
     *
     * @param integer $id
     * @return void
     */
    public function showByAdmin(int $id)
    {
        $model = $this->model::find($id);
        
        if(is_null($model)) {
            return response()->noContent(404);
        }

        return $this->resources($model);
    }

    /**
     * Register a job by admin.
     *
     * @param $request
     * @return void
     */
    public function create(GeneralFormRequest $request)
    {
        $data = $request->all();
        if($request->status){
            $data['status'] =  $this->enum::fromKey($request->status);
        }

        $model = $this->model;
        $model = $model->create($data);
        return $this->resources($model);
    }

    /**
     * Update job by admin.
     *
     * @param  $request
     * @param integer $id
     * @return void
     */
    public function update(GeneralFormRequest $request, int $id)
    { 
        $data = $request->all();
        if($request->status){
            $data['status'] =  $this->enum::fromKey($request->status);
        }
        $model = $this->model::find($id);
        $model->update($data);
        return $this->resources($model);
    }

    /**
     * Delete job by admin.
     *
     * @param integer $id
     * @return void
     */
    public function delete(int $id)
    {
        $model = $this->model::find($id);
        if(is_null($model)) {
            return response()->noContent(404);
        }
        $model->delete();
        return response()->noContent();
    }
}

