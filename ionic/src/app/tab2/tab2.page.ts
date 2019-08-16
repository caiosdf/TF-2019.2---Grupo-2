import { Component, OnInit } from '@angular/core';
import { FormGroup, FormBuilder, Validators } from '@angular/forms';
import { AuthService } from '../services/auth.service';
import { NavController } from '@ionic/angular';


@Component({
  selector: 'app-tab2',
  templateUrl: 'tab2.page.html',
  styleUrls: ['tab2.page.scss']
})
export class Tab2Page {

  public cadastro: FormGroup;
  constructor(private fconstrutor: FormBuilder,public authService: AuthService, public navCtrl: NavController, ) {
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

  // Função chamada quando enviamos o form.
  enviarCadastro( form ){

    if(form.status=='VALID'){

      // Manda a requisição para a API
      this.authService.enviarCadastro( form.value.name, form.value.email, form.value.password ).subscribe(
        ( res ) => {
          console.log( res.message );
          localStorage.setItem( 'userToken', res.data.token);
          this.navCtrl.navigateRoot('tabs/home');
        }
      );
    }
  }

  ngOnInit() {
  }

}
