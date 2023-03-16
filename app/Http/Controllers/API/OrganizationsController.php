<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Organisation;


class OrganizationsController extends Controller
{
    public function index()
    {
        $organisations = Organisation::where('subscribed', true)
                                        ->get()
                                        ->map(function($item){
                                           // dd($item);
                                            return [
                                                'name' => $item->name, 
                                                'description' => $item->description, 
                                                'trial_end' => $item->trial_end
                                            ];
                                        });
        return $organisations;
    }
}
