import {Component, NgZone, OnInit, ViewChild} from '@angular/core';
import {FormControl, FormGroup, Validators} from "@angular/forms";
import {ClrLoadingState} from "@clr/angular";
import {AuthService} from "../core/services/auth.service";
import {ActivatedRoute, Router} from "@angular/router";
import {ErrorService} from "../core/services/error.service";
import {BaseComponent} from "../bases/base.component";
import {RegisterComponent} from "./register/register.component";

@Component({
    selector: 'app-login',
    templateUrl: './login.component.html',
})
export class LoginComponent extends BaseComponent implements OnInit {

    formGroup = new FormGroup({
        email: new FormControl('', Validators.required),
        password: new FormControl('', Validators.required),
    });

    state: ClrLoadingState = ClrLoadingState.DEFAULT;
    returnUrl: string;
    initWizard: boolean = false;

    @ViewChild('registerWizard') registerWizard: RegisterComponent;

    constructor(private route: ActivatedRoute,
                private router: Router,
                private errorService: ErrorService,
                private ngZone: NgZone,
                private authService: AuthService,
                ) {
        super(errorService, ngZone);
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

        // todo: 로그인이 안됨 ㅡㅡ
        // todo: 집에서할때 probe.schema.xml 싱크시킬 것.
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

    openWizard() {
        this.initWizard = true;
        setTimeout(() => this.registerWizard.open());
    }
}
