import {Component, Input} from '@angular/core';
import {Error} from "../../core/models/error";

@Component({
    selector: 'shared-error',
    templateUrl: './error.component.html'
})
export class ErrorComponent {

    formattedErrors: Array<string> = [];
    _type: string;

    @Input() small: boolean = false;
    @Input()
    set type(type: string) {
        if (type in alertTypes) {
            this._type = alertTypes[type];
        }
    }

    get type() {
        if (!this._type) {
            return alertTypes.danger;
        }

        return this._type;
    }

    @Input()
    set error(error: Error) {
        this.formattedErrors = Object.keys(error.error || {})
            .map(key => key === 'status' ? `[${error.error[key]}]` : `${error.error[key]}`);
    }

    get errorList() {
        return this.formattedErrors;
    }
}

export enum alertTypes {
    danger = 'alert-danger',
    warning = 'alert-warning',
}