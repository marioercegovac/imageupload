<?php
/**
 * Created by PhpStorm.
 * User: bhrino
 * Date: 2/14/19
 * Time: 3:29 PM
 */

namespace App\Http\Services;


use App\Http\Interfaces\ImageInterface;
use App\Http\Models\ModifiedImage;
use App\Http\Models\OriginalImage;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ImageService implements ImageInterface
{

    /**
     * @var OriginalImage
     */
    private $originalImage;
    /**
     * @var ModifiedImage
     */
    private $modifiedImage;
    private $filename = "";
    private $mimeType = "";

    public function __construct(OriginalImage $originalImage, ModifiedImage $modifiedImage)
    {

        $this->originalImage = $originalImage;
        $this->modifiedImage = $modifiedImage;

    }

    public function store(UploadedFile $file)
    {
        $path = $file->store("/" . Auth::id(), 'original');

        OriginalImage::create([
            'user_id' => Auth::id(),
            'path' => "/" . $path,
            'filename' => $file->hashName(),
            'extension' => $file->getMimeType()
        ]);
    }

    public function modify(array $data, $originalImage)
    {
        $this->originalImage = $originalImage;

        $fullpath = Storage::disk('original')->url($originalImage->path);

        $fullpath = $this->sanitizePath($fullpath);

        $this->modifiedImage = Image::make($fullpath);
        $this->buildFilename($data);

        if ($this->checkIfFileExists()){
            return $this->filename;
        }

        $this->applyParameters($data);


        $this->saveModified();

    }


    public function sanitizePath($path)
    {
        return "storage/" . explode('storage/', $path)[1];
    }


    public function saveModified()
    {
        $path = $this->modifiedImage->save(storage_path('public/modified') . "/". Auth::id() . '/' . $this->filename);

        ModifiedImage::create([
            'user_id' => Auth::id(),
            'path' => "/" . Auth::id() . "/" . $this->filename,
            'filename' => $this->filename,
            'extension' => $this->mimeType
        ]);
    }

    public function buildFilename($data){

        $filename = "";
        $data = (object) $data;

        foreach (['height', 'width', 'color'] as $property) {
            if(isset($data->{$property})){
                $filename .= $data->{$property} . "_";
            }
        }

        $filename = substr(0,strlen($filename)-1);


        if (isset($data->output)){
            $filename .= "." . $data->output;
        }
        else{
            $filename .= "." . $this->originalImage->getExtension();
        }
        $this->filename = $filename;
    }


    public function checkIfFileExists(){
        if(Storage::disk('original')->exists($this->filename)){
            return true;

        }
        return false;


    }

    public function applyParameters($data)
    {
        $data = (object) $data;

        $height = (int)($data->height?? null);
        $width = (int) ($data->width ?? null);

        if ($height || $width){
            $this->modifiedImage->resize($height, $width);
        }

        if (isset($data->color)) {
            $this->modifiedImage->fill('#' . $data->color);
        }

        if (isset($data->output)) {
            $this->mimeType = "image/" . $data->output;
        }

    }
}