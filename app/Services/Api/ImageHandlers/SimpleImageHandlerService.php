<?php

namespace App\Services\Api\ImageHandlers;

use App\Contracts\iImageHandler;
use Illuminate\Support\Facades\Storage;

class SimpleImageHandlerService implements iImageHandler {

    public function put($folder,$image):string{
        $path=Storage::putFile($folder,$image);
        return $path;
    }

    public function delete($path):void{
        Storage::delete($path);
    }

}


?>
