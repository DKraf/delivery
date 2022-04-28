<?php


namespace App\Http\Service;


use Illuminate\Support\Facades\Mail;


/**
 * Class AssigenTestService
 * @package App\Http\Service
 * @author [Kravchenko Dmitriy => RedHead-DEV]
 */
class Email
{
    public function send($id)
    {
        $data = [
            'no-reply' => 'Test@Test.com',
            'admin'    => 'Test@Test.com',
            'Email'    => $request->get('Email'),
            'Phone'    => $request->get('Phone'),
            'Order'    => $request->get('Order'),
        ];

        Mail::send('about.contact', ['data' => $data],
            function ($message) use ($data)
            {
                $message
                    ->from($data['no-reply'])
                    ->to($data['admin'])->subject('Some body wrote to you online')
                    ->to($data['Email'])->subject('Your submitted information')
                    ->to('elbiheiry2@gmail.com', 'elbiheiry')->subject('Feedback');
            });
    }
}
