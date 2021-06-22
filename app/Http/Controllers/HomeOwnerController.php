<?php

namespace App\Http\Controllers;

use App\Helpers\HomeOwnerNamesHelper;
use App\Http\Requests\SubmitHomeOwnerDataRequest;
use App\Imports\HomeOwnerImport;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Arr;
use Maatwebsite\Excel\Facades\Excel;

class HomeOwnerController extends Controller
{
    /**
     * Returns a view to display the home owner data in a table.
     *
     * @param SubmitHomeOwnerDataRequest $request
     * @return Application|Factory|View
     */
    public function submitHomeOwnerData(SubmitHomeOwnerDataRequest $request)
    {
        $homeOwners = [];
        foreach (Arr::flatten(Excel::toArray(new HomeOwnerImport, $request->file('home_owner_data'))) as $str) {
            $homeOwners = array_merge($homeOwners, HomeOwnerNamesHelper::getHomeOwnerDetails($str));
        }

        return view('home_owner_table', [
            'homeOwners' => $homeOwners
        ]);
    }
}
