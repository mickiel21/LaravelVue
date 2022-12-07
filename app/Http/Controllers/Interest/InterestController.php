<?php

namespace App\Http\Controllers\Interest;

use App\Models\Interest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class InterestController extends Controller
{
    public function index() {
        $interests = Interest::with([])->get();
        return resolveResponse(__('interest.fetch_success'), $interests);
    }

}
