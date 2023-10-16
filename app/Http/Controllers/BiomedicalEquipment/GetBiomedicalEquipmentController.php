<?php

namespace App\Http\Controllers\BiomedicalEquipment;

use App\Http\Controllers\Controller;
use App\Models\BiomedicalEquipment\BiomedicalClassification;
use App\Models\BiomedicalEquipment\FormAcquisition;
use App\Models\BiomedicalEquipment\Period;
use App\Models\BiomedicalEquipment\Plan;
use App\Models\BiomedicalEquipment\Property;
use App\Models\BiomedicalEquipment\RiskClass;
use App\Models\BiomedicalEquipment\UseBiomedical;
use App\Models\BiomedicalEquipment\YesOrNot;
use Illuminate\Http\Request;

class GetBiomedicalEquipmentController extends Controller
{
    
    public function formAcquisition(Request $request)
    {
        return response()->json([
            'results' => FormAcquisition::getSearch($request->term)->get()
        ]);
    }

    public function property(Request $request)
    {
        return response()->json([
            'results' => Property::getSearch($request->term)->get()
        ]);
    }

    public function period(Request $request)
    {
        return response()->json([
            'results' => Period::getSearch($request->term)->get()
        ]);
    }

    public function yesNot(Request $request)
    {
        return response()->json([
            'results' => YesOrNot::getSearch($request->term)->get()
        ]);
    }

    public function plan(Request $request)
    {
        return response()->json([
            'results' => Plan::getSearch($request->term)->get()
        ]);
    }

    public function useBiomedical(Request $request)
    {
        return response()->json([
            'results' => UseBiomedical::getSearch($request->term)->get()
        ]);
    }

    public function biomedicalClassification(Request $request)
    {
        return response()->json([
            'results' => BiomedicalClassification::getSearch($request->term)->get()
        ]);
    }

    public function riskClass(Request $request)
    {
        return response()->json([
            'results' => RiskClass::getSearch($request->term)->get()
        ]);
    }

}
