import { Component, OnInit } from '@angular/core';
import { PostService } from '../post.service';
import { NavController } from '@ionic/angular'
import { Router } from '@angular/router';

@Component({
  selector: 'app-post',
  templateUrl: './post.page.html',
  styleUrls: ['./post.page.scss'],
})
export class PostPage implements OnInit {
  posts;
  post;

  constructor(public service: PostService, public navCtrl: NavController, private router: Router) { 
    this.post = this.router.getCurrentNavigation().extras
  }









  getPost (id):void{
    // console.log(this.service + "Resgatando pessoas no Back")
    console.log("papapapa");
    this.service.getPost(id).subscribe( (res) => { this.posts = res;console.log(this.post) } );
  }


  ionViewDidEnterr() {
  }

  ngOnInit(){
        // console.log(id)
    this.getPost(this.post);
    console.log('pepepepe');
    console.log(this.post);
    
  }
}
