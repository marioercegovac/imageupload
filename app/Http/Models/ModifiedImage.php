<?php

namespace App\Http\Models;


class ModifiedImage extends Image
{

    public function base(){
        return 'modified';
    }
}
