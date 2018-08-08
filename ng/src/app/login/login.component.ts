import {Component, OnInit} from '@angular/core';
import {FormControl, FormControlName, FormGroup, Validators} from "@angular/forms";
import {ClrLoadingState} from "@clr/angular";
import {AuthService} from "../core/services/auth.service";
import {ActivatedRoute, Router} from "@angular/router";

@Component({
    selector: 'app-login',
    templateUrl: './login.component.html',
})
export class LoginComponent implements OnInit {

    formGroup = new FormGroup({
        email: new FormControl('', Validators.required),
        password: new FormControl('', Validators.required),
    });

    state: ClrLoadingState = ClrLoadingState.DEFAULT;
    error = {};
    returnUrl: string;

    constructor(private authService: AuthService,
                private route: ActivatedRoute,
                private router: Router) {
    }

    ngOnInit() {
        this.authService.logout();
        this.returnUrl = this.route.snapshot.queryParams['returnUrl'] || '/';
    }

    submit() {
        this.state = ClrLoadingState.LOADING;
        this.error = {};

        this.authService.login(this.formGroup.getRawValue())
            .subscribe(
                res => this.afterSuccess(res),
                err => this.afterError(err)
            );

        // login logic
        // this.state = ClrLoadingState.DEFAULT;
    }

    afterSuccess(res: any) {
        this.router.navigate([this.returnUrl]);
    }

    afterError(err: Error) {
        this.state = ClrLoadingState.DEFAULT;
        this.error = err;
    }

    // 안쓰고있음
    validate(formGroup: FormGroup): boolean {
        for (let property in formGroup.controls) {
            if (formGroup.controls.hasOwnProperty(property)) {
                let control = formGroup.controls[property];

                if (control.hasOwnProperty('controls')) {
                    this.validate(control as FormGroup);
                }
            }
        }

        return formGroup.valid;
    }

    invalid(control: FormControl): boolean {
        return control.invalid && (control.dirty || control.touched)
    }
}
