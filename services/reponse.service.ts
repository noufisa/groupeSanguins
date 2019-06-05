import { Injectable } from '@angular/core';
import {Visite} from "./visite.service";
import {Question} from "./question.service";

@Injectable({
  providedIn: 'root'
})
export class ReponseService {

  constructor() { }
}
export class Reponse{
    id:number;
    reponse:string;
    question:Question;
    visite:Visite;
}
