import { Component } from '@angular/core';
import { PostService } from '../post.service';
import { NavController } from '@ionic/angular'
import { Router } from '@angular/router'

@Component({
  selector: 'app-tab1',
  templateUrl: 'tab1.page.html',
  styleUrls: ['tab1.page.scss']
})
export class Tab1Page {

  posts;

  constructor(public postService: PostService, public navCtrl: NavController, private router: Router) {
  }

  getPosts():void{
    this.postService.getPosts().subscribe(
      (res) => {
        console.log(res);
        this.posts = res;
        for (let post in this.posts) {
          console.log(post);
        }
      }
    );
  }
  showPost(id){
    console.log(id)
    this.router.navigateByUrl('/post',id);
  }

  ngOnInit(){
    this.getPosts()
  }
}
