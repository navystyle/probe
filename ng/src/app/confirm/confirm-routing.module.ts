import {NgModule} from '@angular/core';
import {Routes, RouterModule} from '@angular/router';
import {ConfirmComponent} from "./confirm.component";

const routes: Routes = [
    {
        path: ':confirm_code',
        component: ConfirmComponent
    }
];

@NgModule({
    imports: [RouterModule.forChild(routes)],
    exports: [RouterModule]
})
export class ConfirmRoutingModule {
}
