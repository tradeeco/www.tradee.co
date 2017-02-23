<?php
function active_class($controller, $currentController) {
    if ($controller == $currentController)
        return 'active';
    else return '';
}

function userImage($user) {
    if (count($user->userProfile) && $user->userProfile->image_name != '')
        return Config::get('frontend.user_avatar_path').Config::get('frontend.full_size').$user->userProfile->image_name;
    else return 'img/default-profile.jpg';
}

function userImageSmall($user) {
    if (count($user->userProfile) && $user->userProfile->image_name != '')
        return Config::get('frontend.user_avatar_path').Config::get('frontend.icon_size').$user->userProfile->image_name;
    else return 'img/default-profile.jpg';
}

function jobPhotoSrc($photo)
{
    return Config::get('frontend.job_photo_path').Config::get('frontend.full_size').$photo->file_name;
}

function getControllerName($fullPath)
{
    if (!isset($controller)) {
        list($controller, $action) = explode('@', $fullPath);
        $controller = basename($controller);
        return $controller;
    }
}

function getActionName($fullPath)
{
    if (!isset($controller)) {
        list($controller, $action) = explode('@', $fullPath);
        return $action;
    }
}

