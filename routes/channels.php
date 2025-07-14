<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('NewWords', function ($user) {

    // default
    if(!$user){
        return false;//認証済みではない場合はアクセス拒否
    }else {
        return true;
    }
});
