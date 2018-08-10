import {ErrorHandler, NgModule} from '@angular/core';
import {CommonModule} from '@angular/common';
import {UserService} from "./services/user.service";
import {AuthService} from "./services/auth.service";
import {AuthGuardService} from "./services/auth-guard.service";
import {HTTP_INTERCEPTORS, HttpClientModule} from "@angular/common/http";
import {JwtModule} from "@auth0/angular-jwt";
import {JwtInterceptor} from "./interceptor/jwt.interceptor";
import {ErrorService} from "./services/error.service";
import {ErrorsHandler} from "./errors-handler/errors-handler";

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
        {
            provide: ErrorHandler,
            useClass: ErrorsHandler,
        },
        ErrorService,
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