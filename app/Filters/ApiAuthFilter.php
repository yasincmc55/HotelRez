<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use App\Models\UserModel;

class ApiAuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $token = $request->getHeaderLine('Authorization');

        if (empty($token)) {
            return Services::response()
                ->setJSON(['error' => 'Authorization token is missing'])
                ->setStatusCode(401);
        }

        $userModel = new UserModel();
        $user = $userModel->where('token', $token)->first();

        if (!$user) {
            return Services::response()
                ->setJSON(['error' => 'Invalid token'])
                ->setStatusCode(401);
        }

        // Eğer token geçerliyse, kullanıcının bilgilerini isteğe ekleyebilirsiniz.
        $request->user = $user;
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // İsteğin ardından yapılacak işlemler
    }
}
