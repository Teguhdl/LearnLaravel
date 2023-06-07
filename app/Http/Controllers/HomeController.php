<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HomeModel; 
use App\Models\Post;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\RedirectResponse;
class HomeController extends Controller
{
    public function index(Request $request): View
    {
      
        return view('login-page');
    }

    public function store(Request $request): view
    {
        $HomeModel = new HomeModel();
        $hasil = $HomeModel->cekUsernamePassword($request->input('username'), $request->input('password'));
        
        if ($hasil == 0) {
            $data['pesan'] = "Pasangan username dan password tidak tepat";
            return view('login-page',$data);
        } else {
            $session = $request->session();
            
            $ses_data = [
                'user_name' => $request->input('username'),
                'logged_in' => true,
            ];
            
            $session->put($ses_data);
            
            // print_r($ses_data);die();
            
            $posts = Post::latest()->paginate(5);
            return view('posts.index', compact('posts'));
        }
    }
}
