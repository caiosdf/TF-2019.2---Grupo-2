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

  public getPost(id):Observable<any> {
    return this.http.get(
        this.backendURL + 'post/' + id);
}

  public sendPost( titulo, texto, foto ):Observable<any> {
    this.httpHeaders.headers["Authorization"] = 'Bearer ' + localStorage.getItem('userToken');
    console.log( this.httpHeaders.headers );
    return this.http.post( this.backendURL + 'criaPost', {
      'title': titulo,
      'text': texto,
      'photo': foto
    }, this.httpHeaders);
  }


}
