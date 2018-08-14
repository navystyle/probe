import {FormControl, ValidatorFn, ValidationErrors} from '@angular/forms';

export function equalValidator(fieldName: string): ValidatorFn {
    let fcfirst: FormControl;
    let fcSecond: FormControl;

    return function equalValidator(control: FormControl): ValidationErrors {

        if (!control.parent) {
            return null;
        }

        // INITIALIZING THE VALIDATOR.
        if (!fcfirst) {
            //INITIALIZING FormControl first
            fcfirst = control;
            fcSecond = control.parent.get(fieldName) as FormControl;

            //FormControl Second
            if (!fcSecond) {
                throw new Error('equalValidator(): Second control is not found in the parent group!');
            }

            fcSecond.valueChanges.subscribe(() => {
                fcfirst.updateValueAndValidity();
            });
        }

        if (!fcSecond) {
            return null;
        }

        if (fcSecond.value !== fcfirst.value) {
            return {
                misMatch: true
            };
        }

        return null;
    }
}