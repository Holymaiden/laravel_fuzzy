<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;
use App\Services\Contracts\StudentContract;

class StudentController extends Controller
{
    protected $studentContract,  $response, $title;

    public function __construct(StudentContract $studentContract)
    {
        $this->title = "students";
        $this->studentContract = $studentContract;
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
        $jml = $request->jml == '' ? config('constants.PAGINATION') : $request->jml;
        $title = $this->title;
        $tahun = $request->tahun == '' ? 'is not null' : '="' . $request->tahun . '"';
        $kelas = $request->kelas == '' ? 'is not null' : '="' . $request->kelas . '"';
        $semester = $request->semester == '' ? 'is not null' : '="' . $request->semester . '"';
        $data = Student::whereHas('value', function ($q) use ($tahun, $kelas, $semester) {
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
        })
            ->paginate($jml);

        $view = view('admin.' . $this->title . '.data', compact('data', 'title'))->with('i', ($request->input('page', 1) -
            1) * $jml)->render();

        return response()->json([
            "total_page" => $data->lastpage(),
            "total_data" => $data->total(),
            "html"       => $view,
        ]);
    }

    public function store(Request $request)
    {
        try {
            $data = $this->studentContract->store($request);
            return response()->json($data);
        } catch (\Exception $e) {
            $this->response['message'] = $e->getMessage() . ' in file :' . $e->getFile() . ' line: ' . $e->getLine();
            return view('errors.message', ['message' => $this->response]);
        }
    }

    public function edit($id)
    {
        try {
            $data = $this->studentContract->show($id);
            return response()->json($data);
        } catch (\Exception $e) {
            $this->response['message'] = $e->getMessage() . ' in file :' . $e->getFile() . ' line: ' . $e->getLine();
            return view('errors.message', ['message' => $this->response]);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $data = $this->studentContract->update($request, $id);
            return response()->json($data);
        } catch (\Exception $e) {
            $this->response['message'] = $e->getMessage() . ' in file :' . $e->getFile() . ' line: ' . $e->getLine();
            return view('errors.message', ['message' => $this->response]);
        }
    }

    public function destroy($id)
    {
        try {
            $data = $this->studentContract->delete($id);
            return response()->json($data);
        } catch (\Exception $e) {
            $this->response['message'] = $e->getMessage() . ' in file :' . $e->getFile() . ' line: ' . $e->getLine();
            return view('errors.message', ['message' => $this->response]);
        }
    }

    public function evaluation(Request $request)
    {
        try {
            $data = $this->studentContract->evaluation($request);
            return response()->json($data);
        } catch (\Exception $e) {
            $this->response['message'] = $e->getMessage() . ' in file :' . $e->getFile() . ' line: ' . $e->getLine();
            return view('errors.message', ['message' => $this->response]);
        }
    }
}
