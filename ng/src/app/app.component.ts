import {Component, OnInit} from '@angular/core';
import {AuthService} from "./core/services/auth.service";

@Component({
    selector: 'app-root',
    templateUrl: './app.component.html'
})
export class AppComponent implements OnInit {
    title = 'probe';
    collapsed: string;
    tests: any = [];

    constructor(private authService: AuthService) {
    }

    ngOnInit(): void {
        this.collapsed = 'collapsed';
        for (let i = 1; i<32; i++) {
            this.tests.push(i);
        }
    }

    isAuthenticated() {
        return this.authService.isAuthenticated();
    }
}
