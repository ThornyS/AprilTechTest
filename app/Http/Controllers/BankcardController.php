<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BankcardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->input('clear')) {
            $request->session()->put('bankcards', []);
        }
        return view('bankcards.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage i.e. session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $bankcards_array = [];
        if ($request->session()->get('bankcards')) {
            $bankcards_array = $request->session()->get('bankcards');
        }

        if ($request->hasFile('bank_file')) {
            $FH = fopen($request->file('bank_file'), 'r');
            while (($data = fgetcsv($FH)) !== false) {
                if (preg_match('/[0-9-]+/', $data[1])) {
                    $bankcards_array[] = array(
                        'bank_name' => $data[0],
                        'bank_card' => $data[1],
                        'bank_expiry' => date("d-m-Y", strtotime($data[2]))
                    );
                }
            }
            fclose($FH);

        }
        if ($request->input('bank_card')) {

            $valid = $request->validate([
                'bank_card' => 'required|min:16',
                'bank_expiry' => 'date',
            ]);

            $bankcards_array[] = array(
                'bank_name' => $request->input('bank_name'),
                'bank_card' => $request->input('bank_card'),
                'bank_expiry' => $request->input('bank_expiry')
            );
        }



        $sortme = [];
        foreach ($bankcards_array as $index => $card) {
            $sortme[$index] = strtotime($card['bank_expiry']);
        }
        array_multisort($sortme, SORT_DESC, $bankcards_array);
        $request->session()->put('bankcards', $bankcards_array);
        return redirect()->action('BankcardController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
