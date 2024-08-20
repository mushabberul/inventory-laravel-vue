<?php
namespace App\Repositories\Supplier;

interface SupplierInterface{
   public function all();
   public function allWithPagination($per_page);
   public function status($id);
   public function store($request_data);
   public function show($id);
   public function update($request_data,$id);
   public function delete($id);

}
