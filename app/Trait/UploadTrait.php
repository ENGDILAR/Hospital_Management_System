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
         // any one will use this function can change the name of  the input like image for doctors an photo for patients 
         // this name given in <input >when you want to 
        if( $request->hasFile( $inputname ) ) {
 // foldername is the folder that will opened when we will add a file
            // Check img
            if (!$request->file($inputname)->isValid()) {
               session()-> flash('Invalid Image!')->error()->important();
                return redirect()->back()->withInput();
            }
        
            $photo = $request->file($inputname);
            $name = \Str::slug($request->input('name'));//change the name of the photo
// dilar
            $filename = $name. '.' . $photo->getClientOriginalExtension();//get the extention like .jpg or .png

//dilar +.png 
//imageable_id determine that is the photo is belong to that user with that id
//imageable_type tell you about the model that have this photo

            // insert Image
            $Image = new Image();
            $Image->filename = $filename;//photo name
            $Image->imageable_id = $imageable_id;// 
            $Image->imageable_type = $imageable_type;
            $Image->save();
            //$disk we create a disk from type upload image to put the the file in disk destination (read config/filesystem)
            // disk is the name of the folder that i will put the photo in it and i can create a new disk 
            return $request->file($inputname)->storeAs($foldername, $filename, $disk);// store the filename in folder that will be in disk
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
/*
 //delete func for pic 
    public function Delete_attachment($disk,$path,$id){
  // we pass the disk as a variable to pass a diffrent values //public or upload image disk 
  // disk func take a name that references to a field in config/filesystem
        Storage::disk($disk)->delete($path);
        //path is like /Dashboard/(doctors.file)....
        image::where('imageable_id',$id)->delete();
        

    }
        */


    public function Delete_attachment($disk,$path,$id){

              Storage::disk($disk)->delete($path);
        
              image::where('imageable_id',$id)->delete();
              
      
          }



}
