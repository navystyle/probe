import {NgModule} from '@angular/core';
import {CommonModule} from '@angular/common';
import {HeaderComponent} from './header/header.component';
import {ClarityModule, ClrFormsNextModule} from "@clr/angular";

@NgModule({
    imports: [
        CommonModule,
        ClarityModule,
        ClrFormsNextModule,
    ],
    exports: [
        HeaderComponent,
    ],
    declarations: [
        HeaderComponent,
    ]
})
export class LayoutModule {
}
