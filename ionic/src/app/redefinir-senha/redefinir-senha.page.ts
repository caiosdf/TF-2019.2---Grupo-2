import { Component, OnInit } from '@angular/core';
import { FormGroup, FormBuilder, Validators } from '@angular/forms';
import { Router } from '@angular/router';

@Component({
  selector: 'app-redefinir-senha',
  templateUrl: './redefinir-senha.page.html',
  styleUrls: ['./redefinir-senha.page.scss'],
})
export class RedefinirSenhaPage implements OnInit {

  public redefinir: FormGroup;

  constructor(private fconstrutor: FormBuilder,private router: Router) { 
    this.redefinir = this.fconstrutor.group({
      'email': ['',Validators.compose([
        Validators.required,
        Validators.minLength(5),
      ])]
    });
  }

  redefinirSenha(){
    console.log(this.redefinir.value);
  }

  voltar(){
    this.router.navigate(['login']);
  }


  ngOnInit() {
  }

}
