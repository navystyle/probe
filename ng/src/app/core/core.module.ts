import {NgModule} from '@angular/core';
import {CommonModule} from '@angular/common';
import {UserService} from "./services/user.service";
import {JwtService} from "./services/jwt.service";

@NgModule({
    imports: [
        CommonModule
    ],
    providers: [
        UserService,
        JwtService,
    ],
    declarations: []
})
export class CoreModule {
}
