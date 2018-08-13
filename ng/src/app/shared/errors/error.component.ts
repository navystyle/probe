import {Component, Input} from '@angular/core';
import {Error} from "../../core/models/error";

@Component({
    selector: 'error',
    templateUrl: './error.component.html'
})
export class ErrorComponent {

    formattedErrors: Array<string> = [];
    opened: boolean = false;
    _alert: string;
    _type: string;

    @Input() small: boolean = false;
    @Input()
    set type(type: string) {
        if (type in Types) {
            this._type = Types[type];
        }
    }

    get type() {
        if (!this._type) {
            return Types.alert;
        }

        return this._type;
    }

    @Input()
    set alert(alert: string) {
        if (alert in alertTypes) {
            this._alert = alertTypes[alert];
        }
    }

    get alert() {
        if (!this._alert) {
            return alertTypes.danger;
        }

        return this._alert;
    }

    @Input()
    set error(error: Error) {
        this.formattedErrors = Object.keys(error || {})
            .map(key => key === 'status' ? `[${error[key]}]` : `${error[key]}`);

        if (this.type === Types.modal) {
            this.opened = true;
        }
    }

    get errorList() {
        return this.formattedErrors;
    }

    readonly TYPES_MODAL = Types.modal;
    readonly TYPES_ALERT = Types.alert;
}

export enum Types {
    modal = 'modal',
    alert = 'alert',
}

export enum alertTypes {
    danger = 'alert-danger',
    warning = 'alert-warning',
}