import { Component, OnInit } from '@angular/core';
import { routerTransition } from '../router.animations';
import { AuthService, User } from '../services/auth.service';
import {Donneur} from "../services/donneur.service";
import {Router} from "@angular/router";

@Component({
    selector: 'app-signup',
    templateUrl: './signup.component.html',
    styleUrls: ['./signup.component.scss'],
    animations: [routerTransition()]
})
export class SignupComponent implements OnInit {

    user = new User();
    dateNaissance:any;
    donneur=new Donneur();
    constructor( public authService: AuthService,
                 public router: Router,
       ) {}

    ngOnInit() {
        this.donneur.User=new User();
    }
    async register() {
        const date=new Date(this.dateNaissance);
        this.donneur.dateNaissance= date.getTime();
        const user = await this.authService.register(this.donneur);
        await this.router.navigate(['/login']);

    }
}
