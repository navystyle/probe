import {AfterViewInit, Component, NgZone} from '@angular/core';
import {ActivatedRoute, Router} from "@angular/router";
import {ErrorService} from "../core/services/error.service";
import {AuthService} from "../core/services/auth.service";
import {BaseComponent} from "../bases/base.component";
import {ClrLoadingState} from "@clr/angular";
import {User} from "../core/models/user";

@Component({
    selector: 'app-confirm',
    templateUrl: './confirm.component.html'
})
export class ConfirmComponent extends BaseComponent {

    success: boolean = false;
    state: ClrLoadingState = ClrLoadingState.DEFAULT;
    user: User;

    constructor(private route: ActivatedRoute,
                private router: Router,
                private errorService: ErrorService,
                private ngZone: NgZone,
                private authService: AuthService,) {
        super(errorService, ngZone);
    }

    submit() {
        this.state = ClrLoadingState.LOADING;
        this.error = {};

        let confirmCode = this.route.snapshot.params['confirm_code'];

        this.authService.confirm(confirmCode)
            .subscribe(
                res => this.afterSuccess(res),
                err => {
                    this.state = ClrLoadingState.DEFAULT;
                    throw err;
                }
            );
    }

    afterSuccess(res: any) {
        this.user = res;
        this.success = true;
        this.state = ClrLoadingState.SUCCESS;
    }
}
