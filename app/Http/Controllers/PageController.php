<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Contacts;
use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * @OA\Get (
     *     path="/api/about",
     *     tags={"Pages"},
     *      summary="Get about page content",
     *
     *     @OA\Response(response="200", description="Course list")
     * )
     */
    public function getAbout(){
        return About::first();
    }
    /**
     * @OA\Get (
     *     path="/api/contacts",
     *     tags={"Pages"},
     *      summary="Get contacts page content",
     *
     *     @OA\Response(response="200", description="Course list")
     * )
     */
    public function getContacts(){
        return Contacts::first();
    }
}
