import { Component, OnInit } from '@angular/core';
import { FormGroup, FormBuilder, Validators } from '@angular/forms';
import { AuthService } from '../services/auth.service';

@Component({
  selector: 'app-login',
  templateUrl: './login.page.html',
  styleUrls: ['./login.page.scss'],
})
export class LoginPage implements OnInit {

  public login: FormGroup;

  constructor(private fconstrutor: FormBuilder, public authService: AuthService) { 
    this.login = this.fconstrutor.group({
      'email': ['',Validators.compose([
        Validators.required,
        Validators.maxLength(50)
      ])],
      'password': ['', Validators.compose([
        Validators.required,
        Validators.maxLength(50)
      ])]
    });
  }

  logarUsuario( form ){

    //if(form.status=='VALID'){
      this.authService.logarUsuario( form.value.email, form.value.password ).subscribe(
        ( res ) => {
          console.log( res.message );
          localStorage.setItem('userToken', res.data.token);
        }
      );
   // }
  }

  ngOnInit() {
  }

}
