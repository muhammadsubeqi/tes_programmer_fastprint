<?php

namespace App\Http\Services;

class Api {

    public function product()
    {
        // Untuk cek password dan username saya menggunakan POSTMAN  
        $username = 'tesprogrammer090523C22';
        $password = md5('bisacoding-09-05-23');
        $post = [
            'username' => $username,
            'password' => $password,
        ];
        // API tes programmer
        $URL = 'https://recruitment.fastprint.co.id/tes/api_tes_programmer';
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL,$URL);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);

        $result=curl_exec ($ch);
        curl_close ($ch);

        return $result;
    }

}