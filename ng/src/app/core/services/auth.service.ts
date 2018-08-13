import {Injectable} from '@angular/core';
import {JwtHelperService} from "@auth0/angular-jwt";
import {map} from "rxjs/internal/operators";
import {BaseService} from "./base.service";
import {Router} from "@angular/router";

@Injectable()
export class AuthService {

    apiUrl: string = '/auth';

    constructor(private jwtHelper: JwtHelperService,
                private baseService: BaseService,
                private router: Router) {
    }

    getToken(): string {
        return localStorage.getItem('token');
    }

    setToken(token: any) {
        localStorage.setItem('token', token);
    }

    isAuthenticated(): boolean {
        let token = localStorage.getItem('token');
        return !this.jwtHelper.isTokenExpired(token);
    }

    login(credentials: any) {
        return this.baseService.post(`${this.apiUrl}/login`, credentials)
            .pipe(map(data => {
                this.setToken(data.token)
            }));
    }

    confirm(confirmCode: string) {
        return this.baseService.post(`${this.apiUrl}/confirm`, {confirmCode: confirmCode})
            .pipe(map(data => data.data));
    }

    logout() {
        localStorage.removeItem('token');
        this.router.navigate(['login']);
    }
}
