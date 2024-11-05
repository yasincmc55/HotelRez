<?php
namespace App\Models;
use CodeIgniter\Model;;

class UserModel extends Model{
   protected $table = 'Users';
   private $key = 'id';
   protected $allowedFields = ['id','username','email','token','password','first_name','last_name','phone','role'];

}