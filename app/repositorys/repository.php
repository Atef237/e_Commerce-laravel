<?php


namespace App\repositorys;
use App\Http\interfaces\repositoryInterface;
use Illuminate\Database\Eloquent\Model;

class repository implements repositoryInterface
{
    protected $model;

    public function __construct(Model $model){
        $this->model = $model;
    }

    public function index()
    {
        return $this->model->pagination(pagination_count);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update(array $data, $id)
    {
        $record = $this->model->find($id);
        return $this->model->update($data);
    }

    public function delete($id)
    {
        return $this->model->destroy($id);
    }

    public function show($id)
    {
        return $this->model->find($id);
    }

    //set the model
    public function getModel(){
        return $this->model;
    }


    //set the model
    public function setModel($model){
         $this->model = $model;
         return $this;
    }

    //get database relationship
    public function with($relations){
        return $this->model->with($relations);
    }

}
