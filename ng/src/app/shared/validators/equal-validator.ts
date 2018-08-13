import {FormControl, ValidatorFn, AbstractControl} from '@angular/forms';

export function equalValidator(fieldName: string) {
    let fcfirst: FormControl;
    let fcSecond: FormControl;

    return function equalValidator(control: FormControl): ValidatorFn {

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
            return (control: AbstractControl): { [key: string]: boolean } => {
                return {
                    misMatch: true
                };
            }
        }

        return null;
    }
}