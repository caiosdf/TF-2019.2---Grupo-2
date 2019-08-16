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
  posts = {id:null , title:null, text:null, user_id:null, user_name:null }
  post;

  constructor(public service: PostService, public navCtrl: NavController, private router: Router) { 
    this.post = this.router.getCurrentNavigation().extras
  }

  getPost (id):void{
    // console.log(this.service + "Resgatando pessoas no Back")
    this.service.getPost(id).subscribe( (res) => { this.posts = res;console.log(res) } );
  }


  ionViewDidEnterr() {
  }

  ngOnInit(){
        // console.log(id)
    this.getPost(this.post);
  }
}
