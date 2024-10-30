<?php

namespace App\Models;

use CodeIgniter\Model;

class TranslationModel extends Model
{
    protected $table = 'translations';
    protected $primaryKey = 'id';
    protected $allowedFields = ['translatable_id', 'translatable_type', 'language_code', 'field_name', 'translation'];

    // Belirli bir dil için bir kaydın çevirisini getirir
    public function getTranslation($translatableId, $languageCode)
    {
        return $this->where([
                'translatable_id' => $translatableId,
                'language_code' => $languageCode
            ])->first();
    }
    
    // Çeviriyi güncelle veya ekle
    public function saveTranslation($translatableId, $translatableType, $fieldName, $languageCode, $translation)
    {
        $existingTranslation = $this->getTranslation($translatableId, $translatableType, $fieldName, $languageCode);
        
        if ($existingTranslation) {
            // Güncelleme
            return $this->update($existingTranslation['id'], ['translation' => $translation]);
        } else {
            // Yeni ekleme
            return $this->insert([
                'translatable_id' => $translatableId,
                'translatable_type' => $translatableType,
                'field_name' => $fieldName,
                'language_code' => $languageCode,
                'translation' => $translation
            ]);
        }
    }
}
