import { Component, OnInit } from '@angular/core';
import { Camera, CameraOptions } from '@ionic-native/camera/ngx'

@Component({
  selector: 'app-postnovo',
  templateUrl: './postnovo.page.html',
  styleUrls: ['./postnovo.page.scss'],
})

export class PostnovoPage implements OnInit {
    myPhoto;
    
    openCamera() {
    const options: CameraOptions = {
      quality: 100,
      destinationType: this.camera.DestinationType.FILE_URI,
      encodingType: this.camera.EncodingType.JPEG,
      mediaType: this.camera.MediaType.PICTURE
    };
 
    this.camera.getPicture(options).then(
      (imageData) => {
        this.myPhoto = 'data:image/jpeg;base64,' + imageData;
        console.log('data:image/jpeg;base64,' + imageData);
      },
      (error) => {
        console.log(error);
      }
    );
  }
  openGallery() {
    const options: CameraOptions = {
      quality: 100,
      destinationType: this.camera.DestinationType.DATA_URL,
      sourceType: this.camera.PictureSourceType.PHOTOLIBRARY,
      saveToPhotoAlbum: false
    };
 
    this.camera.getPicture(options).then(
      (imageData) => {
        this.myPhoto = 'data:image/jpeg;base64,' + imageData;
        console.log('data:image/jpeg;base64,' + imageData);
      },
      (error) => {
        console.log(error);
      }
    );
  }
  constructor(private camera: Camera) { }
  
  ngOnInit() {
  }

}
