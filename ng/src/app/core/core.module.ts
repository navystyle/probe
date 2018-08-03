import {NgModule} from '@angular/core';
import {CommonModule} from '@angular/common';
import {UserService} from "./services/user.service";
import {AuthService} from "./services/auth.service";
import {AuthGuardService} from "./services/auth-guard.service";
import {HTTP_INTERCEPTORS, HttpClientModule} from "@angular/common/http";
import {JwtModule} from "@auth0/angular-jwt";
import {JwtInterceptor} from "./interceptor/jwt.interceptor";

@NgModule({
    imports: [
        CommonModule,
        HttpClientModule,
        JwtModule.forRoot({
            config: {
                tokenGetter: tokenGetter,
            }
        })
    ],
    providers: [
        {
            provide: HTTP_INTERCEPTORS,
            useClass: JwtInterceptor,
            multi: true
        },
        UserService,
        AuthService,
        AuthGuardService,
    ],
    declarations: []
})
export class CoreModule {
}

export function tokenGetter() {
    return localStorage.getItem('token');
}