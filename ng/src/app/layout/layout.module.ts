import {NgModule} from '@angular/core';
import {CommonModule} from '@angular/common';
import {HeaderComponent} from './header/header.component';
import {SidebarComponent} from './sidebar/sidebar.component';
import {ClarityModule, ClrFormsNextModule} from "@clr/angular";

@NgModule({
    imports: [
        CommonModule,
        ClarityModule,
        ClrFormsNextModule,
    ],
    exports: [
        HeaderComponent, SidebarComponent
    ],
    declarations: [HeaderComponent, SidebarComponent]
})
export class LayoutModule {
}
