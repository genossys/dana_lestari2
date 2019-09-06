<?php

namespace App\Http\Controllers\Admin\Master;

use App\User;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Alert;

class userController extends Controller
{
    //

    //menampilkan halaman user
    public function index()
    {
        return view('admin.master.user.page');
    }

    public function showForm()
    {
        return view('admin.master.user.form');
    }

    public function store(Request $r)
    {
        $user = User::where('id', '=', $r->id)->firstOrFail();
        return view('admin.master.user.update')->with(['user' => $user]);
    }
    //menampilkan data user
    public function getData()
    {
        $user = User::query()
            ->select('id', 'username', 'email', 'hakAkses', 'noHp')
            ->get();

        return DataTables::of($user)
            ->addIndexColumn()
            ->addColumn('action', function ($user) {
                return '<a class="btn-sm btn-warning" data-toggle="tooltip" title="Ganti Data" id="btn-edit" href="/admin/user/store?id=' . $user->id . '"><i class="fa fa-edit"></i></a>
                            <a class="btn-sm btn-danger" data-toggle="tooltip" title="Hapus Data" id="btn-delete" href="#" onclick="hapus(\'' . $user->id . '\',event)"><i class="fa fa-trash"></i></a>
                        ';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    private function isValid(Request $r)
    {
        $messages = [];

        $rules = [
            'username' => 'required|max:191|unique:tb_user,username',
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
                $user = new User();
                $user->username = $r->username;
                $user->email = $r->email;
                $user->password = Hash::make($r->password);
                $user->nohp = $r->nohp;
                $user->hakAkses = $r->hakAkses;
                $user->save();
                Alert::success('Success', 'Berhasil Menambahkan Data');
                return redirect()->back();
            } catch (\Exception  $e) {
                $exData = explode('(', $e->getMessage());
                Alert::error('Gagal Merubah Data \n' . $exData[0], 'Ooops');
                return redirect()->back()->withInput();
            }
        }
    }

    private function isValidEdit(Request $r)
    {
        $messages = [];

        $rules = [
            'username' => 'required|max:191|unique:tb_user,username,' . $r->username . ',username',
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
                    'nohp' => '62' . $r->nohp,
                    'hakAkses' => $r->hakAkses
                ];
                if ($r->password != null) {
                    $data = array_add($data, 'password', Hash::make($r->password));
                }

                User::query()
                    ->where('username', '=', $id)
                    ->update($data);
                Alert::success('Success', 'Berhasil Merubah Data');
                return redirect('/admin/user');
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
            User::query()
                ->where('id', '=', $id)
                ->delete();;
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
