<?php

namespace App\Http\Models;


class OriginalImage extends Image
{
    public function base(){
        return 'original';
    }
}
