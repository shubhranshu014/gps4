<?php
use Illuminate\Support\Facades\Crypt;

// function encrypt($data)
// {
//     $encryptedMessage = Crypt::encrypt($data);
//     return $encryptedMessage;
// }

// function decrypt($data)
// {
//     $decryptedMessage = Crypt::decrypt($data);
//     return $decryptedMessage;
// }

function uploadFile($file, $prefix)
{
    $filename = time() . rand(1, 99) . '_' . $prefix . '.' . $file->extension();
    $file->storeAs('uploads', $filename);
    return $filename;
}



?>