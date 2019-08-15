import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class PostService {

  backendURL: string = 'http://localhost:8000/api/';

  httpHeaders: any = {
    headers: {
      'Content-Type': 'application/json',
      'Accept': 'application/json'
    }
  }


  constructor(private http: HttpClient) { }

  public getPosts():Observable<any>{
    return this.http.get(this.backendURL + 'posts');
  }

  public sendPost( titulo, texto ):Observable<any> {
    return this.http.post( this.backendURL + 'criaPost', {
      'title': titulo,
      'text': texto
    }, this.httpHeaders);
  }

}
