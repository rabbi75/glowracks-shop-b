<?php
namespace App\Http\Controllers\frontEnd;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;

class frontEndController extends Controller
{
    
    public function index(){
        return view('frontEnd.app');
    }
   
    
}
