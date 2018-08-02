import {Component} from '@angular/core';
import {FormControl, FormGroup, Validators} from "@angular/forms";
import {ClrLoadingState} from "@clr/angular";

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

    constructor() {
    }

    submit() {
        this.state = ClrLoadingState.LOADING;

        // login logic
        // this.state = ClrLoadingState.DEFAULT;
    }

    public validate(formGroup: FormGroup): boolean {
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
}
