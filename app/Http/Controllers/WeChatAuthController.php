<?php

namespace App\Http\Controllers;

use Log;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Libraries\WeChatCenterControl;

class WeChatAuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        // $test = ClassName::is_OK('hahahaha');
        // echo $test;
        $signature = $request->input('signature');
        $echostr = $request->input('echostr');
        $array = $request->only(['timestamp','nonce']);
        $array[] = WeChatCenterControl::TOKEN;
        if (WeChatCenterControl::$ACCESS_TOKEN === '') {
            WeChatCenterControl::request_access_token();
        }
        Log::info("request info " ,[$request->fullUrl(),
                                    $request->all()
                                    ]);
        if ($this->validSignature($signature, array_values($array))) {
          return  $echostr;
        }else {
          return 'invalid';
        }
    }

    private function validSignature($signature, $array)
    {
      if (!WeChatCenterControl::TOKEN) {
        throw new Exception('TOKEN is not defined!');
      }
      sort($array, SORT_STRING);
      $tmpStr = implode($array);
      $tmpStr = sha1($tmpStr);
      return $signature == $tmpStr;
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
        //
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
