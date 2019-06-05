import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { routerTransition } from '../router.animations';
import { AuthService, User } from '../services/auth.service';


@Component({
    selector: 'app-login',
    templateUrl: './login.component.html',
    styleUrls: ['./login.component.scss'],
    animations: [routerTransition()]
})
export class LoginComponent implements OnInit {
    user = new User();
    constructor(
      public router: Router,
      public authService: AuthService
    ) {}

    ngOnInit() {
    }
    async login() {
        // console.log(this.user);
        const user = await this.authService.login(this.user);
        if (user) {
            localStorage.setItem('token', user.apiToken);
           //this.router.navigate('/dashboard');
           // this.router.navigateByUrl('/login');
            await this.router.navigate(['/dashboard']);
        }

    }
    /*onLoggedin() {
        //localStorage.setItem('isLoggedin', 'true');
    }*/
}
