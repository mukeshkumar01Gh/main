<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $newFile    = "mk.txt";
        $path       = public_path() . "/folder/";
        if (File::exists($path . $newFile)) {
            $json       = file_get_contents($path . $newFile);
            $jsonData   = json_decode($json);

            return response()->json([
                'statusCode'    => 200,
                'status'        => 'success',
                'message'       => "Data Updated successfully",
                'data'          => $jsonData
            ]);
        } else {
            return response()->json([
                'statusCode'    => 400,
                'status'        => 'failed',
                'message'       => "No record found",
                'data'          => []
            ]);
        }
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        info($request->all());
        $variable = "username={{$request['username']}}&email={{$request['email']}}&first_name={{$request['first_name']}}&last_name={{$request['last_name']}}";
        $hashedValue = Hash::make($variable);
        $url = url('/user-list?' . $hashedValue);
        $data       = $request->all();
        $newFile    = "mk.txt";
        $path       = public_path() . "/folder/";
        info($path);
        if (!is_dir($path)) {
            mkdir($path, 0777, true);
        }
        if (File::exists($path . $newFile)) {
            $json       = file_get_contents($path . $newFile);
            $jsonData   = json_decode($json);
            $oldId      = count($jsonData);
            $data['id'] = $oldId + 1;
            array_push($jsonData, $data);
            $req = json_encode($jsonData);
        } else {
            $data['id'] = 1;
            $req   = json_encode([$data]);
        }
        $response = File::put($path . $newFile, $req);
        if ($response) {
            return response()->json([
                'statusCode'    => 200,
                'status'        => 'success',
                'message'       => "Data saved successfully",
                'URL'       => $url
            ]);
        } else {
            return response()->json([
                'statusCode'    => 400,
                'status'        => 'failed',
                'message'       => "file already created",
                'user_id'       => null
            ]);
        }
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
        $newFile    = "mk.txt";
        $path       = public_path() . "/folder/";

        if (File::exists($path . $newFile)) {
            $json       = file_get_contents($path . $newFile);
            $jsonData   = json_decode($json);
            $isExists = 0;
            foreach ($jsonData as $editData) {
                if ($editData->id == $id) {
                    $isExists = 1;
                    foreach ($request->all() as $key => $value) {
                        $editData->$key = $value;
                    }
                }
            }

            $req = json_encode($jsonData);
            $response = File::put($path . $newFile, $req);
            if ($isExists == 1) {
                return response()->json([
                    'statusCode'    => 200,
                    'status'        => 'success',
                    'message'       => "Data Updated successfully",
                ]);
            } else {
                return response()->json([
                    'statusCode'    => 400,
                    'status'        => 'failed',
                    'message'       => "User id not exist",
                ]);
            }
        }
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
