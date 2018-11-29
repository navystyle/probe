import {Component, OnInit} from '@angular/core';
import {AuthService} from "./core/services/auth.service";
import {ActivatedRouteSnapshot, NavigationEnd, Router} from "@angular/router";

@Component({
    selector: 'app-root',
    templateUrl: './app.component.html'
})
export class AppComponent implements OnInit {
    title = 'probe';
    collapsed: string = 'collapsed';
    taskBar: boolean = false;

    constructor(private authService: AuthService,
                private router: Router) {
    }

    ngOnInit(): void {
        this.router.events.subscribe((event) => {
            if (event instanceof NavigationEnd) {
                let getSnapshotData = (routeSnapshot: ActivatedRouteSnapshot) => {
                    let data = routeSnapshot.data ? routeSnapshot.data['taskBar'] : false;
                    if (routeSnapshot.firstChild) {
                        data = getSnapshotData(routeSnapshot.firstChild) || data;
                    }
                    return data;
                };

                this.taskBar = getSnapshotData(this.router.routerState.snapshot.root);
            }
        })
    }

    isAuthenticated() {
        return this.authService.isAuthenticated();
    }
}
