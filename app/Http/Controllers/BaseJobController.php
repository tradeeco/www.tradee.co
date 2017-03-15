<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Logic\IonicPush;
use App\Models\Notification as NotificationModel;
use App\User;

class BaseJobController extends Controller
{
    //

    /*
     * store to notification
     */

    protected function storeJobToNotification($job, $type) {
        $notiUsers = User::where('area_suburb_id', $job->area_suburb_id)->get();
        foreach ($notiUsers as $user) {
            $noti = new NotificationModel;
            $noti->user_id = $user->id;
            $noti->job_id = $job->id;
            $noti->type = $type;
            $noti->message = "a new job <" . $job->title . "> has been posted in your area! do not miss out, express interest now";
            $noti->save();

            $deviceTokenArray = $user->userDevices->pluck('device_token')->all();
            if (count($deviceTokenArray) > 0) {
                $ionicPush = new IonicPush();

                $ionicPush->setConfig([
                    "message" => $noti->message
                ]);

                $ionicPush->setPayload([
                    "myCustomField" => "custom filed content",
                    "anotherCustomField" => "More custom content"
                ]);


                $result = $ionicPush->sendPush($deviceTokenArray);
            }

        }


    }


    protected function storeInterestToNotification($interestUser, $job) {
        $type = 1;
        $noti = new NotificationModel;
        $noti->user_id = $job->user->id;
        $noti->job_id = $job->id;
        $noti->type = $type;
        $noti->message = $interestUser->first_name." has express interested to your job <" . $job->title . ">, please check your job";
        $noti->save();

        $deviceTokenArray = $job->user->userDevices->pluck('device_token')->all();
        if (count($deviceTokenArray) > 0) {
            $ionicPush = new IonicPush();

            $ionicPush->setConfig([
                "message" => $noti->message
            ]);

            $ionicPush->setPayload([
                "myCustomField" => "custom filed content",
                "anotherCustomField" => "More custom content"
            ]);


            $result = $ionicPush->sendPush($deviceTokenArray);
        }
    }

}
