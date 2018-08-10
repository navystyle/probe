import {Component, NgZone, OnInit} from '@angular/core';
import {FormControl, FormControlName, FormGroup, Validators} from "@angular/forms";
import {ClrLoadingState} from "@clr/angular";
import {AuthService} from "../core/services/auth.service";
import {ActivatedRoute, Router} from "@angular/router";
import {ErrorService} from "../core/services/error.service";

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
                private router: Router,
                private errorService: ErrorService,
                private _ngZone: NgZone) {

        /*this.errorService.error$.subscribe(
            err => {
                console.log(err);
                this.error = err;
            }
        );*/

        this.errorService.error$.subscribe(
            err => {
                this._ngZone.run(() => {
                    this.error = err;
                });
            }
        );

        // todo: ngZone 대체할 방법 찾아보기
        // todo: base component extend 시키기 (에러, 라우터 등)
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
                err => {
                    this.state = ClrLoadingState.DEFAULT;
                    throw err;
                }
            );
    }

    afterSuccess(res: any) {
        this.router.navigate([this.returnUrl]);
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
