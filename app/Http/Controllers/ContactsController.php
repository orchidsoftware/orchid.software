<?php

namespace App\Http\Controllers;

use App\Http\Requests\SupportRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Mail;


class ContactsController extends Controller
{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('pages.contact');
    }

    /**
     * @param SupportRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function send(SupportRequest $request)
    {

        Mail::send('emails.support', ['request' => $request->all()], function ($message) use ($request) {
            $message
                ->to(Config::get('link.email'))
                ->subject('Сообщение с веб-сайта');

            if (!is_null($request->file('upload'))) {
                $message->attach($request->file('upload'), [
                    'as'   => $request->file('upload')->getClientOriginalName(),
                    'mime' => $request->file('upload')->getMimeType(),
                ]);
            }
        });

        return response()->json([
            'title'   => 'Успешно',
            'message' => 'Данные сохранены',
            'type'    => 'success',
        ]);
    }

}
