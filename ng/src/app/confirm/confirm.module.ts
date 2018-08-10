import {NgModule} from '@angular/core';
import {CommonModule} from '@angular/common';

import {ConfirmRoutingModule} from './confirm-routing.module';
import {ConfirmComponent} from './confirm.component';
import {SharedModule} from "../shared/shared.module";

@NgModule({
    imports: [
        CommonModule,
        SharedModule,
        ConfirmRoutingModule
    ],
    declarations: [ConfirmComponent]
})
export class ConfirmModule {
}
