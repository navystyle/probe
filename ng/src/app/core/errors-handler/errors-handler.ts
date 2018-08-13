import {ErrorHandler, Injectable} from "@angular/core";
import {ErrorService} from "../services/error.service";

@Injectable()
export class ErrorsHandler implements ErrorHandler {

    constructor(private errorService: ErrorService) {
    }

    handleError(error: any): void {
        return this.errorService.set(error.error);
    }
}