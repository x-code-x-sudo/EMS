<?php

namespace App\Http\Controllers;

use App\Models\OdsAmbulanceBrigades;
use App\Models\OdsAmbulanceHospitals;
use App\Models\OdsAmbulanceIndicators;
use App\Http\Requests\StoreOdsAmbulanceIndicatorsRequest;
use App\Http\Requests\UpdateOdsAmbulanceIndicatorsRequest;
use App\Models\OdsAmbulanceReferences;
use App\Models\OdsAmbulanceSubstations;
use Illuminate\Http\Request;

class OdsAmbulanceIndicatorsController extends Controller
{
    public function index(Request $request)
    {
        $filters = [
            'substation_id' => $request->input('substation_id'),
            'call_region_coato' => $request->input('call_region_coato'),
            'call_district_coato' => $request->input('call_district_coato'),
            'sort' => $request->input('sort') ?? 'DESC',
        ];

        $query = OdsAmbulanceIndicators::with('call_type')->when(
            $filters['sort'],
            fn($query, $value) => $query->orderBy('id', $value)
        )
            ->when(
                $filters['substation_id'],
                fn($query, $value) => $query->where('substation_id', $filters['substation_id'])
            )->when(
                $filters['call_district_coato'],
                fn($query, $value) => $query->where('call_district_coato', $filters['call_district_coato'])
            ) ->when(
                $filters['call_region_coato'],
                fn($query, $value) => $query->where('call_region_coato', 'like', '%' . $filters['call_region_coato'] . '%')
            );
        $indicators = $query->paginate(10);

        return view('dashboard.pages.indicator', compact( 'indicators'));
    }

    public function edit($id)
    {
        $indicator = OdsAmbulanceIndicators::findOrFail($id);
        return view('dashboard.pages.indicator-edit-page', [
            'indicator' => $indicator
        ]);
    }

    public function create()
    {
        $substations=OdsAmbulanceSubstations::all();
        $call_types=OdsAmbulanceReferences::where('table_name','call_types')->get();
        $reasons=OdsAmbulanceReferences::where('table_name','reasons')->get();
        $call_results=OdsAmbulanceReferences::where('table_name','call_results')->get();
        $hospitalization_results=OdsAmbulanceReferences::where('table_name','hospitalization_results')->get();
        $called_persons=OdsAmbulanceReferences::where('table_name','called_persons')->get();
        $call_places=OdsAmbulanceReferences::where('table_name','call_places')->get();
        $brigades=OdsAmbulanceBrigades::all();
        $hospitals=OdsAmbulanceHospitals::all();
        return view('dashboard.pages.indicator-create-page',compact('substations','call_types','brigades','reasons','call_results','hospitals','hospitalization_results','called_persons','call_places'));
    }

    public function store(Request $request)
    {
        $indicator = new OdsAmbulanceIndicators();
        $indicator->call_region_coato = $request->call_region_coato;
        $indicator->call_district_coato = $request->call_district_coato;
        $indicator->substation_id = $request->substation_id;
        $indicator->filling_call_card = $request->filling_call_card;
        $indicator->call_type_id = $request->call_type_id;
        $indicator->card_number = $request->card_number;
        $indicator->call_received = $request->call_received;
        $indicator->call_reception = $request->call_reception;
        $indicator->beginning_formation_ct = $request->beginning_formation_ct;
        $indicator->completion_formation_ct = $request->completion_formation_ct;
        $indicator->transfer_brigade = $request->transfer_brigade;
        $indicator->brigade_departure = $request->brigade_departure;
        $indicator->arrival_brigade_place = $request->arrival_brigade_place;
        $indicator->transportation_start = $request->transportation_start;
        $indicator->arrival_medical_center = $request->arrival_medical_center;
        $indicator->call_end = $request->call_end;
        $indicator->return_substation = $request->return_substation;
        $indicator->brigade_id = $request->brigade_id;
        $indicator->address = $request->address;
        $indicator->reason_id = $request->reason_id;
        $indicator->gender = $request->gender;
        $indicator->age = $request->age;
        $indicator->residence_region_coato = $request->residence_region_coato;
        $indicator->residence_district_coato = $request->residence_district_coato;
        $indicator->diagnos = $request->diagnos;
        $indicator->call_result_id = $request->call_result_id;
        $indicator->hospital_id = $request->hospital_id;
        $indicator->hospitalization_result_id = $request->hospitalization_result_id;
        $indicator->called_person_id = $request->called_person_id;
        $indicator->call_place_id = $request->call_place_id;
        $indicator->save();

        return redirect()->route('indicator.index')->with('success', 'Отделение успешно создано');
    }

    public function update(Request $request, $id)
    {
        $indicator = OdsAmbulanceReferences::findOrFail($id);
        $indicator->call_region_coato = $request->call_region_coato;
        $indicator->call_district_coato = $request->call_district_coato;
        $indicator->substation_id = $request->substation_id;
        $indicator->filling_call_card = $request->filling_call_card;
        $indicator->call_type_id = $request->call_type_id;
        $indicator->card_number = $request->card_number;
        $indicator->call_received = $request->call_received;
        $indicator->call_reception = $request->call_reception;
        $indicator->beginning_formation_ct = $request->beginning_formation_ct;
        $indicator->completion_formation_ct = $request->completion_formation_ct;
        $indicator->transfer_brigade = $request->transfer_brigade;
        $indicator->brigade_departure = $request->brigade_departure;
        $indicator->arrival_brigade_place = $request->arrival_brigade_place;
        $indicator->transportation_start = $request->transportation_start;
        $indicator->arrival_medical_center = $request->arrival_medical_center;
        $indicator->call_end = $request->call_end;
        $indicator->return_substation = $request->return_substation;
        $indicator->brigade_id = $request->brigade_id;
        $indicator->address = $request->address;
        $indicator->reason_id = $request->reason_id;
        $indicator->gender = $request->gender;
        $indicator->age = $request->age;
        $indicator->residence_region_coato = $request->residence_region_coato;
        $indicator->residence_district_coato = $request->residence_district_coato;
        $indicator->diagnos = $request->diagnos;
        $indicator->call_result_id = $request->call_result_id;
        $indicator->hospital_id = $request->hospital_id;
        $indicator->hospitalization_result_id = $request->hospitalization_result_id;
        $indicator->called_person_id = $request->called_person_id;
        $indicator->call_place_id = $request->call_place_id;
        $indicator->save();
        return redirect()->route('indicator.index')->with('success', 'Отделение успешно обновлено');
    }

    public function destroy($id)
    {
        $brigade = OdsAmbulanceIndicators::findOrFail($id);
        $brigade->delete();

        return redirect()->back()->with('success', 'Запись успешно удалена');
    }
}