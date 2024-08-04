<?php
namespace App\Repositories\SystemSetting;

interface SystemSettingInterface{
   public function all();
   public function store($request_data);
   public function show($id);
   public function update($request_data,$id);
   public function delete($id);

}
