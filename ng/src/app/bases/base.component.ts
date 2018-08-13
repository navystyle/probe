import {ErrorService} from "../core/services/error.service";
import {NgZone} from "@angular/core";

export abstract class BaseComponent {
    error = {};

    constructor(private _errorService?: ErrorService,
                private _ngZone?: NgZone) {

        this._errorService.error$.subscribe(
            err => {
                this._ngZone.run(() => {
                    this.error = err;
                });
            }
        );
    }
}