import {NgModule} from '@angular/core';
import {CommonModule} from '@angular/common';
import {AwesomePipe} from "./awesome.pipe";
import {FormsModule, ReactiveFormsModule} from "@angular/forms";
import {HttpClientModule} from "@angular/common/http";
import {ClarityModule, ClrFormsNextModule} from "@clr/angular";

@NgModule({
    imports: [
        CommonModule,
        FormsModule,
        ReactiveFormsModule,
        HttpClientModule
    ],
    declarations: [
        AwesomePipe
    ],
    exports: [
        CommonModule,
        AwesomePipe,
        FormsModule,
        ReactiveFormsModule,
        HttpClientModule,
        ClarityModule,
        ClrFormsNextModule,
    ]
})
export class SharedModule {
}
