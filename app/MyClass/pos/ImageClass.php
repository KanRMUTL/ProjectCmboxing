<?php

namespace App\MyClass\pos;

use Illuminate\Http\Request;

class ImageClass {
     public $imgFile;
     public $destinationPath;
     public $imageName;
     public $originalName;
     public $destinationArray;
     public function __construct($type, $imgFile) {
          $this->destinationArray = [
               'ticket' => 'shopping\img\ticket\\',
               'product' => 'pos\product\\',
               'trainer' => 'shopping\img\trainer\\',
               'user' => 'images\userImg\\'
          ];
          $this->destinationPath = $this->destinationArray[$type];
          $this->imgFile = $imgFile;
     }

     public function uploadImage() {
          $orginalName = $this->imgFile->getClientOriginalName();      
          $this->imageName = date('Ymd_His_').$orginalName;    
          $destination =  base_path().'/public/'.$this->destinationPath;
          $this->imgFile->move($destination, $this->imageName);
     }

     public function updateImage() {
          unlink(public_path($this->destinationPath.$this->originalName));
          $this->uploadImage();
     }
}