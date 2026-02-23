<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function customerMessages()
    {
        return view('customer.messages');
    }

    public function send(Request $request)
    {
        return response()->json(['success' => true]);
    }

    public function show($id)
    {
        return view('messages.show');
    }

    public function getConversation($userId)
    {
        return response()->json([]);
    }

    public function markAsRead(Request $request, $id)
    {
        return response()->json(['success' => true]);
    }

    public function index()
    {
        return view('admin.messages.index');
    }

    public function reply(Request $request, $id)
    {
        return redirect()->back()->with('success', 'Reply sent successfully.');
    }
}
