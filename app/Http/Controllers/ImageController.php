<?php

namespace App\Http\Controllers;

use App\Http\Interfaces\ImageInterface;
use App\Http\Models\OriginalImage;
use App\Http\Requests\ImageModifyRequest;
use App\Http\Requests\ImageUploadRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use League\Flysystem\FileNotFoundException;

class ImageController extends Controller
{


    /**
     * @var ImageInterface
     */
    private $imageService;

    public function __construct(ImageInterface $imageService)
    {

        $this->imageService = $imageService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ImageUploadRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(ImageUploadRequest $request)
    {

        $this->imageService->store($request->image);

        return response()->json(['success' => true, 'message' => 'Image uploaded.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showOriginal($id)
    {
        return view('preview', [
            'image' => OriginalImage::findOrFail($id)->getFullPath()
        ]);
    }

    public function modify(ImageModifyRequest $request, $id)
    {
        $originalImage = OriginalImage::findOrFail($id);

        $exists = Storage::disk('original')->exists($originalImage->path);

        if (!$exists){
            throw new FileNotFoundException($originalImage->path);
        }

        $modifiedImagePath = $this->imageService->modify($request->all(), $originalImage);

        return view('preview', [
            'image' => $modifiedImagePath
        ]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
