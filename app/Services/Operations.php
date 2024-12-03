<?php

namespace App\Services;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
class Operations {
    public static function decryptId($value) {
        try {
            $decoded = Crypt::decrypt($value);
            
        } catch (DecryptException $th) {
            return \redirect()->route('home');
        }
       return $decoded;
    }
}