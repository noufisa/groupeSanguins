import {Injectable} from '@angular/core';
import {ApiService} from './api.service';
import {Donneur} from "./donneur.service";

@Injectable({
    providedIn: 'root'
})
export class AuthService {

    constructor(private apiService: ApiService) {
    }

    async login(user: User) {
        return await this.apiService.call('login', 'post', user).toPromise();

    }

    async register(donneur: Donneur): Promise<boolean> {

        return await this.apiService.call('register', 'post', donneur).toPromise();

    }
}

export class User {
    id: number;
    email: string;
    password: string;
    firstName: string;
    lastName: string;
    apiToken: string;

    constructor() {
        this.id = 0;
    }
}
