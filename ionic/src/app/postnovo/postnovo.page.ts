import { Component, OnInit } from '@angular/core';
import { Camera, CameraOptions } from '@ionic-native/camera/ngx'
import { PostService } from '../post.service'
import { FormGroup, FormBuilder, Validators } from '@angular/forms';
import { AuthService } from '../services/auth.service';
import { NavController } from '@ionic/angular';

@Component({
  selector: 'app-postnovo',
  templateUrl: './postnovo.page.html',
  styleUrls: ['./postnovo.page.scss'],
})

export class PostnovoPage implements OnInit {

  public post: FormGroup;
  

  constructor(private camera: Camera, private fconstrutor: FormBuilder, 
              public postService: PostService, 
              public authService: AuthService,
              public navCtrl: NavController,) {
    this.post = this.fconstrutor.group({
      'title' : ['', Validators.compose([
        Validators.required
      ])],
      'text' : ['', Validators.compose([
        Validators.required
      ])],
      'photo' : ['']
    });
  }

  

     myPhoto;
     user;
    
    openCamera() {
      const options: CameraOptions = {
        quality: 100,
        destinationType: this.camera.DestinationType.FILE_URI,
        encodingType: this.camera.EncodingType.JPEG,
        mediaType: this.camera.MediaType.PICTURE
      };
  
      this.camera.getPicture(options).then(
        (imageData) => {
          this.myPhoto = 'data:image/jpeg,' + imageData;
          console.log('data:image/jpeg,' + imageData);
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
  
  sendPost( form ){
    
    if(form.status=='VALID'){
      this.postService.sendPost( form.value.title, form.value.text, this.myPhoto ).subscribe(
        (res) => {
          console.log( res );
          this.navCtrl.navigateRoot('/tabs/home');
        }
      );
    }
  }

  usuarioLogado(){
    this.authService.usuarioLogado().subscribe(
      (res) => {
        this.user = res;
        console.log(this.user);
      }
    );
  }



  ngOnInit() {
    this.usuarioLogado();
  }

}
