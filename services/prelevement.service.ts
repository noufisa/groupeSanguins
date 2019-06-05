import { Injectable } from '@angular/core';
import {Donneur} from "./donneur.service";
import {ApiService} from "./api.service";
import {Question} from "./question.service";
import {Test} from "./test.service";

@Injectable({
  providedIn: 'root'
})
export class PrelevementService {
    pre:Prelevement[];
  constructor(private apiService:ApiService) { }
    async getPre(id: number):Promise<Prelevement[]> {
        this.pre= await this.apiService.call('getPre/'+id , 'get', null ).toPromise();
        return this.pre;
    }
    async getAllPre():Promise<Prelevement[]>{
      this.pre=await this.apiService.call('getAllPre','get',null).toPromise();
      return this.pre;
    }
    async addPre(p:Prelevement) {
        try {
            const pe: Prelevement = await this.apiService.call('addP', 'post', p).toPromise();
            if (p.id === 0) {
                this.pre.push(pe);
            }
            return true;
        }catch(e){
            return false;
        }
    }
    async deleteP(id:number){
        try {
            await this.apiService.call('deleteP/' + id, 'delete', null).toPromise();
            this.pre.splice(this.pre.indexOf(this.pre.find((c) => {
                return c.id === id
            })), 1);
            return true;
        }catch(e)
        {
            return false;
        }
}
}
export class Prelevement {
    id:number;
    code:string;
    date:number;
    qte:number;
    donneur:Donneur;
    test:Test[];
}
