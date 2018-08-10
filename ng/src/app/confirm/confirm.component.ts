import {AfterViewInit, Component} from '@angular/core';
import {ActivatedRoute} from "@angular/router";

@Component({
    selector: 'app-confirm',
    templateUrl: './confirm.component.html'
})
export class ConfirmComponent implements AfterViewInit {

    error = {};

    constructor(private route: ActivatedRoute) {
    }

    ngAfterViewInit() {
        let confirmCode = this.route.snapshot.params['confirm_code'];
        confirmCode = '';

        if (!confirmCode) {
            this.error = {
                error: {
                    status: 500,
                    message: '승인코드가 존재하지 않습니다.'
                }
            };
        }
    }
}
