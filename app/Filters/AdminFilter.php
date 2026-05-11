<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AdminFilter implements FilterInterface
{
    /**
     * Vérifier si l'admin est connecté
     */
    public function before(RequestInterface $request, $arguments = null)
    {
        // Vérifier si l'admin est connecté
        if (!session()->has('admin_id')) {
            // Rediriger vers la page de login admin
            return redirect()->to('/admin/login')->with('error', 'Vous devez être connecté pour accéder à cette page');
        }
    }

    /**
     * Nous ne faisons rien après
     */
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
    }
}
