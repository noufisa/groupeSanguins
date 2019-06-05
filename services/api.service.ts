import { Injectable } from '@angular/core';
import {HttpClient} from '@angular/common/http';
import {Router} from '@angular/router';
import {Observable, throwError} from 'rxjs';
import {environment} from '../../environments/environment';
import {catchError, map} from 'rxjs/operators';
@Injectable({
  providedIn: 'root'
})
export class ApiService {

  constructor(private http: HttpClient, private router: Router) {
  }

  public call(url: string, method: string = 'get', body: any = null): Observable<any> {
    const options: any = {
      headers: [],
    };
    // console.log(body);
    if (body != null) {
      options.body = body;
    }
    const token = localStorage.getItem('token');
    if (token) {
      options.headers['X-AUTH-TOKEN'] = token;

    }

    return this.http.request(method, environment.API + url, options)
      .pipe(map((data: any) => (data.data || data)),
        catchError(this.handleError));
  }

  private handleError(error: any) {
    // console.log(error);
    if (error.status === 403 || error.status === 401) {
      this.router.navigate(['/login']);
    }
    return throwError(error.error.message);
  }
}
