import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import {TaskIndexComponent} from "./task-index/task-index.component";

const routes: Routes = [
    {
        path: '',
        component: TaskIndexComponent
    }
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule]
})
export class TaskRoutingModule { }
