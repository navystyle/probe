import {Injectable} from '@angular/core';
import {BaseService} from "./base.service";
import {environment} from "../../../environments/environment";

@Injectable()
export class UserService extends BaseService {

    apiUrl: string = `${environment.apiUrl}/users`;
}
