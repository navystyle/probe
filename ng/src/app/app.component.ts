import {Component, OnInit} from '@angular/core';
import {AuthService} from "./core/services/auth.service";

@Component({
    selector: 'app-root',
    templateUrl: './app.component.html'
})
export class AppComponent implements OnInit {
    title = 'probe';

    constructor(private authService: AuthService) {
    }

    ngOnInit(): void {
    }

    isAuthenticated() {
        return this.authService.isAuthenticated();
    }
}
