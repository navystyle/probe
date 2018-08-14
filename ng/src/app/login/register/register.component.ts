import {Component, EventEmitter, Output, ViewChild} from '@angular/core';
import {ClrWizard} from "@clr/angular";
import {equalValidator} from "../../shared/validators/equal-validator";
import {FormControl, FormGroup, Validators} from "@angular/forms";
import {AuthService} from "../../core/services/auth.service";

@Component({
    selector: 'register-wizard',
    templateUrl: './register.component.html'
})
export class RegisterComponent {

    @ViewChild("wizard") wizard: ClrWizard;
    @Output() closed: EventEmitter<boolean> = new EventEmitter<boolean>();

    formGroup = new FormGroup({
        email: new FormControl('', [Validators.required, Validators.email]),
        name: new FormControl('', [
            Validators.required,
            Validators.pattern('^[a-z0-9]+'),
            Validators.minLength(4),
            Validators.maxLength(20),
        ]),
        password: new FormControl('', [Validators.required, Validators.minLength(4)]),
        password_confirm: new FormControl('', [Validators.required, equalValidator('password')]),
        agree: new FormControl('', Validators.requiredTrue),
    });

    untouched: boolean = true;
    loading: boolean = false;
    errorWizard: {};

    get isFinish(): boolean {
        return !this.untouched && !this.loading;
    }

    get isFirst(): boolean {
        return this.wizard.isFirst;
    }

    constructor(private authService: AuthService) {
    }

    submit() {
        if (this.untouched) {
            this.beforeSubmit();

            this.authService.register(this.formGroup.getRawValue())
                .subscribe(
                    () => {
                        this.untouched = false;
                        this.loading = false;
                    },
                    err => {
                        this.errorWizard = err.error;
                        this.loading = false;
                    }
                );
        } else {
            this.wizard.forceFinish();
            this.resetWizard();
        }
    }

    beforeSubmit() {
        this.errorWizard = {};
        this.loading = true;
    }

    resetWizard() {
        this.untouched = true;
        this.errorWizard = {};
        this.formGroup.reset();
        this.wizard.reset();
        this.closed.emit(true)
    }

    cancel() {
        if (!this.isFinish) {
            if (confirm("창을 닫으시겠습니까? 입력된 정보가 초기화 됩니다.")) {
                this.wizard.close();
                this.resetWizard();
            } else {
                return false;
            }
        }

        this.wizard.close();
        this.resetWizard();
    }

    previous() {
        this.errorWizard = {};
    }

    invalid(control: FormControl): boolean {
        return control.invalid && (control.dirty || control.touched)
    }

    open() {
        this.wizard.open();
    }
}
