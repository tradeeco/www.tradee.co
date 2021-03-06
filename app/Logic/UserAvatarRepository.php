<?php

namespace App\Logic;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;
use App\Models\UserProfile;
use Illuminate\Support\Facades\Auth;

class UserAvatarRepository
{
    public function upload( $form_data )
    {

//        $validator = Validator::make($form_data, UserProfile::$rules, UserProfile::$messages);
//
//        if ($validator->fails()) {
//
//            return Response::json([
//                'error' => true,
//                'message' => $validator->messages()->first(),
//                'code' => 400
//            ], 400);
//
//        }

        $photo = $form_data['file'];

        $originalName = $photo->getClientOriginalName();
        $extension = $photo->getClientOriginalExtension();
        $originalNameWithoutExt = substr($originalName, 0, strlen($originalName) - strlen($extension) - 1);

        $filename = $this->sanitize($originalNameWithoutExt);
        $allowed_filename = $this->createUniqueFilename( $filename, $extension );

        $uploadSuccess1 = $this->original( $photo, $allowed_filename );

        $uploadSuccess2 = $this->icon( $photo, $allowed_filename );

        if( !$uploadSuccess1 || !$uploadSuccess2 ) {

            return Response::json([
                'error' => true,
                'message' => 'Server error while uploading',
                'code' => 500
            ], 500);

        }

        $user = Auth::user();
        if (count($user->userProfile))
            $sessionUserProfile = $user->userProfile;
        else
            $sessionUserProfile = new UserProfile(['user_id' => $user->id]);
        $sessionUserProfile->image_name      = $allowed_filename;
        $sessionUserProfile->origin_image_name = $originalName;
        $sessionUserProfile->save();

        return Response::json(
            $sessionUserProfile
        , 200);

    }

    public function uploadFromBase64Encoded($photo, $user)
    {
//        $originalName = $photo->getClientOriginalName();
//        $extension = $photo->getClientOriginalExtension();
//        $originalNameWithoutExt = substr($originalName, 0, strlen($originalName) - strlen($extension) - 1);
//
//        $filename = $this->sanitize($originalNameWithoutExt);
//        $allowed_filename = $this->createUniqueFilename( $filename, $extension );

        $allowed_filename  = substr(sha1(mt_rand()), 0, 12);
        $uploadSuccess1 = $this->original( $photo, $allowed_filename.'.jpg' );

        $uploadSuccess2 = $this->icon( $photo, $allowed_filename.'.jpg' );

        if( !$uploadSuccess1 || !$uploadSuccess2 ) {

//            return Response::json([
//                'error' => true,
//                'message' => 'Server error while uploading',
//                'code' => 500
//            ], 500);
            return false;

        }

        if (count($user->userProfile))
            $sessionUserProfile = $user->userProfile;
        else
            $sessionUserProfile = new UserProfile(['user_id' => $user->id]);
        $sessionUserProfile->image_name      = $allowed_filename.'.jpg';
        $sessionUserProfile->origin_image_name = $allowed_filename.'.jpg';
        $sessionUserProfile->save();

        return $sessionUserProfile;
    }

    public function createUniqueFilename( $filename, $extension )
    {
        $full_size_dir =  public_path() . Config::get('frontend.user_avatar_path') . Config::get('frontend.full_size');
        $full_image_path = $full_size_dir . $filename . '.' . $extension;

        if ( File::exists( $full_image_path ) )
        {
            // Generate token for image
            $imageToken = substr(sha1(mt_rand()), 0, 5);
            return $filename . '-' . $imageToken . '.' . $extension;
        }

        return $filename . '.' . $extension;
    }

    /**
     * Optimize Original Image
     */
    public function original( $photo, $filename )
    {
        $manager = new ImageManager();
        $full_path =  public_path() . Config::get('frontend.user_avatar_path');
        $image = $manager->make( $photo )->save($full_path . Config::get('frontend.full_size') . $filename );

        return $image;
    }

    /**
     * Create Icon From Original
     */
    public function icon( $photo, $filename )
    {
        $manager = new ImageManager();
        $full_path =  public_path() . Config::get('frontend.user_avatar_path');
        $image = $manager->make( $photo )->resize(200, null, function ($constraint) {
            $constraint->aspectRatio();
        })
            ->save( $full_path . Config::get('frontend.icon_size')  . $filename );

        return $image;
    }

    /**
     * Delete Image From Session folder, based on original filename
     */
    public function delete( $fileId)
    {

        $full_size_dir =  public_path() . Config::get('frontend.user_avatar_path') . Config::get('frontend.full_size');
        $icon_size_dir =  public_path() . Config::get('frontend.user_avatar_path') . Config::get('frontend.icon_size');

        $sessionImage = UserProfile::where('id', $fileId)->first();


        if(empty($sessionImage))
        {
            return Response::json([
                'error' => true,
                'code'  => 400
            ], 400);

        }

        $full_path1 = $full_size_dir . $sessionImage->file_name;
        $full_path2 = $icon_size_dir . $sessionImage->file_name;

        if ( File::exists( $full_path1 ) )
        {
            File::delete( $full_path1 );
        }

        if ( File::exists( $full_path2 ) )
        {
            File::delete( $full_path2 );
        }

        if( !empty($sessionImage))
        {
            $sessionImage->delete();
        }

        return Response::json([
            'error' => false,
            'code'  => 200
        ], 200);
    }

    public function removeFile($sessionImage)
    {
        $full_size_dir =  public_path() . Config::get('frontend.user_avatar_path') . Config::get('frontend.full_size');
        $icon_size_dir =  public_path() . Config::get('frontend.user_avatar_path') . Config::get('frontend.icon_size');

        $full_path1 = $full_size_dir . $sessionImage->file_name;
        $full_path2 = $icon_size_dir . $sessionImage->file_name;

        if ( File::exists( $full_path1 ) )
        {
            File::delete( $full_path1 );
        }

        if ( File::exists( $full_path2 ) )
        {
            File::delete( $full_path2 );
        }
    }

    function sanitize($string, $force_lowercase = true, $anal = false)
    {
        $strip = array("~", "`", "!", "@", "#", "$", "%", "^", "&", "*", "(", ")", "_", "=", "+", "[", "{", "]",
            "}", "\\", "|", ";", ":", "\"", "'", "&#8216;", "&#8217;", "&#8220;", "&#8221;", "&#8211;", "&#8212;",
            "â€”", "â€“", ",", "<", ".", ">", "/", "?");
        $clean = trim(str_replace($strip, "", strip_tags($string)));
        $clean = preg_replace('/\s+/', "-", $clean);
        $clean = ($anal) ? preg_replace("/[^a-zA-Z0-9]/", "", $clean) : $clean ;

        return ($force_lowercase) ?
            (function_exists('mb_strtolower')) ?
                mb_strtolower($clean, 'UTF-8') :
                strtolower($clean) :
            $clean;
    }
}