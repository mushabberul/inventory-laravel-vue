<?php
namespace App\Repositories\Salary;

interface SalaryInterface{
   public function all();
   public function allWithPagination($per_page);
   public function store($request_data);
   public function show($id);
   public function update($request_data,$id);
   public function delete($id);

}
