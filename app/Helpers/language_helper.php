<?php

use App\Models\TranslationModel;

if (!function_exists('translate')) {
    function translate($translatableId, $languageCode = 'en')
    {
        $translationModel = new TranslationModel();

        $translation = $translationModel->getTranslation($translatableId, $languageCode);

        // Çeviri varsa getir, yoksa varsayılan metni döndür
        return $translation ? $translation['translation'] : 'Çeviri Bulunamadı';
    }
}
