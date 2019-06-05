import { Injectable } from '@angular/core';
import { ApiService } from './api.service';
import {tryCatch} from "rxjs/internal-compatibility";
import {Medecin} from "./medecin.service";
import {Donneur} from "./donneur.service";
import {Question} from "./question.service";
@Injectable({
  providedIn: 'root'
})
export class VisiteService {

  constructor(private apiService: ApiService) { }

  async createVisite(visite: Visite):Promise<boolean> {
      try{
          const v:Visite= await this.apiService.call('addV', 'post', visite).toPromise();
          return true;
      }catch(e){
          return false;
      }

  }

  async getAllVisite() {
    return await this.apiService.call('Show', 'get', null);
  }

  async deleteVisite(visite: Visite) {
    return await this.apiService.call('deleteV/:id', 'delete', null);
  }
    async loadQ(){
        return await this.apiService.call('getAll','get',null).toPromise();
    }
}
export class Visite {
  id: number;
  date:number;
  donneur:Donneur;
  medecin:Medecin;
  question:Question[];
    constructor() {
        this.id=0;


    }
}
