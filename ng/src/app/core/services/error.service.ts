import {Injectable} from '@angular/core';
import {Subject} from "rxjs/index";
import {Error} from "../models/error";

@Injectable()
export class ErrorService {

    private _error = new Subject<Error>();
    readonly error$ = this._error.asObservable();

    constructor() {
    }

    set(error: Error) {
        this._error.next(error);
        // setTimeout(() => this._error.next(null), 3000);
    }
}
