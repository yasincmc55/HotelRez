<?php

namespace App\Controllers\API;

use App\Controllers\BaseController;
use App\Models\RoomTypeModel;
use App\Models\LanguageModel;
use App\Models\TranslationModel;

class RoomsController extends BaseController
{
    //odalar
    public function room_list()
    {
         echo view('admin/templates/head');
         echo view('admin/templates/header');
         echo view('admin/room_list');
         echo view('admin/templates/sidebar');
         echo view('admin/templates/footer');

    }

/*ODA TİPLERİ İŞLEMLERİ*/

    //oda tipleri listesi
    public function room_types(){

        $model = new RoomTypeModel();
        $room_types = $model->asObject()->findAll();
        $data['room_types'] = $room_types;

        $lang = new LanguageModel();
        $languages = $lang->findAll();
        $data['languages'] = $languages;

        echo view('admin/templates/head');
        echo view('admin/templates/header');
        echo view('admin/room_type',$data);
        echo view('admin/templates/sidebar');
        echo view('admin/templates/footer');
    }

    public function save_room_type()
    {
        $roomTypeModel = new RoomTypeModel();

        $translationModel = new TranslationModel();

        // Ana oda tipi verilerini al
        $data = [
            'name' => $this->request->getJSON()->type_name,
            'max_occupancy' => $this->request->getJSON()->max_occupancy,
            'price_per_night' => $this->request->getJSON()->per_night_price,
            'status' => $this->request->getJSON()->status,
        ];

        // Oda tipi verisini kaydet
        if ($roomTypeModel->insert($data)) {
            $roomTypeId = $roomTypeModel->insertID();

            // Çeviri verilerini işle
            $translations = $this->request->getJSON()->translations;
            foreach ($translations as $languageCode => $fields) {
                foreach ($fields as $fieldName => $translationText) {
                    $translationModel->saveTranslation(
                        $roomTypeId,
                        'room_type',
                        $fieldName,
                        $languageCode,
                        $translationText
                    );
                }
            }

            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'Room Type and translations saved successfully'
            ]);
        } else {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Error saving room type'
            ]);
        }
    }



    public function edit_room_type($id){
        $model = new RoomTypeModel();
        $room_type = $model->find($id);

        if ($room_type){
            return $this->response->setJSON([
                'status' => 'success',
                'data' => $room_type
            ]);
        }else{
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Room type not found'
            ]);
        }

    }



}
