import {Component, NgZone} from '@angular/core';
import {BaseComponent} from "../bases/base.component";
import {ErrorService} from "../core/services/error.service";
import {ActivatedRoute, Router} from "@angular/router";
import {AuthService} from "../core/services/auth.service";
import {FormControl, FormGroup, Validators} from "@angular/forms";
import {ClrLoadingState} from "@clr/angular";
import {equalValidator} from "../shared/validators/equal-validator";

@Component({
    selector: 'app-register',
    templateUrl: './register.component.html'
})
export class RegisterComponent extends BaseComponent {

    formGroup = new FormGroup({
        email: new FormControl('', [Validators.required, Validators.email]),
        name: new FormControl('', [
            Validators.required,
            Validators.pattern('[a-zA-Z]'),
            Validators.minLength(4),
            Validators.maxLength(20),
        ]),
        password: new FormControl('', [Validators.required, Validators.minLength(4)]),
        password_confirm: new FormControl('', [Validators.required, equalValidator('password')]),

        // todo: password confirm match validator create
        // https://www.code-sample.com/2017/09/angular-4-form-password-match-validator.html
    });

    state: ClrLoadingState = ClrLoadingState.DEFAULT;

    constructor(private route: ActivatedRoute,
                private router: Router,
                private errorService: ErrorService,
                private ngZone: NgZone,
                private authService: AuthService,
    ) {
        super(errorService, ngZone);
    }

}
