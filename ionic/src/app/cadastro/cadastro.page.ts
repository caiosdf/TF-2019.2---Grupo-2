import { Component, OnInit } from '@angular/core';
import { FormGroup, FormBuilder, Validators } from '@angular/forms';

@Component({
  selector: 'app-cadastro',
  templateUrl: './cadastro.page.html',
  styleUrls: ['./cadastro.page.scss'],
})
export class CadastroPage implements OnInit {
  public cadastro: FormGroup;

  constructor(private fconstrutor: FormBuilder) {
    this.cadastro = this.fconstrutor.group({
      'nome': ['',Validators.compose([
        Validators.required,
        Validators.minLength(5),
        Validators.maxLength(10)
      ])],
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

  enviarCadastro(){
    console.log(this.cadastro.value);
  }
 
  ngOnInit() {
  }

}
