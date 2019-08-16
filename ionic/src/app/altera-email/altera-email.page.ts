import { Component, OnInit } from '@angular/core';
import { AuthService } from '../services/auth.service';

@Component({
  selector: 'app-altera-email',
  templateUrl: './altera-email.page.html',
  styleUrls: ['./altera-email.page.scss'],
})
export class AlteraEmailPage implements OnInit {

  user;
  form = {}
  

  constructor(public AuthService: AuthService) { }

  ngOnInit() {
  }

  onSubmit(){ 
    console.log(this.form);  
    this.AuthService.updateEmail(this.form, this.user.email).subscribe((res)=>{console.log(res);});
  }
}
