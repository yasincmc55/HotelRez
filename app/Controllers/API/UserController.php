<?php 
namespace App\Controllers\Api;
use App\Controllers\BaseController;
use App\Models\UserModel;

class UserController extends BaseController{
    public function index(){
       $user = new UserModel();
       $users = $user->findAll();
       $data['users'] = $users;

       echo view('admin/templates/head');
       echo view('admin/templates/header');
       echo view('admin/templates/sidebar');
       echo view('admin/users',$data);
       echo view('admin/templates/footer');
    }

    public function user_list(){
        $userModel = new UserModel();
        $users = $userModel->findAll();
         
         $filtered_users = array_map(function($user){
             return[
                'username'=>$user['username'],
                'email'=>$user['email'],
                'first_name'=>$user['first_name'],
                'last_name'=>$user['last_name'],
                'phone'=>$user['phone'],
                'role'=>$user['role']
             ];
         },$users);

        return $this->response->setJSON([
            'users'=>$filtered_users,
        ]);
    }

    public function user_add()
    {
        $userModel = new UserModel();
    
        // JSON verisini al
        $jsonData = $this->request->getJSON();
        
        $token = generateToken(24);

    
        // JSON verisi alındıysa ve doğru şekilde ayrıştırıldıysa
        if ($jsonData) {
            // Veriyi diziye çevir
            $userData = [
                'username' => $jsonData->username,
                'email' => $jsonData->email,
                'password' => password_hash($jsonData->password, PASSWORD_DEFAULT), // Şifreyi hashle
                'first_name' => $jsonData->first_name,
                'last_name' => $jsonData->last_name,
                'phone' => $jsonData->phone,
                'token'=>$token,
                'role' => $jsonData->role,
                'status' => $jsonData->status
            ];

    
            // Veriyi veritabanına kaydet
            if ($userModel->insert($userData)) {
                return $this->response->setJSON(['status' => 'success', 'message' => 'Kullanıcı başarıyla eklendi.']);
            } else {
                return $this->response->setJSON(['status' => 'error', 'message' => 'Kullanıcı eklenirken bir hata oluştu.']);
            }
        } else {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Geçersiz veri formatı.']);
        }
    }
    
    
}