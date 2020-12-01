<?php

namespace App\Contracts;

interface iImageHandler {
    
    public function put($folder,$image):string;
    public function delete($path):void;
    
}

?>