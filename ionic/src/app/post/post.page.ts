import { Component, OnInit } from '@angular/core';
import { PostService } from '../post.service';
import { NavController } from '@ionic/angular'
import { Router } from '@angular/router';
import { FormGroup, FormBuilder, Validators } from '@angular/forms';

@Component({
  selector: 'app-post',
  templateUrl: './post.page.html',
  styleUrls: ['./post.page.scss'],
})
export class PostPage implements OnInit {
  posts = {id:null , title:null, text:null, user_id:null, user_name:null }
  post;
  comments;
  public comentario: FormGroup;

  constructor(private fconstrutor: FormBuilder, public service: PostService, public navCtrl: NavController, private router: Router) { 
    this.post = this.router.getCurrentNavigation().extras
    this.comentario = this.fconstrutor.group({
      'text': ['',Validators.compose([
        Validators.maxLength(200)
      ])]
    });
  }

  getPost (id):void{
    // console.log(this.service + "Resgatando pessoas no Back")
    this.service.getPost(id).subscribe( (res) => { 
      this.posts = res;
      console.log(this.post); 
    });
  }

  fazComentario(form){
    this.service.fazComentario(form.value.text,this.post).subscribe(
      (res) => {
        console.log(res);
      }
    );
  }

  getComments(id){
    this.service.getComments(id).subscribe(
      (res) => {
        console.log(res);
        this.comments = res;
        for(let comment in this.comments){
          console.log(comment);
        }
      }
    );
  }


  ionViewDidEnterr() {
  }

  ngOnInit(){
        // console.log(id)
    this.getPost(this.post);

    this.getComments(this.post);
  }
}
