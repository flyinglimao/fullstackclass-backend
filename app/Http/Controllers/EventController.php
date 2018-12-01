<?php

namespace App\Http\Controllers;

use App\Event;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $statement = DB::select("show table status like 'events'");
        $next_id =  response()->json(['max_id' => $statement[0]->Auto_increment])->getContent();
        $next_id = json_decode($next_id)->max_id;
        $data = [
            'events'=>Event::paginate(10),
            'next_id'=>$next_id
        ];
        return view('events.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('events.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Validator::make($request->all(),[
            'url'=>'required|url',
            'title'=>'required|string',
            'description'=>'required|string',

            'start_date'=>'required|date|after:now',
            'end_date'=>'required|date|after:start_date',

            'hero_image'=>'image',
            'side_image'=>'image',

        ])->validate();
        //ser image
        $statement = DB::select("show table status like 'events'");
        $new_id =  response()->json(['max_id' => $statement[0]->Auto_increment])->getContent();
        $new_id = json_decode($new_id)->max_id;

        $hero_image_url = '';
        $side_image_url = '';
        if (isset($request['hero_image'])){
            $file1 = $request['hero_image'];
            $filepath1 = 'public/event/';
            $filename1 = 'hero'.$new_id.'.jpg';
            $file1->storeAs($filepath1,$filename1);
            $hero_image_url = 'storage/event/'.$filename1;
        }
        if (isset($request['side_image'])){
            $file2 = $request['side_image'];
            $filepath2 = 'public/event/';
            $filename2 = 'side'.$new_id.'.jpg';
            $file2->storeAs($filepath2,$filename2);
            $side_image_url = 'storage/event/'.$filename2;
        }
        //set filter

        //set time_interval
        $request['time_interval'] = json_encode([
            'start'=>Carbon::createFromFormat('Y-m-d\TH:i',$request->input('start_date')),
            'end'=>Carbon::createFromFormat('Y-m-d\TH:i',$request->input('end_date')),
        ]);

        $array = $request->all();
        $array['hero_image'] = $hero_image_url;
        $array['side_image'] = $side_image_url;

        Event::create($array);

        return redirect()->route('events.index');

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
     * @param  Event $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        $data = [
            'event'=>$event
        ];
        return view('events.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Event $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Event $event)
    {
        Validator::make($request->all(),[
            'url'=>'required|url',
            'title'=>'required|string',
            'description'=>'required|string',

            'start_date'=>'required|date|after:now',
            'end_date'=>'required|date|after:start_date',
            'hero_image'=>'image',
            'side_image'=>'image',

        ])->validate();


        $hero_image_url = '';
        $side_image_url = '';
        if (isset($request['hero_image'])){
            $file1 = $request['hero_image'];
            $filepath1 = 'public/event/';
            $filename1 = 'hero'.$event->id.'.jpg';
            $file1->storeAs($filepath1,$filename1);
            $hero_image_url = 'storage/event/'.$filename1;
        }
        if (isset($request['side_image'])){
            $file2 = $request['side_image'];
            $filepath2 = 'public/event/';
            $filename2 = 'side'.$event->id.'.jpg';
            $file2->storeAs($filepath2,$filename2);
            $side_image_url = 'storage/event/'.$filename2;
        }
        //set time_interval
        $request['time_interval'] = json_encode([
            'start'=>Carbon::createFromFormat('Y-m-d\TH:i',$request->input('start_date')),
            'end'=>Carbon::createFromFormat('Y-m-d\TH:i',$request->input('end_date')),
        ]);


        //set image
        $array = $request->except(['start_date','end_date']);
        if (isset($array['hero_image']))
            $array['hero_image'] = $hero_image_url;
        if (isset($array['side_image']))
            $array['side_image'] = $side_image_url;
        $event->update($array);

        return redirect()->route('events.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Event $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        $event->delete();
        return redirect()->route('events.index');
    }
}
