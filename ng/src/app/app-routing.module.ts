import {NgModule} from '@angular/core';
import {Routes, RouterModule} from '@angular/router';
import {AuthGuardService as AuthGuard} from "./core/services/auth-guard.service";
import {AppComponent} from "./app.component";
import {PageNotFoundComponent} from "./page-not-found/page-not-found.component";

const rootPath: string = 'src/app';
const routes: Routes = [
    { pathMatch: 'full', path: '', component: AppComponent, canActivate: [AuthGuard] },
    { pathMatch: 'full', path: 'login', loadChildren: `${rootPath}/login/login.module#LoginModule` },
    { pathMatch: 'full', path: 'task', canActivate: [AuthGuard], loadChildren: `${rootPath}/task/task.module#TaskModule` },
    { pathMatch: 'full', path: '**', component: PageNotFoundComponent }
];

@NgModule({
    imports: [RouterModule.forRoot(routes)],
    exports: [RouterModule]
})
export class AppRoutingModule {
}
