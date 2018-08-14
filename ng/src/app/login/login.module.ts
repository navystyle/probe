import {NgModule} from '@angular/core';
import {CommonModule} from '@angular/common';

import {LoginRoutingModule} from './login-routing.module';
import {LoginComponent} from './login.component';
import {SharedModule} from "../shared/shared.module";
import { RegisterComponent } from './register/register.component';

@NgModule({
    imports: [
        CommonModule,
        SharedModule,
        LoginRoutingModule,
    ],
    declarations: [LoginComponent, RegisterComponent]
})
export class LoginModule {
}
