import {Injectable} from '@angular/core';
import {JwtHelperService} from "@auth0/angular-jwt";
import {HttpClient} from "@angular/common/http";
import {environment} from "../../../environments/environment";
import {map} from "rxjs/internal/operators";

@Injectable()
export class AuthService {

    apiUrl: string = `${environment.apiUrl}/auth`;

    constructor(private jwtHelper: JwtHelperService,
                private http: HttpClient) {
    }

    getToken(): string {
        return localStorage.getItem('token');
    }

    setToken(token: any) {
        localStorage.setItem('token', token);
    }

    isAuthenticated(): boolean {
        let token = localStorage.getItem('token');

        // Check whether the token is expired and return
        // true or false
        return !this.jwtHelper.isTokenExpired(token);
    }

    login(body: Object = {}) {
        return this.http.post(`${this.apiUrl}/login`, JSON.stringify(body))
            .pipe(map(data => {
                this.setToken(data)
            }))
    }
}
