<?php


namespace App\Http\interfaces;


interface repositoryInterface
{

    public function index();

    public function create(array $data);

    public function update(array $data, $id);

    public function delete($id);

    public function show($id);

}
