import {NgModule} from '@angular/core';
import {
    MatButtonModule, MatCardModule, MatCheckboxModule, MatGridListModule, MatIconModule, MatListModule, MatMenuModule,
    MatSidenavModule,
    MatToolbarModule
} from "@angular/material";

@NgModule({
    imports: [
        MatToolbarModule,
        MatButtonModule,
        MatSidenavModule,
        MatIconModule,
        MatListModule,
        MatGridListModule,
        MatCardModule,
        MatMenuModule,
        MatCheckboxModule,
    ],
    exports: [
        MatToolbarModule,
        MatButtonModule,
        MatSidenavModule,
        MatIconModule,
        MatListModule,
        MatGridListModule,
        MatCardModule,
        MatMenuModule,
        MatCheckboxModule,
    ],
})
export class MaterialModule {}
