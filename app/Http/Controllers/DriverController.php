<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DriverController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
 public function push()
    {
         error_reporting(-1);
        ini_set('display_errors', 'On');

         $res = array();
           $payload = array();
        $payload['team'] = 'Hamieh';
        $payload['score'] = '1991';

         
        $res['data']['title'] = 'Hello title';
        $res['data']['is_background'] = TRUE;
        $res['data']['message'] = 'message hamieh test';
        $res['data']['image'] = 'http://api.androidhive.info/images/minion.jpg';
        $res['data']['payload'] = $payload;
        $res['data']['timestamp'] = date('Y-m-d G:i:s');


// return $res;
        $to = 'eTaFMH5tqZs:APA91bFDjRJDKFzrXYJbVNaORVoNt6ihtB9ctZvrGKFFj61fmH7Y-BNydxZr5WmaEmVULZ9bCIBtCWgOt6sI--pQj7pRyhkZH8TPKxBek2NKK_TJjk7mfVG72dSxNtuhqjJkPTL-UdsY';
        $message = 'hello hamieh';
       $fields = array(
            'to' => $to,
            'data' => $res,
        );
        $api_key = 'AAAAk_ZIjvo:APA91bHCeVT1_EjwqZufv5qpxb2fbi-m2CguR47HwSOVLGOFZCoaAqvm_Ox0QyjeG_XQbsm3aFB8ZQcR8gf1ZfArn2vdttZBHcC021_A1pQmwFFDDEnqNs7JDkP8XEBeb_hxzSfsAqWI';
        $url = 'https://fcm.googleapis.com/fcm/send';
        $headers = array(
            'Authorization: key='.$api_key,
            'Content-Type: application/json'
        );
        // Open connection
        $ch = curl_init();

        // Set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_URL, $url);

        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Disabling SSL Certificate support temporarly
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));

        // Execute post
        $result = curl_exec($ch);
        if ($result === FALSE) {
            die('Curl failed: ' . curl_error($ch));
        }

        // Close connection
        curl_close($ch);

        return $result;


    }



    public function index()
    {
        //
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
