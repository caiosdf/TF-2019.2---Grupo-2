import { Component } from '@angular/core';
import { Router } from '@angular/router';
import { AuthService } from '../services/auth.service';

@Component({
  selector: 'app-tab3',
  templateUrl: 'tab3.page.html',
  styleUrls: ['tab3.page.scss']
})
export class Tab3Page {

  constructor(private router: Router, public AuthService: AuthService) {}

  alteraemail(){
    this.router.navigate(['/altera-email']);
  }
  logout(){
    this.AuthService.deslogarUsuario().subscribe(
      (res) => {
        console.log( res.message );
        localStorage.removeItem( 'userToken' )
        localStorage.removeItem( 'userLogged' );
        this.router.navigate(['/tabs/home']);
      }
    )
  }
}

