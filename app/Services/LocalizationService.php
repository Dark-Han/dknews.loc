<?php
namespace App\Services;

use Illuminate\Support\Facades\App;

/**
 * Class LocalizationService
 * @package App\Services
 */
class LocalizationService{

    /**
     * @return string
     */
    public static function getCategorySlugColumn():string {
        $locale=App::getLocale();
        switch ($locale) {
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

    public static function getCategoryNameColumn():string {
        $locale=App::getLocale();
        switch ($locale) {
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