<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Client;
use App\Room;

class RoomsController extends Controller
{
    //
    public function checkAvailableRooms($client_id, Request $request)
    {
        $data = [];
        $client = new Client();
        $room = new Room();

        if( $request->isMethod('get')){
            $dateFrom = '';
            $dateTo = '';
            $data['rooms'] = [];
        } else {
            $this->validate(
                $request,
                [
                    'dateFrom' => 'required',
                    'dateTo' => 'required'
                ]
            );

            $dateFrom = $request->input('dateFrom');
            $dateTo = $request->input('dateTo');
            $data['rooms'] = $room->getAvailableRooms($dateFrom, $dateTo);
        }

        $data['dateFrom'] = $dateFrom;
        $data['dateTo'] = $dateTo;
        $data['client'] = $client->find($client_id);

        return view('rooms/checkAvailableRooms', $data);
    }
}
