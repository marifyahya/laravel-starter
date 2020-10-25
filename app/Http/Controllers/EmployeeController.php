<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Helpers\ImageHelper;
use App\Http\Requests\EmployeeRequest;
use App\Models\User as Employee;
use App\Models\Position;
use App\Models\Role;
use DataTables;

class EmployeeController extends Controller
{
    public function index() {
        return view('employee.index');
    }

    private function setFullName($data) {
        $fullName = $data->first_name .' '. $data->last_name;
        if (is_null($data->photo)) {
            $foto = 'https://ui-avatars.com/api/?name='.$fullName.'&background=0D8ABC&color=fff&size=32';
        } else {
            $foto =  asset(Storage::url('/images/employee/160/' . $data->photo));
        }
        return '<img src="'. $foto .'" width="32px"/> ' . $fullName;
    }

    public function table() {
        $data = Employee::select();
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('full_name', function($data){
                return $this->setFullName($data);
            })
            ->addColumn('date_of_birth', function($data){
                return $data->birth_place . ', ' . $data->birth_date;
            })
            ->addColumn('action', function($data){
                return '<a href="'. route('employee') .'/'. $data->employee_id .'" class="btn btn-sm btn-default mr-2"><i class="fa fa-edit"></i></a>'
                    . '<button class="btn btn-sm btn-danger btn-delete" value="'. $data->employee_id .'"><i class="fa fa-trash"></i></button>';
            })
            ->editColumn('gender', function($data){
                return $data->gender == 'M' ? 'Laki-laki' : 'Perempuan';
            })
            ->filterColumn('full_name', function($query, $keyword){
                $query->whereRaw("concat(first_name, ' ', last_name) like ?", ["$keyword%"]);
            })
            ->filterColumn('date_of_birth', function($query, $keyword){
                $query->whereRaw("DATE_FORMAT(birth_date,'%d-%m-%Y') like ?", ["$keyword%"])
                    ->orWhere('birth_place', "like", ["$keyword%"]);
            })
            ->rawColumns(['action', 'full_name'])
            ->make(true);
    }

    public function create() {
        $data = $this->formData();
        return view('employee.create', $data);
    }

    protected function formData($employee = null) {
        if ($employee != null) {
            $employee = Employee::find($employee);
        }
        $position = Position::orderBy('position_name')->get();
        $role = Role::select('role_id', 'role_name')->orderBy('role_name')->get();
        $employeeState = collect(['Guru Bantu', 'HONDA', 'GTY', 'GTT', 'PNS', 'PTT', 'PTY']);

        return compact('position', 'role', 'employeeState', 'employee');
    }

    public function store(EmployeeRequest $request) {
        try {
            $data = [
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'gender' => $request->gender,
                'birth_place' => $request->birth_place,
                'birth_date' => $request->birth_date,
                'address' => $request->address,
                'nip' => $request->nip,
                'nik' => $request->nik,
                'phone' => $request->phone,
                'decision_number' => $request->decision_number,
                'employee_status' => $request->employee_status,
                'position_id' => $request->position_id,
                'last_diploma' => $request->last_diploma,
                'last_diploma_year' => $request->last_diploma_year,
                'description' => $request->description,
                'state' => $request->state,
                'role_id' => $request->role_id,
            ];
            if ($request->password != null) {
                $data['password'] = Hash::make($request->password);
            }

            if ($request->hasFile('photo')) {
                $image = new ImageHelper();
                $photo = $image->upload($request->file('photo'), 'employee');
                $data['photo'] = $photo['name'];
            }

            Employee::create($data);
        } catch (Exeption $e) {
            return $e;
        }

        return redirect('employee')->with('success', 'Pegawai ' . $request->first_name . ' ' . $request->last_name . ' berhasil disimpan.');
    }
    public function edit($id) {
        $data = $this->formData($id);
        return view('employee.edit', $data);
    }
    public function update(EmployeeRequest $request, $id) {
        try {
            $employee = Employee::find($id);
            $data = [
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'gender' => $request->gender,
                'birth_place' => $request->birth_place,
                'birth_date' => $request->birth_date,
                'address' => $request->address,
                'nip' => $request->nip,
                'nik' => $request->nik,
                'phone' => $request->phone,
                'decision_number' => $request->decision_number,
                'position_id' => $request->position_id,
                'employee_status' => $request->employee_status,
                'last_diploma' => $request->last_diploma,
                'last_diploma_year' => $request->last_diploma_year,
                'description' => $request->description,
                'state' => $request->state,
                'role_id' => $request->role_id,
            ];
            if ($request->password != null) {
                $data['password'] = Hash::make($request->password);
            }

            if ($request->hasFile('photo')) {
                $image = new ImageHelper();
                $photo = $image->upload($request->file('photo'), 'employee');
                $data['photo'] = $photo['name'];

                if ($employee->photo != null) {
                    $image = new ImageHelper();
                    $image->remove($employee->photo, 'employee');
                }
            }

            $employee->update($data);
        } catch (Exeption $e) {
            return $e;
        }

        return redirect('employee')->with('success', 'Pegawai ' . $request->first_name . ' ' . $request->last_name . ' berhasil diperbaharui.');
    }
    public function destroy($id) {
        $employee = Employee::find($id);
        if ($employee == null) abort(404);
        if ($employee->photo != null) {
            $image = new ImageHelper();
            $image->remove($employee->photo, 'employee');
        }
        $employee->delete();
        return response()->json('Pegawai ' . $employee->first_name . ' berhasil dihapus', 200);
    }
}
