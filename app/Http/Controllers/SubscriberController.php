<?php

namespace App\Http\Controllers;
use App\Models\User;
use Datatables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Validation\Rule;


class SubscriberController extends Controller
{

    use RegistersUsers;

    public function index(Request $request)
        {

            if ($request->ajax()) {

                $data = User::latest()->get();


                return Datatables::of($data)
                        ->addIndexColumn()
                        ->addColumn('action', function($row){

                               $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editSubscriber">Edit</a>';

                               $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteSubscriber">Delete</a>';

                                return $btn;
                        })
                        ->rawColumns(['action'])
                        ->make(true);
            }

            return view('subscribers');
        }
        //////////////
        // protected function validator(array $data)
        // {
        //     return Validator::make($data, [
        //         'name' => ['required', 'string', 'max:255'],
        //         'username' => ['required', 'string', 'max:255'],
        //         'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($this->user()->id, 'id')],
        //         'password' => ['required', 'string', 'min:8', 'confirmed'],
        //     ]);
        // }
        ////////
        public function store(Request $request)
        {
            // $this->validate($request,[
            //     'name' => [ 'string', 'max:255'],
            //     'username' => [ 'string', 'max:255'],
            //     'email' => [ 'string', 'email', 'max:255', 'unique:users,email,'.$request->subscriber_id],
            //     'password' => [ 'string', 'min:8', 'confirmed'],
            //     ]);

            $validated = $request->validate([
                'email' => [ 'string', 'email', 'max:255', 'unique:users,email,id'],
            ]);
            User::updateOrCreate([
                        'id' => $request->subscriber_id
                    ],
                    [
                        'name' => $request->name,
                        'username' => $request->username,
                        'email' => $request->email,
                        'password' => $request->password
                    ]);


            return response()->json(['success'=>'Subscriber saved successfully.']);
        }
        ////////
        public function edit($id)
        {

            $subscriber = User::find($id);
            return response()->json(['name'=>$subscriber->name,'username'=>$subscriber->username,
            'email'=>$subscriber->email,'password'=>$subscriber->password]);



        }
        ////////

        ////////
        public function destroy($id)
        {
            User::find($id)->delete();

            return response()->json(['success'=>'Subscriber deleted successfully.']);
        }
}
