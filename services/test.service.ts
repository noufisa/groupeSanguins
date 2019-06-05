import { Injectable } from '@angular/core';
import {Prelevement} from "./prelevement.service";

@Injectable({
  providedIn: 'root'
})
export class TestService {

  constructor() { }
}
export class Test {
    id:number;
    dateTest:number;
    groupe:string;
    vih:string;
    vhc:string;
    vhb:string;
    Prelevement:Prelevement;
}
