import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';
import { HttpClient } from '@angular/common/http';

@Injectable({
  providedIn: 'root'
})
export class AuthService {


    // A URL da API
    apiUrl: string = "http://localhost:8000/api/";
  
    // As headers da requisição
    httpHeaders: any = {
      headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json'
      }
    }

    constructor( public http: HttpClient ) { }

    //logar usuário
    logarUsuario( email,senha ): Observable<any> {
      return this.http.post( this.apiUrl + 'login', {
        'email' : email,
        'password' : senha
      }, this.httpHeaders );
    }

    enviarCadastro( nome,email,senha ): Observable<any> {
      return this.http.post( this.apiUrl + 'cadastro', {
        'name': nome, 
        'email': email, 
        'password': senha
      }, this.httpHeaders);
    }

    usuarioLogado(): Observable<any> {
      this.httpHeaders.headers["Authorization"] = 'Bearer ' + localStorage.getItem('userToken');
      return this.http.get( this.apiUrl + 'get-details', this.httpHeaders);
    }

    deslogarUsuario(): Observable<any> {
      this.httpHeaders.headers["Authorization"] = 'Bearer' + localStorage.getItem('userToken');
      return this.http.get( this.apiUrl + 'logout', this.httpHeaders);
    }
    
    updateEmail(user ,email): Observable<any>{
      return this.http.put (this.apiUrl + 'atualizaEmail/'+email,{
        'email': email
      }, this.httpHeaders);
    }
}
