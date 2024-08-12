<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\SystemSetting\SystemSettingInterface;
use App\Traits\ApiResponse;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SystemSettingController extends Controller
{
    use ApiResponse;
    private $systemSettingRepository;

    function __construct(SystemSettingInterface $systemSettingRepository)
    {
        $this->systemSettingRepository = $systemSettingRepository;
    }

    /**
     * Display a listing of the resource.
     * @return Mixed
     */
    public function index()
    {
        $data = $this->systemSettingRepository->all() ;
        if(!$data){
            return $this->error('Data Not Found');
        }
        return $this->success('All Data', $data);
    }

    /**
     * Update the specified resource in storage.
     * @param array $request
     * @param int $id
     * @return Mixed
     */
    public function update(Request $request, string $id)
    {
        $validated = Validator::make($request->all(), [
            'site_name' => 'required|string|max:255',
            'site_logo' => 'nullable|string|max:255',
            'site_favicon' => 'nullable|string|max:255',
            'phone' => 'required|string|max:20', // Adjust max length based on your requirements
            'email' => 'required|string|email|max:255',
            'address' => 'required|string|max:255',
            'facebook_url' => 'required|url|max:255',
            'meta_keywords' => 'required|string|max:255',
            'meta_description' => 'required|string',
        ])->validate();

        try {
            $data = $this->systemSettingRepository->update($validated, $id);
            return $this->success('Updated Successfully', $data);
        } catch (Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return string
     */
    public function destroy(string $id)
    {
        //
    }
}
