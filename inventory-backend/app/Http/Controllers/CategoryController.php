<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Traits\ApiResponse;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Resources\CategoryResource;
use Illuminate\Support\Facades\Validator;
use App\Repositories\Category\CategoryInterface;

class CategoryController extends Controller
{
    private $cateogryRepository;
    use ApiResponse;

    function __construct(CategoryInterface $cateogryRepository){
        $this->cateogryRepository = $cateogryRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $per_page = request('per_page');
        $data = $this->cateogryRepository->allWithPagination($per_page);
        $metadata['count'] = count($data);

        return $this->success('Category List',$data,$metadata);

    }
    /**
     * @param int $par_page
     */
    public function allCategories()
    {
        $data = $this->cateogryRepository->all();
        $metadata['count']= count($data);
        return $this->success('Category List',$data,$metadata);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = Validator::make($request->all(),[
            'name' =>'required|string',
            'slug' => 'nullable|string',
            'image' => 'nullable',
            'status' => 'nullable',
        ])->validate();

        $data = $this->cateogryRepository->store($validated);
        return $this->success('Category Create Successfully', (new CategoryResource($data)));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = $this->cateogryRepository->show($id);
        return $this->success('Category Data',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = Validator::make($request->all(),[
            'name' =>'required|string',
            'slug' => 'nullable|string',
            'image' => 'nullable',
            'status' => 'nullable',
        ])->validate();

        $data = $this->cateogryRepository->update($validated,$id);
        return $this->success('Category Create Successfully',$data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = $this->cateogryRepository->delete($id);
        return $this->success('Category Deleted Successfully');
    }
    /**
     * Change status resource from storage.
     */
    public function status(string $id)
    {
        $data = $this->cateogryRepository->status($id);
        return $this->success('Category Status Updated Successfully',$data);
    }
}
