<?php

namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;
use App\Models\UserModel;
use CodeIgniter\API\ResponseTrait;

class AuthController extends ResourceController
{
    use ResponseTrait;

    public function index(){

        echo view('admin/auth/login');
        
    }

    // Kayıt İşlemi
    public function register()
    {
        $userModel = new UserModel();
        $data = $this->request->getPost();

        // Kayıt verilerini al
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        $data['token'] = generateToken(24);

        if ($userModel->insert($data)) {
            return $this->respondCreated(['status' => 'User registered', 'token' => $data['token']]);
        } else {
            return $this->fail($userModel->errors());
        }
    }


    // Giriş İşlemi
    public function login()
    {
        $userModel = new UserModel();
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        // Kullanıcı adı ile kullanıcıyı bul
        $user = $userModel->where('username', $username)->first();

        if (!$user || !password_verify($password, $user['password'])) {
            return $this->failUnauthorized('Invalid credentials');
        }

            // Başarılı giriş durumunda token döndürme
        return $this->respond([
            'status' => 'success',
            'message' => 'Login successful',
            'token' => $user['token'],
            'user' => [
                'id' => $user['id'],
                'username' => $user['username']
            ]
        ]);
    }

    // Profil İşlemi
    public function profile()
    {
        // Burada $this->request->user'dan kullanıcı verisine erişebilirsiniz
        return $this->respond(['status' => 'Authorized', 'user' => $this->request->user]);
    }
}
