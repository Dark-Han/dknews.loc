<?php

namespace App\Contracts;

interface iImageHandler {

    /**
     * @param $folder
     * @param $image
     * @return string
     */
    public function put($folder, $image):string;

    /**
     * @param $path
     */
    public function delete($path):void;

}

?>
