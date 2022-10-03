<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pinjaman;
use Calendar;

class CalendarController extends Controller
{
    public function index(Request $request)
    {
        $events = [];
        $data = Pinjaman::all();
        if($data->count()) {
            foreach ($data as $key => $value) {
                if($value->status_pinjaman_id == 1) {
                    $color = '#FF0000';
                } else if($value->status_pinjaman_id == 2) {
                    $color = '#FFA500';
                } else if($value->status_pinjaman_id == 3) {
                    $color = '#008000';
                } else if($value->status_pinjaman_id == 4) {
                    $color = '#0000FF';
                } else if($value->status_pinjaman_id == 5) {
                    $color = '#000000';
                } else {
                    $color = '#000000';
                }
                $events[] = Calendar::event(
                    $value->keperluan,
                    true,
                    new \DateTime($value->tanggal_pinjam),
                    new \DateTime($value->tanggal_pinjam),
                    null,
                    // Add color and link on event
                    [
                        'color' => $color,
                    ]
                );
            }
        }
        $calendar = Calendar::addEvents($events);
        return view('calendar.index', [
            'title' => 'Calendar',
            'calendar' => $calendar,
            'active' => 'Calendar'
        ]);
    }
}
