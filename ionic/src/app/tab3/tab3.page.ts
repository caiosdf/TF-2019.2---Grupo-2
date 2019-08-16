import { Component } from '@angular/core';
import { Router } from '@angular/router';
import { authService } from '../services/auth.service'

@Component({
  selector: 'app-tab3',
  templateUrl: 'tab3.page.html',
  styleUrls: ['tab3.page.scss']
})
export class Tab3Page {

  constructor(private router: Router) {}

  alteraemail(){
    this.router.navigate(['/altera-email']);
  }
}
logout(){
  this.authService.deslogarUsuario().subscribe(
    (res) => {
      console.log( res.message );
      localStorage.removeItem( 'userToken' )
      localStorage.removeItem( 'userLogged' );
      this.router.navigate(['/tabs/home']);
    }
  )
}
