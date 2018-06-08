<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Kadai; 

class KadaisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [];
        if (\Auth::check()) {
            $user = \Auth::user();
            $kadais = $user->kadais()->orderBy('created_at', 'desc')->paginate(10);

            $data = [
                'user' => $user,
                'kadais' => $kadais,
            ];
    
            return view('kadais.index', ['kadais'=>$kadais]);
        }else {
            return view('welcome');
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kadai = new Kadai;

        return view('kadais.create', [
            'kadai' => $kadai,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $this->validate($request, [
            'status' => 'required|max:10',   // add
            'content' => 'required|max:191',
        ]);

        
        $request->user()->kadais()->create([
        'status' => $request->status,
        'content' => $request->content,
        ]);

        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       $kadai = Kadai::find($id);
        $auth_user = \Auth::user();
        if($kadai-> user_id == $auth_user-> id){
        
        return view('kadais.show', [
            'kadai' => $kadai,
        ]);
        }
        else{
            return redirect('/');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         $kadai = Kadai::find($id);
        $auth_user = \Auth::user();
        if($kadai-> user_id == $auth_user-> id){
        
        return view('kadais.edit', [
            'kadai' => $kadai,
        ]);
        }
        else{
            return redirect('/');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'status' => 'required|max:10',   // add
            'content' => 'required|max:191',
        ]);

       
        $kadai = Kadai::find($id);
        $kadai->status = $request->status;    // add 
        $kadai->content = $request->content;
        $kadai->save();

        return redirect('/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kadai = \App\kadai::find($id);

        if (\Auth::user()->id === $kadai->user_id) {
            $kadai->delete();
        }

        return redirect()->back();
    }
}