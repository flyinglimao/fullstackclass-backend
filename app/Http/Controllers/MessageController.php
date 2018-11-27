<?php

namespace App\Http\Controllers;

<<<<<<< HEAD
use App\User;
use Illuminate\Http\Request;
use App\Message;
use Illuminate\Support\Facades\Validator;
=======
use Illuminate\Http\Request;
>>>>>>> 2bfabbdf525ede825b91026121ed9740995f479a

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
<<<<<<< HEAD
        $data = [
            'messages' =>Message::OrderBy('updated_at','DEC')->get(),
        ];
        return view('messages.index',$data);
=======
        //
>>>>>>> 2bfabbdf525ede825b91026121ed9740995f479a
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
<<<<<<< HEAD
        return view('messages.create');
=======
        //
>>>>>>> 2bfabbdf525ede825b91026121ed9740995f479a
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
<<<<<<< HEAD
        $validator = Validator::make($request->all(), [
            'sender_id' => 'required|integer',
            'receiver_id' => 'required|integer',
            'type' => 'required|integer',
            'title' => 'required|string',
            'message' => 'required|string'
        ]);

        $validator->after(function ($validator) use ($request) {

            $sender_exist = User::where('id',$request->input('sender_id'))->first();
            $receiver_exist = User::where('id',$request->input('receiver_id'))->first();

            if ($sender_exist == null)
                $validator->errors()->add('sender_id', 'This sender_id does not exist!');
            if ($receiver_exist == null)
                $validator->errors()->add('receiver_id', 'This receiver_id does not exist!');

        });
        $validator->validate();
        Message::create($request->all());
        return redirect()->route('messages.index');
=======
        //
>>>>>>> 2bfabbdf525ede825b91026121ed9740995f479a
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
<<<<<<< HEAD
     * @param  Message $message
     * @return \Illuminate\Http\Response
     */
    public function edit(Message $message)
    {
        $data = [
            'message'=>$message
        ];
        return view('messages.edit',$data);
=======
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
>>>>>>> 2bfabbdf525ede825b91026121ed9740995f479a
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
<<<<<<< HEAD
     * @param  Message $message
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Message $message)
    {
        $validator = Validator::make($request->all(), [
            'sender_id' => 'required|integer',
            'receiver_id' => 'required|integer',
            'type' => 'required|integer',
            'title' => 'required|string',
            'message' => 'required|string'
        ]);

        $validator->after(function ($validator) use ($request) {

            $sender_exist = User::where('id',$request->input('sender_id'))->first();
            $receiver_exist = User::where('id',$request->input('receiver_id'))->first();

            if ($sender_exist == null)
                $validator->errors()->add('sender_id', 'This sender_id does not exist!');
            if ($receiver_exist == null)
                $validator->errors()->add('receiver_id', 'This receiver_id does not exist!');

        });
        $validator->validate();
        $message->update($request->all());
        return redirect()->route('messages.index');
=======
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
>>>>>>> 2bfabbdf525ede825b91026121ed9740995f479a
    }

    /**
     * Remove the specified resource from storage.
     *
<<<<<<< HEAD
     * @param  Message $message
     * @return \Illuminate\Http\Response
     */
    public function destroy(Message $message)
    {
        $message->delete();
        return redirect()->route('messages.index');
=======
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
>>>>>>> 2bfabbdf525ede825b91026121ed9740995f479a
    }
}
