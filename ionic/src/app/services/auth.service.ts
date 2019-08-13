import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';
import { HttpClient } from '@angular/common/http';


@Injectable({
  providedIn: 'root'
})
export class AuthService {

  constructor(public http: HttpClient) { }

  // A URL da API.
  apiUrl: string = "http://localhost:8000/api/";

  // As headers da requisição.
  httpHeaders: any = {
    'Content-Type': 'application/json',
    'Accept': 'application/json'      
  }

  //envia os dados referentes ao cadastro para o back.
  enviarCadastro( nome,email,senha ): Observable<any> {
    return this.http.post( this.apiUrl + 'cadastro', {'name': nome, 'email': email, 'password': senha}, this.httpHeaders);
  }
}
