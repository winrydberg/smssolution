<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Repositories\Interfaces\WebsiteRepositoryInterface;
use Illuminate\Http\Request;

class MainController extends Controller
{
    protected $webRepository;

    public function __construct(WebsiteRepositoryInterface $webRepository)
    {
        $this->webRepository = $webRepository;
    }
    public function home(){
        $home_component = Setting::where("name", "home_page")->first();
        $template = $this->webRepository->getActiveTemplate();
        $data = [];
        switch($template){
            case 'one':
                return view('website.template_one.index', compact('data'));
                break;
            case "two":
                return view('website.template_two.index', compact('data'));
                break;
            case "three":
                return view('website.template_three.index', compact('data'));
                break;
            default:
                return view('website.template_one.index', compact('data'));
        }
        // return view("app.home", compact("home_component"));
    }
}
