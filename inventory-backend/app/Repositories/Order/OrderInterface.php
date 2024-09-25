<?php
namespace App\Repositories\Order;

interface OrderInterface{
   public function all();
   public function allWithPagination($per_page);
   public function store($request_data);
   public function show($id);
}
