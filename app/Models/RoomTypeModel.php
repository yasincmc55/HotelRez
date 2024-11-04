<?php
namespace App\Models;

use CodeIgniter\Model;

class RoomTypeModel extends Model{
    protected $table = 'room_types';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'max_occupancy',
        'price_per_night',
        'status',
    ];

    protected $useTimestamps;

    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

}