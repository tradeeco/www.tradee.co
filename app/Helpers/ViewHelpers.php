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
    else return '/img/default-profile.jpg';
}

function jobPhotoSrc($photo)
{
    return Config::get('frontend.job_photo_path').Config::get('frontend.full_size').$photo->file_name;
}

function jobPhotoSmallSrc($photo)
{
    if ($photo)
        return Config::get('frontend.job_photo_path').Config::get('frontend.icon_size').$photo->file_name;
    else
        return '';
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

// only for remove tagged user button
function getTaggedRemoveButtonId($tag)
{
    if ($tag == 1)
        return 'delete_user_interested';
    elseif ($tag == 2)
        return 'delete_user_shortlisted';
    else
        return 'delete_user_selected';
}

function full_name($object)
{
    return ucfirst($object->first_name) . ' ' . ucfirst($object->last_name);
}