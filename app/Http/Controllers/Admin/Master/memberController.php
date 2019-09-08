<?php

namespace App\Http\Controllers\Admin\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Master\memberModel;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;
use Alert;

class memberController extends Controller
{
    //

    public function index()
    {
        return view('admin.master.member.page');
    }

    public function showForm()
    {
        return view('admin.master.member.form');
    }

    public function store(Request $r)
    {
        $member = memberModel::where('id', '=', $r->id)->firstOrFail();
        return view('admin.master.member.update')->with(['member' => $member]);
    }

    public function getData()
    {
        $member = memberModel::query()
            ->select('id', 'username', 'email', 'nohp')
            ->get();

        return DataTables::of($member)
            ->addIndexColumn()
            ->addColumn('action', function ($member) {
                return '<a class="btn-sm btn-warning" id="btn-edit" href="/admin/member/store?id=' . $member->id . '"><i class="fa fa-edit"></i></a>
                 <a class="btn-sm btn-danger" data-toggle="tooltip" title="Hapus Data" id="btn-delete" href="#" onclick="hapus(\'' . $member->id . '\',event)"><i class="fa fa-trash"></i></a>
                 ';
            })
            ->rawColumns(['action'])
            ->make(true);
    }


    private function isValid(Request $r)
    {
        $messages = [];

        $rules = [
            'username' => 'required|max:191|unique:tb_member,username',
            'email' => 'required|max:191',
            'nohp' => 'required|numeric|digits_between:1,15',
            'password' => 'required|string|min:6|confirmed',
        ];

        return Validator::make($r->all(), $rules, $messages);
    }

    public function add(Request $r)
    {
        if ($this->isValid($r)->fails()) {
            $errors = $this->isValid($r)->errors();
            Alert::error('Gagal Menambahkan Data', 'Ooops');
            return redirect()->back()->withErrors($errors)->withInput();
        } else {

            try {
                $member = new memberModel();
                $member->username = $r->username;
                $member->email = $r->email;
                $member->password = Hash::make($r->password);
                $member->nohp = $r->nohp;
                $member->save();
                Alert::success('Success', 'Berhasil Menambahkan Data');
                return redirect()->back();
            } catch (\Exception  $e) {
                $exData = explode('(', $e->getMessage());
                Alert::error('Gagal Menambahkan Data \n' . $exData[0], 'Ooops');
                return redirect()->back()->withInput();
            }
        }
    }

    private function isValidEdit(Request $r)
    {
        $messages = [];

        $rules = [
            'username' => 'required|max:191|unique:tb_member,username,' . $r->username . ',username',
            'email' => 'required|max:191',
            'nohp' => 'required|numeric|digits_between:1,15',
        ];

        if ($r->password != null) {
            $rules = array_add($rules, 'password', 'string|min:6|confirmed');
        }

        return Validator::make($r->all(), $rules, $messages);
    }

    public function edit(Request $r)
    {
        if ($this->isValidEdit($r)->fails()) {
            $errors = $this->isValidEdit($r)->errors();
            Alert::error('Gagal Menambahkan Data', 'Ooops');
            return redirect()->back()->withErrors($errors)->withInput();
        } else {
            try {
                $id = $r->oldusername;
                $data = [
                    'username' => $r->username,
                    'email' => $r->email,
                    'nohp' => $r->nohp,
                ];

                if ($r->password != null) {
                    $data = array_add($data, 'password', Hash::make($r->password));
                }

                memberModel::query()
                    ->where('username', '=', $id)
                    ->update($data);
                Alert::success('Success', 'Berhasil Merubah Data');
                return redirect('/admin/member');
            } catch (\Exception  $e) {
                $exData = explode('(', $e->getMessage());
                Alert::error('Gagal Merubah Data \n' . $exData[0], 'Ooops');
                return redirect()->back()->withInput();
            }
        }
    }

    public function delete(Request $r)
    {
        $id = $r->input('id');
        try {
            memberModel::query()
                ->where('id', '=', $id)
                ->delete();
            return response()->json([
                'sukses' => 'Berhasil Di hapus' . $id,
                'sqlResponse' => true,
            ]);
        } catch (\Exception  $e) {
            $exData = explode('(', $e->getMessage());
            return response()->json([
                'gagal' => 'Gagal Menghapus\n',
                'data' =>  $exData[0],
                'sqlResponse' => false,
            ]);
        }
    }
}
