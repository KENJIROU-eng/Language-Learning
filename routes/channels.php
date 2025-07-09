<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('group.{groupId}', function ($user, $groupId) {

    // default
    if(!$user){
        return false;//認証済みではない場合はアクセス拒否
    }else {
        return true;
    }
});
