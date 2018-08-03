import {NgModule} from '@angular/core';
import {CommonModule} from '@angular/common';

import {TaskRoutingModule} from './task-routing.module';
import {SharedModule} from "../shared/shared.module";
import { TaskIndexComponent } from './task-index/task-index.component';

@NgModule({
    imports: [
        CommonModule,
        SharedModule,
        TaskRoutingModule
    ],
    declarations: [TaskIndexComponent]
})
export class TaskModule {
}
