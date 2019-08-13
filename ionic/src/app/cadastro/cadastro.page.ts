import { Component, OnInit } from '@angular/core';
import { FormGroup, FormBuilder, Validators } from '@angular/forms';
import { AuthService } from '../services/auth.service';



@Component({
  selector: 'app-cadastro',
  templateUrl: './cadastro.page.html',
  styleUrls: ['./cadastro.page.scss'],
})
export class CadastroPage implements OnInit {
  public cadastro: FormGroup;

  constructor(private fconstrutor: FormBuilder,public authService: AuthService ) {
    //valida os campos do form antes de enviar para o back.
    this.cadastro = this.fconstrutor.group({
      'name': ['',Validators.compose([
        Validators.required,
        Validators.maxLength(50)
      ])],
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

  // Passa para a service os campos do cadastro.
  enviarCadastro( form ){

    if(form.status=='VALID'){
      this.authService.enviarCadastro( form.value.name, form.value.email, form.value.password ).subscribe(
        ( res ) => {
          console.log( res.message );
          localStorage.setItem( 'userToken', res.data.token);
        }
      );
    }
  }
 
  ngOnInit() {
  }

}
