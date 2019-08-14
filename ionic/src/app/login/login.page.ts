import { Component, OnInit } from '@angular/core';
import { FormGroup, FormBuilder, Validators } from '@angular/forms';
import { Router } from '@angular/router';

@Component({
  selector: 'app-login',
  templateUrl: './login.page.html',
  styleUrls: ['./login.page.scss'],
})
export class LoginPage implements OnInit {

  public login: FormGroup;

  constructor(private fconstrutor: FormBuilder, private router: Router) { 
    this.login = this.fconstrutor.group({
      'email': ['',Validators.compose([
        Validators.required,
        Validators.minLength(5),
        Validators.maxLength(10)
      ])],
      'senha': ['', Validators.compose([
        Validators.required,
        Validators.minLength(6)
      ])]
    });
  }

  validarLogin(){
    console.log(this.login.getRawValue());
  }

  redefinirSenha(){
    this.router.navigate(['redefinir-senha']);
  }

  ngOnInit() {
  }

}
