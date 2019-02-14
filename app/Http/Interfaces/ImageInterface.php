<?php

namespace App\Http\Interfaces;

use Illuminate\Http\UploadedFile;

interface ImageInterface
{
    public function store(UploadedFile $file);
    public function modify(array $data, $image);
}