import {Component, OnInit} from '@angular/core';
import {AuthService} from "./core/services/auth.service";

@Component({
    selector: 'app-root',
    templateUrl: './app.component.html'
})
export class AppComponent implements OnInit {
    title = 'probe';
    user: boolean = false;

    constructor(private authService: AuthService) {
    }

    ngOnInit(): void {
        if (this.authService.isAuthenticated()) {
            this.user = true;
        }
    }
}
