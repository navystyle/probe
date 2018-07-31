import {RouterModule, Routes} from "@angular/router";
import {NgModule} from "@angular/core";
import {FirstPageComponent} from "./first-page/first-page.component";
import {DashboardComponent} from "./dashboard/dashboard.component";

const routes: Routes = [
    { path: 'dashboard', component: DashboardComponent },
    { path: 'first-page', component: FirstPageComponent },
];

@NgModule({
    imports: [RouterModule.forRoot(routes)],
    exports: [RouterModule]
})
export class AppRoutingModule { }