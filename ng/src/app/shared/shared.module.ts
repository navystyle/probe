import {NgModule} from '@angular/core';
import {CommonModule} from '@angular/common';
import {AwesomePipe} from "./awesome.pipe";
import {FormsModule, ReactiveFormsModule} from "@angular/forms";
import {ClarityModule, ClrFormsNextModule} from "@clr/angular";
import {ErrorComponent} from "./errors/error.component";

@NgModule({
    imports: [
        CommonModule,
        ClarityModule,
        FormsModule,
        ReactiveFormsModule,
    ],
    declarations: [
        AwesomePipe,
        ErrorComponent,
    ],
    exports: [
        CommonModule,
        AwesomePipe,
        FormsModule,
        ReactiveFormsModule,
        ClarityModule,
        ClrFormsNextModule,
        ErrorComponent,
    ]
})
export class SharedModule {
}
