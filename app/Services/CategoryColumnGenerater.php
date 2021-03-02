<?php
namespace App\Services;

use Illuminate\Support\Facades\App;

/**
 * Class CategoryColumnGenerater
 * @package App\Services
 */
class CategoryColumnGenerater{

    /**
     * @return string
     */
    public static function getSlugColumn():string {
        switch (App::getLocale()) {
            case 'ru':
                return 'slug_ru';
            case 'kz':
                return 'slug_kz';
            case 'en':
                return 'slug_en';
            case 'cn':
                return 'slug_cn';
        }
    }

    public static function getNameColumn():string {
        switch (App::getLocale()) {
            case 'ru':
                return 'name_ru';
            case 'kz':
                return 'name_kz';
            case 'en':
                return 'name_en';
            case 'cn':
                return 'name_cn';
        }
    }

}

?>