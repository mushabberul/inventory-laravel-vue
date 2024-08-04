<?php

namespace App\Repositories\SystemSetting;

use App\Models\SystemSetting;

class SystemSettingRepository implements SystemSettingInterface
{

    /**
     * @return Mixed
     */
    public function all()
    {
        $data = SystemSetting::first();
        return $data;
    }

    /**
     * @param array
     * @return Mixed
     */
    public function store($request_data)
    {
        $data = SystemSetting::create([
            'site_name' => $request_data->site_name,
            'site_logo' => $request_data->site_logo,
            'site_favicon' => $request_data->site_favicon,
            'phone' => $request_data->phone,
            'email' => $request_data->email,
            'address' => $request_data->address,
            'facebook_url' => $request_data->facebook_url,
            'meta_keywords' => $request_data->meta_keywords,
            'meta_description' => $request_data->meta_description,
        ]);

        return $data;
    }

    /**
     * @param int $id
     * @return Mixed
     */
    public function show($id)
    {
        $data = SystemSetting::findOrFail($id);
        return $data;
    }

    /**
     * @param array $request_data
     * @param int $id
     * @return Mixed
     */
    public function update($request_data, $id)
    {
        $request_data =(object)$request_data;
        $data = SystemSetting::findOrFail($id);
        $data->update([
            'site_name' => $request_data->site_name,
            'site_logo' => $request_data->site_logo,
            'site_favicon' => $request_data->site_favicon,
            'phone' => $request_data->phone,
            'email' => $request_data->email,
            'address' => $request_data->address,
            'facebook_url' => $request_data->facebook_url,
            'meta_keywords' => $request_data->meta_keywords,
            'meta_description' => $request_data->meta_description,
        ]);
        return $data;
    }

    /**
     * @param int $id
     * @return bool
     */
    public function delete($id)
    {
        $data = $this->show($id);
        $data->delete();
        return true;
    }
}
