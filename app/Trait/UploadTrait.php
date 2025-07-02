<?php

namespace App\Trait;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str; 
trait UploadTrait{


    // addimage 
    public function verifyAndStoreImage(Request $request, $inputname , $foldername , $disk, $imageable_id, $imageable_type)
     {
      
        if( $request->hasFile( $inputname ) ) {
            if (!$request->file($inputname)->isValid()) {
               session()-> flash('Invalid Image!')->error()->important();
                return redirect()->back()->withInput();
            }
        
            $photo = $request->file($inputname);
            $name = \Str::slug($request->input('name'));

            $filename = $name. '.' . $photo->getClientOriginalExtension();

            $Image = new Image();
            $Image->filename = $filename;//photo name
            $Image->imageable_id = $imageable_id;// 
            $Image->imageable_type = $imageable_type;
            $Image->save();
   
            return $request->file($inputname)->storeAs($foldername, $filename, $disk);
        }

        return null;

    }


    public function verifyAndStoreImageForeach($varforeach , $foldername , $disk, $imageable_id, $imageable_type) {

        // insert Image
        $Image = new Image();
        $Image->filename = $varforeach->getClientOriginalName();
        $Image->imageable_id = $imageable_id;
        $Image->imageable_type = $imageable_type;
        $Image->save();
        return $varforeach->storeAs($foldername, $varforeach->getClientOriginalName(), $disk);
    }



    public function Delete_attachment($disk,$path,$id){

              Storage::disk($disk)->delete($path);
        
              image::where('imageable_id',$id)->delete();
              
      
          }



}
