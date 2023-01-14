<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Evaluation;
use App\Models\Value;
use App\Models\Student;
use Illuminate\Http\Request;

class FuzzyMamdaniController extends Controller
{
    protected $response, $title;

    public function __construct()
    {
        $this->title = "fuzzy-mamdani";
        // $this->middleware("roles:{$this->title}");
        $this->response = [
            'code' => config('constants.HTTP.CODE.FAILED'),
            'message' => __('error.public')
        ];
    }

    public function index()
    {
        try {
            $title = $this->title;
            return view('admin.' . $title . '.index', compact('title'));
        } catch (\Exception $e) {
            $this->response['message'] = $e->getMessage() . ' in file :' . $e->getFile() . ' line: ' . $e->getLine();
            return view('errors.message', ['message' => $this->response]);
        }
    }

    public function data(Request $request)
    {
        try {
            $title = $this->title;
            $jml = $request->jml == '' ? 5 : $request->jml;
            $data_dump = $tahun = $request->tahun == '' ? 'is not null' : '="' . $request->tahun . '"';
            $kelas = $request->kelas == '' ? 'is not null' : '="' . $request->kelas . '"';
            $semester = $request->semester == '' ? 'is not null' : '="' . $request->semester . '"';
            $data_dump = Student::whereHas('value', function ($q) use ($tahun, $kelas, $semester) {
                $q->whereRaw('class_id ' . $kelas)->whereHas('schoolYear', function ($q) use ($semester, $tahun) {
                    $q->whereRaw('semester ' . $semester)->whereRaw('name ' . $tahun);
                });
            })->with('value', function ($q) use ($tahun, $kelas, $semester) {
                $q->whereRaw('class_id ' . $kelas)->whereHas('schoolYear', function ($q) use ($semester, $tahun) {
                    $q->whereRaw('semester ' . $semester)->whereRaw('name ' . $tahun);
                });
            })->when($request->input('cari'), function ($query) use ($request) {
                $query->where('name', 'like', "%{$request->input('cari')}%")
                    ->orWhere("nisn", "like", "%{$request->input('cari')}%")
                    ->orWhere("nis", "like", "%{$request->input('cari')}%");
            });

            $datas = $data_dump->get();

            // Evaluation
            $eval = Evaluation::with('himpunan')->get();

            // Fuzzy Mamdani
            $fuzzy = [];
            foreach ($datas as $key => $value) {
                if ($value->value->evaluation->count() >= 1) {
                    $fuzzy[$key]['id'] = $value->id;
                    $fuzzy[$key]['name'] = $value->name;
                    $fuzzy[$key]['nisn'] = $value->nisn;
                    $fuzzy[$key]['nis'] = $value->nis;
                    $fuzzy[$key]['kelas'] = $value->value->classes->name;
                    $fuzzy[$key]['tahun'] = $value->value->schoolYear->name;
                    $fuzzy[$key]['semester'] = $value->value->schoolYear->semester;

                    // Value
                    $fuzzy[$key]['value'] = $value->value->evaluation;

                    // Total
                    $fuzzy[$key]['total'] = ($fuzzy[$key]['value'][0]['value'] + $fuzzy[$key]['value'][1]['value'] + $fuzzy[$key]['value'][2]['value'] + $fuzzy[$key]['value'][3]['value']) / 4;

                    // Evaluation
                    foreach ($eval as $key2 => $value2) {
                        $fuzzy[$key]['eval'][$key2]['name'] = $value2->value;
                        $fuzzy[$key]['eval'][$key2]['value'] = $value2->himpunan->where('min', '<=', $fuzzy[$key]['value'][$key2]['value'])->where('max', '>=', $fuzzy[$key]['value'][$key2]['value'])->first()->name;
                    }

                    // Rule
                    $fuzzy[$key]['rule'] = Helper::rule_mamdani($fuzzy[$key]['eval'][0]['value'], $fuzzy[$key]['eval'][1]['value'], $fuzzy[$key]['eval'][2]['value'], $fuzzy[$key]['eval'][3]['value']);
                }
            }
            // Pagination
            $fuzzy = collect($fuzzy);
            $data = $fuzzy->forPage($request->input('page', 1), $jml);

            // Get total data
            $total_data = $fuzzy->count();

            // get total page
            $total_page = ceil($total_data / $jml);

            // $data = $data_dump->orderBy('id', 'desc')->paginate($jml);

            $view = view('admin.' . $this->title . '.data', compact('data', 'title'))->with('i', ($request->input('page', 1) -
                1) * $jml)->render();
            return response()->json([
                "total_page" => $total_page,
                "total_data" => $total_data,
                "html"       => $view,
            ]);
        } catch (\Exception $e) {
            $this->response['message'] = $e->getMessage() . ' in file :' . $e->getFile() . ' line: ' . $e->getLine();
            return response()->json($this->response);
        }
    }
}
