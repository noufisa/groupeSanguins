import { Injectable } from '@angular/core';
import { ApiService } from './api.service';
import {User} from "./auth.service";
import {Prelevement} from "./prelevement.service";

@Injectable({
  providedIn: 'root'
})
export class DonneurService {
donneur:Donneur[];
  constructor(private apiService: ApiService) { }
  async getAllDonneur():Promise<Donneur[]>{
    this.donneur= await this.apiService.call('Show', 'get', null).toPromise();
    return this.donneur;
  }
  async get(id: number):Promise<Donneur> {
    return await this.apiService.call('getDonneur/'+id , 'get', null ).toPromise();
  }
  async deleteD(id:number){
      try {
          await this.apiService.call('deleteD/' + id, 'delete', null).toPromise();
          this.donneur.splice(this.donneur.indexOf(this.donneur.find((c) => {
              return c.id === id
          })), 1);
          return true;
      }catch(e)
      {
          return false;
      }
  }
}
export class Donneur {
  id: number;
  cin: string;
  dateNaissance: number;
  adresse: string;
  groupe_sanguin: string;
  tel: string;
  ville: string;
  Prelevement:Prelevement[];
  User: User;

}
