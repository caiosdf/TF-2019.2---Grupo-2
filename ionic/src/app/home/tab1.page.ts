import { Component } from '@angular/core';
import { PostService } from '../post.service';

@Component({
  selector: 'app-tab1',
  templateUrl: 'tab1.page.html',
  styleUrls: ['tab1.page.scss']
})
export class Tab1Page {

  posts;

  constructor(public postService: PostService) {
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

  ngOnInit(){
  }
}
