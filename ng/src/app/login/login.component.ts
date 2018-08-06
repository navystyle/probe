import {Component} from '@angular/core';
import {FormControl, FormControlName, FormGroup, Validators} from "@angular/forms";
import {ClrLoadingState} from "@clr/angular";
import {AuthService} from "../core/services/auth.service";

@Component({
    selector: 'app-login',
    templateUrl: './login.component.html',
})
export class LoginComponent {

    formGroup = new FormGroup({
        email: new FormControl('', Validators.required),
        password: new FormControl('', Validators.required),
    });

    state: ClrLoadingState = ClrLoadingState.DEFAULT;
    error = {};

    constructor(private authService: AuthService) {
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
        console.log(res);
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

    // todo: 로그인성공 후 리다이렉트
    // https://gnomeontherun.com/2017/03/02/guards-and-login-redirects-in-angular/
}
